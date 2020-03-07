<?php

use yii\helpers\Html;

/* @var $this yii\web\View */


$this->title = 'Неопубликованные фото';
$this->params['breadcrumbs'][] = ['label' => 'Галерея', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="galery">
        <?php foreach ($galery as $photo) : ?>
            <p>
                <label for="photo<?= $photo->id ?>"><?= $photo->name ?></label>
                <input data-id="<?= $photo->id ?>" type="checkbox" class="unpublished-photo" id="photo<?= $photo->id ?>">
            </p>
        <?php endforeach; ?>
        <p>
            <button class="btn btn-success" id="publish-button" onclick="publishing()">Опубликовать</button>
        </p>
    </div>

</div>