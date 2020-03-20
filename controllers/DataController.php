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

class DataController extends \yii\web\Controller
{

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
        return json_encode(Person::find()->where(['is_visible' => 1])->orderBy('ordering ASC')->all());
    }

    public function actionPerson($id)
    {
        return json_encode(Person::findOne($id));
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
        return json_encode($schedule_dates);
    }

    public function actionSchedulePresentations($schedule_id)
    {
        $this->layout = 'empty';
        $schedule = Schedule::findOne($schedule_id);
        $presentation_ids = SchedulePresentation::find()
            ->where(['schedule_id' => $schedule_id])
            ->select(['presentation_id'])
            ->column();
        $presentations = Presentation::findAll($presentation_ids);
        return $this->render('schedule-presentation-modal', compact('presentations', 'schedule'));
        return json_encode([
            'schedule' => $schedule,
            'presentations' => $presentations
        ]);
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
        return json_encode([
            'sections' => $sections_with_presentations,
            'zero' => $zero_presentations
        ]);
    }

    public function actionPresentation($id)
    {
        // $is_jury = Yii::$app->user->identity->role_id == 3;
        $presentation = Presentation::findOne($id);
        $ratings = Rating::find()->all();
        return json_encode([
            'presentation' => $presentation,
            'rating' => $rating
        ]);
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
        return json_encode([
            'photos' => $photos,
            'likes' => $likes
        ]);
    }

    public function actionGetPhotoPath($id)
    {
        return json_encode(Photo::findOne($id)->wide);
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
