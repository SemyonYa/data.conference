<?php

namespace app\controllers;

use Yii;
use app\models\Doc;
use app\models\DocSearch;
use app\models\Presentation;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DocController implements the CRUD actions for Doc model.
 */
class DocController extends AdminController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Doc models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Doc model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Doc model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($presentation_id)
    {
        $presentation = Presentation::findOne($presentation_id);
        $model = new Doc();
        $model->is_visible = 1;
        $model->presentation_id = $presentation_id;
        $model->path = '-';
        $model->extension = '-';
        if ($model->load(Yii::$app->request->post())) {
            $p_e = $model->upload($_FILES['Doc']);
            $model->path = $p_e['path'];
            $model->extension = $p_e['extension'];
            if ($model->save()) {
                return $this->redirect(['/presentation/view?id=' . $presentation_id]);
            }
            // return $this->redirect(['presentation', 'view', 'id' => $presentation_id]);
        }

        return $this->render('create', compact('model', 'presentation'));
    }


    /**
     * Updates an existing Doc model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Doc model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Doc model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Doc the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Doc::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
