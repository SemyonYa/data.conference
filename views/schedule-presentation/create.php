<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SchedulePresentation */

$this->title = 'Прикрепить презентацию';
$this->params['breadcrumbs'][] = ['label' => $schedule->name, 'url' => '/schedule/view?id=' . $schedule->id];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schedule-presentation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model')) ?>

</div>
