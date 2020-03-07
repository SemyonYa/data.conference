<?php

use yii\helpers\Html;

/* @var $this yii\web\View */


$this->title = 'Результат загрузки';
$this->params['breadcrumbs'][] = ['label' => 'Галерея', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-success">
        <p>Загружено файлов: <strong><?= $count ?></strong></p>
        <a href="/photo/unpublished" class="btn btn-success">Посмотреть неопубликованные фото</a>
    </div>

</div>