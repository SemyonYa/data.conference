<?php

namespace app\controllers;

use app\models\Doc;
use yii\helpers\Json;
use app\models\Like;
use app\models\Mark;
use app\models\Person;
use app\models\PersonRole;
use app\models\Photo;
use app\models\Presentation;
use app\models\PresentationDoc;
use app\models\PresentationPerson;
use app\models\Rating;
use app\models\Schedule;
use app\models\ScheduleDate;
use app\models\SchedulePresentation;
use app\models\Section;
use app\models\User;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;
use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\UnauthorizedHttpException;

class DataController extends Controller
{

    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
                'cors' => [
                    'Origin' => [
                        'http://localhost:4200',
                        'http://localhost:8100',
                        'http://wanna-fresh.ru',
                        'http://app.wanna-fresh.ru',
                    ],
                    'Access-Control-Allow-Origin' => true,
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Request-Method' => ['POST'],
                    'Access-Control-Allow-Headers' => ['Origin', 'Content-Type', 'X-Auth-Token', 'Authorization', 'ngAuthorization', 'x-compress', 'Conf-Auth']
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
        if (in_array($action->id, [
            'set-current-presentation',
            'report-data'
        ])) {
            $this->checkTokenComrepe();
        } else if (in_array($action->id, [
            'mark',
            'set-mark'
        ])) {
            $this->checkTokenJury();
        } else {
            $this->checkToken();
        }
        return true;
    }

    private function checkToken()
    {
        $jwt = Yii::$app->request->headers->get('conf-auth');
        $token = (new Parser())
            ->parse($jwt);
        $validation_data = new ValidationData();
        if (!$token->validate($validation_data)) {
            throw new UnauthorizedHttpException();
        }
    }

    private function checkTokenJury()
    {
        $jwt = Yii::$app->request->headers->get('conf-auth');
        $token = (new Parser())
            ->parse($jwt);
        $validation_data = new ValidationData();
        if (!$token->validate($validation_data)) {
            throw new UnauthorizedHttpException();
        }
        $user = User::findOne($token->getClaim('id'));
        if ($user->role_id !== 3) {
            throw new ForbiddenHttpException();
        }
    }

    private function checkTokenComrepe()
    {
        $jwt = Yii::$app->request->headers->get('conf-auth');
        $token = (new Parser())
            ->parse($jwt);
        $validation_data = new ValidationData();
        if (!$token->validate($validation_data)) {
            throw new UnauthorizedHttpException();
        }
        $user = User::findOne($token->getClaim('id'));
        if ($user->role_id !== 4) {
            throw new ForbiddenHttpException();
        }
    }

    public function actionPeople()
    {
        $roles = PersonRole::find()->where(['is_visible' => 1])->orderBy('ordering ASC')->asArray()->all();
        $people = [];
        foreach ($roles as $role) {
            $people[] = [
                'role' => $role,
                'people' => Person::find()->where(['person_role_id' => $role['id']])->orderBy('surname ASC')->asArray()->all()
            ];
        }
        return Json::encode($people);
    }

    public function actionPerson($id)
    {
        return Json::encode(Person::findOne($id));
    }

    public function actionSchedule()
    {
        $schedule_dates = [];
        $dates = Schedule::find()->select(['date'])->orderBy('date ASC')->distinct()->column();
        foreach ($dates as $date) {
            $current_sch_date = new ScheduleDate();
            $current_sch_date->date = $date;
            $current_sch_date->schedules = Schedule::find()
                ->where(['date' => $date])
                ->orderBy('time ASC')
                ->asArray()
                ->all();
            foreach ($current_sch_date->schedules as $i => $sch) {
                $presentation_ids = SchedulePresentation::find()
                    ->where(['schedule_id' => $sch['id']])
                    ->select(['presentation_id'])
                    ->column();
                $current_sch_date->schedules[$i]['presentations'] = Presentation::findAll($presentation_ids);
            }
            $schedule_dates[] = $current_sch_date;
        }
        return Json::encode($schedule_dates);
    }

