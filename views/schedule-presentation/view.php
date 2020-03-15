<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SchedulePresentation */

$this->title = $model->schedule_id;
$this->params['breadcrumbs'][] = ['label' => 'Schedule Presentations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="schedule-presentation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'schedule_id' => $model->schedule_id, 'presentation_id' => $model->presentation_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'schedule_id' => $model->schedule_id, 'presentation_id' => $model->presentation_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'schedule_id',
            'presentation_id',
        ],
    ]) ?>

</div>
