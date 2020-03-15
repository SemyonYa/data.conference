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
            <p><a href="/site/index"><strong>ГЛАВНАЯ</strong></a></p>
            <p><a href="/person/index">Участники конференции</a></p>
            <p><a href="/person-role/index">Роли участников конференции</a></p>
            <p><a href="/image/list">Менеджер картинок</a></p>
            <p><a href="/section/index">Секции</a></p>
            <p><a href="/presentation/index">Список презентаций</a></p>
            <p><a href="/schedule/index">Расписание</a></p>
            <p><a href="/rating/index">Рейтинги</a></p>
            <p><a href="/photo/index">Галерея</a></p>
            <p><a href="/user/index">Пользователи</a></p>
            <p><?php if (Yii::$app->user->isGuest) : ?>
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

<div class="modal fade" id="ConferenceCommonModal" tabindex="-1" role="dialog" aria-labelledby="ConferenceCommonModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ConferenceModalLabel">Менеджер изображений</h4>
            </div> -->
            <div class="modal-body">
                загрузка...
            </div>
        </div>
    </div>
</div>

</div>