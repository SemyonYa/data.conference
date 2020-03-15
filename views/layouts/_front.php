<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond&display=swap" rel="stylesheet">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>
    <div class="front-header">
        <a href="/front"><span class="glyphicon glyphicon-home"></span></a>
        <span><?= Yii::$app->name ?></span>
        <?php if (Yii::$app->user->isGuest) : ?>
            <a href="/site/login" class="btn btn-primary">LOGIN</a>
        <?php else : ?>
            <?php
            echo Html::beginForm(['/site/logout'], 'post');
            echo Html::submitButton(
                'Logout (' . Yii::$app->user->identity->login . ')',
                ['class' => 'btn btn-link logout']
            );
            echo Html::endForm();
            ?>
        <?php endif; ?>
    </div>

    <div class="front-bread">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>

    <div class="front-content">
        <?= $content ?>
    </div>

    <div class="front-menu">
        <a href="/front/people">
            <div class="front-menu-item <?= $_SERVER['REQUEST_URI'] === '/front/people' ? 'front-menu-item-active' : '' ?>">
                <span class="glyphicon glyphicon-user"></span>
                <span>Участники</span>
            </div>
        </a>
        <a href="/front/schedule">
            <div class="front-menu-item <?= $_SERVER['REQUEST_URI'] === '/front/schedule' ? 'front-menu-item-active' : '' ?>">
                <span class="glyphicon glyphicon-time"></span>
                <span>Расписание</span>
            </div>
        </a>
        <a href="/front/presentations">
            <div class="front-menu-item <?= strpos($_SERVER['REQUEST_URI'], '/front/presentation')  !== false ? 'front-menu-item-active' : '' ?>">
                <span class="glyphicon glyphicon-book"></span>
                <span>Доклады</span>
            </div>
        </a>
        <a href="/front/galery">
            <div class="front-menu-item <?= $_SERVER['REQUEST_URI'] === '/front/galery' ? 'front-menu-item-active' : '' ?>">
                <span class="glyphicon glyphicon-picture"></span>
                <span>Фото</span>
            </div>
        </a>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>

<!-- ConferenceFrontModalWrap -->
<div class="modal fade" id="ConferenceFrontModal" tabindex="-1" role="dialog" aria-labelledby="ConferenceFrontModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content front-modal-content" id="ConferenceFrontModalContent">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                загрузка...
            </div>
        </div>
        <span class="glyphicon glyphicon-remove front-modal-close-btn" data-dismiss="modal"></span>
    </div>
</div>

<div class="front-backdrop" onclick="closeLightbox()">
</div>
<div class="front-photo-opened-wrap">
    <div class="front-photo-prev">
        <span class="glyphicon glyphicon-chevron-left" onclick="nextPhoto('prev')"></span>
    </div>
    <div class="front-photo-opened">
        <img src="" id="front-lightbox-photo" width="100%" alt="хер" data-id="0" >
        <!-- <div class="glyphicon glyphicon-remove front-close-lightbox-btn2" onclick="closeLightbox()"></div> -->
    </div>
    <div class="front-photo-next">
        <span class="glyphicon glyphicon-chevron-right" onclick="nextPhoto('next')"></span>
    </div>
    <span class="glyphicon glyphicon-remove front-close-lightbox-btn" onclick="closeLightbox()"></span>
</div>