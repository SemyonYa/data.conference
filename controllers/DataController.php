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
use Yii;

class DataController extends \yii\web\Controller
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
                    'Access-Control-Allow-Headers' => ['Origin', 'Content-Type', 'X-Auth-Token', 'Authorization', 'ngAuthorization', 'x-compress']
                ],
            ],
        ];
    }

    // public function beforeAction($action)
    // {
    //     if (Yii::$app->user->isGuest) {
    //         return $this->redirect('/site/login');
    //     }
    //     // $user_identity = Yii::$app->user->identity;
    //     // echo '<pre>';
    //     // var_dump($user_identity);die;
    //     return parent::beforeAction($action);
    // }

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

    // public function actionSchedulePresentations($schedule_id)
    // {
    //     $this->layout = 'empty';
    //     $schedule = Schedule::findOne($schedule_id);
    //     $presentation_ids = SchedulePresentation::find()
    //         ->where(['schedule_id' => $schedule_id])
    //         ->select(['presentation_id'])
    //         ->column();
    //     $presentations = Presentation::findAll($presentation_ids);
    //     return $this->render('schedule-presentation-modal', compact('presentations', 'schedule'));
    //     return Json::encode([
    //         'schedule' => $schedule,
    //         'presentations' => $presentations
    //     ]);
    // }

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
        // $is_jury = Yii::$app->user->identity->role_id == 3;
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
        $ratings = Rating::find()->all();
        return Json::encode([
            'presentation' => $presentation,
            'rating' => $ratings
        ]);
    }

    public function actionSetMark()
    {
        if (Yii::$app->user->identity->role_id == 3) {
            // return Json::encode(1);
            $person_id = Yii::$app->user->identity->person_id;
            $rating = Yii::$app->request->post('rating');
            $description = Yii::$app->request->post('description') ?: ' ';
            $presentation_id = Yii::$app->request->post('presentationId');
            $mark = Mark::findOne(['jury_id' => $person_id, 'presentation_id' => $presentation_id]);
            if (!$mark) $mark = new Mark();
            $mark->rating_id = $rating;
            $mark->description = $description;
            $mark->jury_id = $person_id;
            $mark->presentation_id = $presentation_id;
            return Json::encode($mark->save());
        }
    }

    public function actionGalery()
    {
        $photos = Photo::find()->where(['is_visible' => 1])->orderBy('id DESC')->all();
        $person_likes = Like::find()->where(['person_id' => Yii::$app->user->identity->person_id])->all();
        $likes = [];
        foreach ($person_likes as $p_like) {
            $likes[$p_like->photo_id] = Like::find()->where(['photo_id' => $p_like->photo_id])->count();
        }
        return Json::encode([
            'photos' => $photos,
            'likes' => $likes
        ]);
    }

    public function actionGetPhotoPath($id)
    {
        return Json::encode(Photo::findOne($id)->wide);
    }

    public function actionLike($photo_id)
    {
        $person_id = Yii::$app->user->identity->person_id;
        // return Json::encode($person_id);
        $on = false;
        if ($person_id) {
            if ($like = Like::find()->where(['photo_id' => $photo_id, 'person_id' => $person_id])->one()) {
                $like->delete();
            } else {
                $like = new Like();
                $like->person_id = $person_id;
                $like->photo_id = $photo_id;
                $like->save();
                $on = true;
            }
        }

        $count = Like::find()->where(['photo_id' => $photo_id])->count();

        return Json::encode([
            'on' => $on,
            'count' => $count
        ]);
    }
}
