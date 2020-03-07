<?php

use yii\helpers\Html;

/* @var $this yii\web\View */


$this->title = 'Галерея';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h4>
        <a href="/photo/published" class="btn btn-primary">Опубликованные</a>
        <a href="/photo/unpublished" class="btn btn-primary">Неопубликованные</a>
    </h4>

    <?php if (count($files) > 0) : ?>
        <div class="alert alert-success">
            <p>Количество файлов формата <code>.jpg</code> для загрузки: <strong><?= count($files) ?></strong>.</p>
            <a href="/photo/upload" class="btn btn-success">
                <span class="glyphicon glyphicon-upload"></span>
                Загрузить
            </a>
        </div>
    <?php else : ?>
        <div class="alert alert-warning">
            В директории <code>/web/galery_upload</code> нет файлов формата <code>.jpg</code> для загрузки
        </div>
    <?php endif; ?>

</div>