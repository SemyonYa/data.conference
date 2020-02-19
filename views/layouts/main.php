<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
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
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>

        <!-- TEMPORARY MENU -->
        <div class="container">
            <p><a href="/site/index">HOME</a></p>
            <p><a href="/person/index">Участники конференции</a></p>
            <p><a href="/person-role/index">Роли участников конференции</a></p>
            <p><a href="/image/list">Менеджер картинок</a></p>
            <p><?php if (Yii::$app->user->isGuest) : ?>
                <a href="/site/login" class="btn btn-primary">LOGIN</a>
            <?php else : ?>
                <?php
                echo Html::beginForm(['/site/logout'], 'post');
                echo Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                );
                echo Html::endForm();
                ?>
            <?php endif; ?>
        </div>
    </div>

    <footer>
        &copy; Conference <?= date('Y') ?>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>

<!-- ConferenceModalWrap -->
<div class="modal fade" id="ConferenceModal" tabindex="-1" role="dialog" aria-labelledby="ConferenceModalLabel" data-input-id="-">
  Загрузка...
</div>