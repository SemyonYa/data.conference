<?php
/* @var $this yii\web\View */
$this->title = 'Расписание';
?>

<div class="schedule-wrap">
    <div class="schedule-inner">
        <h1 class="text-center"><?= $this->title ?></h1>
        <table class="table table-borderless table-hover front-schedule-table">
            <?php foreach ($schedule_dates as $sch_date) : ?>
                <thead>
                    <tr>
                        <td colspan="3"><?= $sch_date->date ?></td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sch_date->schedules as $schedule) : ?>
                        <tr>
                            <td><?= $schedule->time ?></td>
                            <td>
                                <strong><?= $schedule->name ?></strong>
                                <br>
                                <?= $schedule->place ?>
                            </td>
                            <td>
                                <?php if (count($schedule->schedulePresentations) > 0) : ?>
                                    <span class="glyphicon glyphicon-info-sign front-info-btn" data-toggle="modal" data-target="#ConferenceFrontModal" onclick="showSchedulePresentations(<?= $schedule->id ?>)"></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php endforeach; ?>
            <thead>
                <tr>
                    <td colspan="3">КОНЕЦ</td>
                </tr>
            </thead>
        </table>
    </div>
</div>