<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PersonRole */

$this->title = 'Новая роль участника';
$this->params['breadcrumbs'][] = ['label' => 'Роли участников', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-role-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model')) ?>

</div>
