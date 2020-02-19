<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PersonRole */

$this->title = 'Редактирование роли: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Роли участников', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="person-role-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model')) ?>

</div>
