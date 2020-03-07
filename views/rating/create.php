<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rating */

$this->title = 'Новый рейтинг';
$this->params['breadcrumbs'][] = ['label' => 'Рейтинги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rating-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model')) ?>

</div>
