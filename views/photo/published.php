<?php

use yii\helpers\Html;

/* @var $this yii\web\View */


$this->title = 'Опубликованные фото';
$this->params['breadcrumbs'][] = ['label' => 'Галерея', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="galery">
        <?php foreach ($galery as $photo) : ?>
            <p><?= $photo->name ?></p>
        <?php endforeach; ?>
    </div>

</div>