    public function actionPresentations()
    {
        $sections = Section::find()->all();
        $sections_with_presentations = [];
        foreach ($sections as $section) {
            $sections_with_presentations[] = [
                'section' => $section,
                'presentations' => $section->presentations
            ];
        }
        $zero_presentations = Section::zeroPresentations();
        return Json::encode([
            'sections' => $sections_with_presentations,
            'zero' => $zero_presentations
        ]);
    }

    public function actionPresentation($id)
    {
        $presentation = Presentation::find()
            ->where(['id' => $id])
            ->asArray()
            ->one();
        $people_ids = PresentationPerson::find()
            ->where(['presentation_id' => $id])
            ->select('person_id')
            ->column();
        $presentation['people'] = Person::findAll($people_ids);
        $presentation['docs'] = Doc::find()
            ->where(['presentation_id' => $id])
            ->orderBy('ordering ASC')
            ->all();
        return Json::encode($presentation);
    }

    public function actionSetCurrentPresentation($id, $is_current)
    {
        $res = Yii::$app->db
            ->createCommand()
            ->update('presentation', ['is_current' => 0])
            ->execute();
        if ($is_current == 1) {
            $res *= Yii::$app->db
                ->createCommand()
                ->update('presentation', ['is_current' => 1], 'id = ' . $id)
                ->execute();
        }
        return Json::encode(true);
        // $presentation = Presentation::findOne($id);
    }

    public function actionRatings()
    {
        return Json::encode(Rating::find()->all());
    }

    public function actionMark($presentation_id, $jury_id)
    {
        // $is_jury = Yii::$app->user->identity->role_id == 3;
        return Json::encode(Mark::findOne(['presentation_id' => $presentation_id, 'jury_id' => $jury_id]));
    }

    public function actionSetMark()
    {
        $data = Yii::$app->request->post('mark');
        $mark = Mark::findOne($data['id']);
        if (!$mark) $mark = new Mark();
        $mark->rating_id = $data['ratingId'];
        $mark->description = $data['description'];
        $mark->jury_id = $data['juryId'];
        $mark->presentation_id = $data['presentationId'];
        return Json::encode($mark->save());
    }

    public function actionGalery($person_id)
    {
        $photos = Photo::find()
            ->where(['is_visible' => 1])
            ->orderBy('id DESC')
            ->asArray()
            ->all();
        $person_likes = Like::find()
            ->where(['person_id' => $person_id])
            ->select(['photo_id'])
            ->asArray()
            ->column();
        foreach ($photos as $id => $photo) {
            $photos[$id]['count'] = Like::find()->where(['photo_id' => $photo['id']])->count(); //isset($likes[$photo['id']]) ? $likes[$photo['id']] : 0;
            $photos[$id]['my_like'] = in_array($photo['id'], $person_likes);
        }
        return Json::encode($photos);
    }

    public function actionGetPhotoPath($id)
    {
        return Json::encode(Photo::findOne($id)->wide);
    }

    public function actionLike()
    {
        $photo_id = Yii::$app->request->post('photoId');
        $person_id = Yii::$app->request->post('personId');
        if ($like = Like::find()->where(['photo_id' => $photo_id, 'person_id' => $person_id])->one()) {
            return $like->delete();
        } else {
            $like = new Like();
            $like->person_id = $person_id;
            $like->photo_id = $photo_id;
            return $like->save();
        }
    }

    public function actionReportData()
    {
        $jury_ids = User::find()
            ->where(['role_id' => 3, 'blocked' => 0])
            ->andWhere(['>', 'person_id', 0])
            ->select(['person_id'])
            ->column();
        $persons = Person::find()
            ->where(['in', 'id', $jury_ids])
            ->orderBy('surname ASC')
            ->all();
        $presentations = Presentation::find()
            ->where(['is_visible' => 1])
            ->orderBy('ordering ASC')
            ->all();
        $data = [];
        foreach ($presentations as $presentation) {
            $pms = [];
            foreach ($persons as $person) {
                $pms[] = [
                    'person' => $person,
                    'mark' => Mark::findOne(['jury_id' => $person->id, 'presentation_id' => $presentation->id])
                ];
            }
            $data[] = [
                'presentation' => $presentation,
                'person_marks' => $pms
            ];
        }
        return Json::encode($data, true);
        // echo '<pre>';
        // var_dump($data);
        // die;
    }
}
