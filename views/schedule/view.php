<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Schedule */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Расписание', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="schedule-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редатировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Действительно удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'date',
            'time',
            'duration',
            'place',
            'is_visible',
        ],
    ]) ?>

    <div class="schedule-presentations">
        <a href="/schedule-presentation/create?schedule_id=<?= $model->id ?>"><span class="glyphicon glyphicon-plus-sign"></span></a>
        <?php foreach ($model->schedulePresentations as $sp) : ?>
            <div class="schedule-presentations-item">
                <span><?= $sp->presentation->name ?> </span>
                <a href="/schedule-presentation/delete?schedule_id=<?= $model->id ?>&presentation_id=<?= $sp->presentation->id ?>">
                    <span class="glyphicon glyphicon-remove text-danger"></span>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

</div>