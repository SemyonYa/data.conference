<?php

namespace app\controllers;

use app\models\Like;
use app\models\Mark;
use app\models\Person;
use app\models\PersonRole;
use app\models\Photo;
use app\models\Presentation;
use app\models\Rating;
use app\models\Schedule;
use app\models\ScheduleDate;
use app\models\SchedulePresentation;
use app\models\Section;
use app\models\User;
use Yii;

class FrontController extends \yii\web\Controller
{
    public $layout = '_front';

    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/site/login');
        }
        // $user_identity = Yii::$app->user->identity;
        // echo '<pre>';
        // var_dump($user_identity);die;
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionPeople()
    {
        // $jury_list = Person::find()->where(['is_visible' => 1, 'person_role_id' => 1])->all();
        // $lector_list = Person::find()->where(['is_visible' => 1, 'person_role_id' => 2])->all();
        $person_roles = PersonRole::find()->where(['is_visible' => 1])->orderBy('ordering ASC')->all();

        return $this->render('people', compact('person_roles'));
    }

    public function actionPersonModal($id)
    {
        $this->layout = 'empty';
        $person = Person::findOne($id);
        return $this->render('person-modal', compact('person'));
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
                ->all();
            $schedule_dates[] = $current_sch_date;
        }
        return $this->render('schedule', compact('schedule_dates'));
    }

    public function actionSchedulePresentationModal($schedule_id)
    {
        $this->layout = 'empty';
        $schedule = Schedule::findOne($schedule_id);
        $presentation_ids = SchedulePresentation::find()
            ->where(['schedule_id' => $schedule_id])
            ->select(['presentation_id'])
            ->column();
        $presentations = Presentation::findAll($presentation_ids);
        return $this->render('schedule-presentation-modal', compact('presentations', 'schedule'));
    }

    public function actionPresentations()
    {
        $sections = Section::find()->all();
        $zero_presentations = Section::zeroPresentations();
        return $this->render('presentations', compact('sections', 'zero_presentations'));
    }

    public function actionPresentation($id)
    {
        $is_jury = Yii::$app->user->identity->role_id == 3;
        $presentation = Presentation::findOne($id);
        $ratings = Rating::find()->all();
        return $this->render('presentation', compact('presentation', 'ratings', 'is_jury'));
    }

    public function actionSetMark()
    {
        if (Yii::$app->user->identity->role_id == 3) {
            // return json_encode(1);
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
            return json_encode($mark->save());
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
        return $this->render('galery', compact('photos', 'likes'));
    }

    public function actionGetPhotoPath($id)
    {
        return Photo::findOne($id)->wide;
    }

    public function actionLike($photo_id)
    {
        $person_id = Yii::$app->user->identity->person_id;
        // return json_encode($person_id);
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

        return json_encode([
            'on' => $on,
            'count' => $count
        ]);
    }
}
