<?php
/* @var $this yii\web\View */
$this->title = 'Галерея';
?>

<h1 class="text-center"><?= $this->title ?></h1>
<div class="front-galery">
    <?php if (count($photos) === 0) : ?>
        <div class="alert alert-info">
            Пока нет загруженных фото.
        </div>
    <?php endif; ?>
    <?php $no = 1; ?>
    <?php foreach ($photos as $photo) : ?>
        <div class="front-photo-wrap">
            <div class="front-photo" data-no="<?= $no++ ?>" data-id="<?= $photo->id ?>" style="background-image: url('<?= $photo->thumb ?>')" onclick="showPhoto(<?= $photo->id ?>)"></div>
            <div data-id="<?= $photo->id ?>" class="glyphicon <?= isset($likes[$photo->id]) ? 'glyphicon-heart front-like-on' : 'glyphicon-heart-empty' ?> front-like" onclick="like(event)">
                <?= isset($likes[$photo->id]) ? $likes[$photo->id] : '' ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>