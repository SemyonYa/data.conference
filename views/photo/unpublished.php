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
            <div class="galery-item-wrap">
                <label for="photo<?= $photo->id ?>">
                    <div class="galery-item" style="background-image: url('<?= $photo->thumb ?>')">
                        <input data-id="<?= $photo->id ?>" type="checkbox" class="unpublished-photo" checked id="photo<?= $photo->id ?>">
                    </div>
                </label>
                <a href="/photo/update?id=<?= $photo->id ?>&route=unpublished"><span class="glyphicon glyphicon-pencil"></span></a>
                <a href="/photo/delete?id=<?= $photo->id ?>&route=unpublished"><span class="glyphicon glyphicon-remove"></span></a>
            </div>
        <?php endforeach; ?>
    </div>
    <p>
        <button class="btn btn-success" id="publish-button" onclick="publishing()">Опубликовать</button>
    </p>

</div>