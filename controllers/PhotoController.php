<?php

namespace app\controllers;

use app\models\Photo;
use yii\imagine\Image;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Json as HelpersJson;

class PhotoController extends AdminController
{
    public function actionIndex()
    {
        $dir = Yii::getAlias('@webroot/galery_upload');
        $files = FileHelper::findFiles($dir, ['only' => ['*.jpg']]);
        return $this->render('index', compact('files'));
    }

    public function actionUpload()
    {
        $dir = Yii::getAlias('@webroot/galery_upload');
        $files = FileHelper::findFiles($dir, ['only' => ['*.jpg']]);
        $uploaded_counter = 0;
        foreach ($files as $file) {
            $name = Yii::$app->security->generateRandomString();
            Image::resize($file, 1000, 1000)
            ->save(Yii::getAlias('@webroot/galery/' . $name . '-m.jpg'), ['quality' => 80]);
            Image::resize($file, 400, 400)
            ->save(Yii::getAlias('@webroot/galery/' . $name . '-s.jpg'), ['quality' => 60]);
            rename($file, Yii::getAlias('@webroot/galery/' . $name . '.jpg'));
            $model = new Photo();
            $model->name = $name;
            $model->title = '-';
            $model->is_visible = 0;
            if ($model->save()) {
                $uploaded_counter = $uploaded_counter + 1;
            }
        }
        return $this->redirect('/photo/upload-result?count=' . $uploaded_counter);
    }

    public function actionUploadResult($count)
    {
        return $this->render('upload-result', compact('count'));
    }

    public function actionUnpublished()
    {
        $galery = Photo::find()->where(['is_visible' => 0])->all();
        return $this->render('unpublished', compact('galery'));
    }

    public function actionPublished()
    {
        $galery = photo::find()->where(['is_visible' => 1])->all();
        return $this->render('published', compact('galery'));
    }

    public function actionPublishChecked()
    {
        $photo_ids = Yii::$app->request->post('ids');
        $photos = Photo::findAll($photo_ids);
        foreach ($photos as $photo) {
            $photo->is_visible = 1;
            $photo->save();
        }
        return HelpersJson::encode(true);
    }

    public function actionUpdate($id)
    {
        $model = Photo::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['published']);
        }

        return $this->render('update', compact('model'));
    }

    public function actionDelete($id, $route) {
        $photo = Photo::findOne($id);
        unlink(Yii::getAlias('@webroot/galery/' . $photo->name . '.jpg'));
        unlink(Yii::getAlias('@webroot/galery/' . $photo->name . '-s.jpg'));
        unlink(Yii::getAlias('@webroot/galery/' . $photo->name . '-m.jpg'));
        $photo->delete();
        return $this->redirect([$route]);
    }
}
