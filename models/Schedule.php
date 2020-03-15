<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "schedule".
 *
 * @property int $id
 * @property string $name
 * @property string $date
 * @property string $time
 * @property int $duration
 * @property string $place
 * @property int|null $is_visible
 *
 * @property SchedulePresentation[] $schedulePresentations
 */
class Schedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'date', 'time', 'duration', 'place'], 'required'],
            [['date', 'time'], 'safe'],
            [['duration', 'is_visible'], 'integer'],
            [['name', 'place'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'date' => 'Дата',
            'time' => 'Время',
            'duration' => 'Продолжительность',
            'place' => 'Место проведения',
            'is_visible' => 'Опубликовать',
        ];
    }

    /**
     * Gets query for [[SchedulePresentations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSchedulePresentations()
    {
        return $this->hasMany(SchedulePresentation::className(), ['schedule_id' => 'id']);
    }
}
