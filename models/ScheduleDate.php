<?php

namespace app\models;

use DateTime;
use Yii;

/**
 * @property DateTime $date
 * @property Schedule[] $schedules
 */
class ScheduleDate
{
    public $date;
    public $schedules = [];

}
