<?php

namespace app\controllers;

use app\models\Schedule;
use Yii;
use app\models\SchedulePresentation;
use app\models\SchedulePresentationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SchedulePresentationController implements the CRUD actions for SchedulePresentation model.
 */
class SchedulePresentationController extends AdminController
{
    /**
     * {@inheritdoc}
     */
    // public function behaviors()
    // {
    //     return [
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'delete' => ['POST'],
    //             ],
    //         ],
    //     ];
    // }

    /**
     * Lists all SchedulePresentation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SchedulePresentationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SchedulePresentation model.
     * @param integer $schedule_id
     * @param integer $presentation_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($schedule_id, $presentation_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($schedule_id, $presentation_id),
        ]);
    }

    /**
     * Creates a new SchedulePresentation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($schedule_id)
    {
        $model = new SchedulePresentation();
        $model->schedule_id = $schedule_id;
        $schedule = Schedule::findOne($schedule_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('/schedule/view?id=' . $schedule_id);
        }

        return $this->render('create', compact('model', 'schedule'));
    }

    /**
     * Updates an existing SchedulePresentation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $schedule_id
     * @param integer $presentation_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($schedule_id, $presentation_id)
    {
        $model = $this->findModel($schedule_id, $presentation_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'schedule_id' => $model->schedule_id, 'presentation_id' => $model->presentation_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SchedulePresentation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $schedule_id
     * @param integer $presentation_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($schedule_id, $presentation_id)
    {
        $this->findModel($schedule_id, $presentation_id)->delete();

        return $this->redirect('/schedule/view?id=' . $schedule_id);
    }

    /**
     * Finds the SchedulePresentation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $schedule_id
     * @param integer $presentation_id
     * @return SchedulePresentation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($schedule_id, $presentation_id)
    {
        if (($model = SchedulePresentation::findOne(['schedule_id' => $schedule_id, 'presentation_id' => $presentation_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
