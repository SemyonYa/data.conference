<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SchedulePresentation */

$this->title = 'Update Schedule Presentation: ' . $model->schedule_id;
$this->params['breadcrumbs'][] = ['label' => 'Schedule Presentations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->schedule_id, 'url' => ['view', 'schedule_id' => $model->schedule_id, 'presentation_id' => $model->presentation_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="schedule-presentation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
