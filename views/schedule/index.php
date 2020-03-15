<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ScheduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Расписание';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schedule-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить пункт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="schecule-list">
        <table class="table table-condensed">
            <?php foreach ($schedule_dates as $sch_date) : ?>
                <tr>
                    <td><?= $sch_date->date ?></td>
                </tr>
                <?php foreach ($sch_date->schedules as $schedule) : ?>
                    <tr>
                        <td><?= $schedule->id ?></td>
                        <td><?= $schedule->time ?></td>
                        <td><?= $schedule->name ?></td>
                        <td><?= $schedule->duration ?></td>
                        <td><?= $schedule->place ?></td>
                        <td>
                            <a href="/schedule/view?id=<?= $schedule->id ?>" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a>
                            <a href="/schedule/update?id=<?= $schedule->id ?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </table>
    </div>
</div>