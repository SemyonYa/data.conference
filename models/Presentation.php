<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "presentation".
 *
 * @property int $id
 * @property int $ordering
 * @property int $section_id
 * @property string $name
 * @property string $description
 * @property string $organization
 * @property int|null $is_visible
 *
 * @property Doc[] $docs
 * @property Mark[] $marks
 * @property PresentationPerson[] $presentationPeople
 * @property SchedulePresentation[] $schedulePresentations
 */
class Presentation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'presentation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'organization'], 'required'],
            [['description'], 'string'],
            [['is_visible', 'section_id', 'ordering'], 'integer'],
            [['name', 'organization'], 'string', 'max' => 200],
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
            'description' => 'Аннотация',
            'section_id' => 'Секция (не обязательно)',
            'ordering' => 'Сортировка',
            'organization' => 'Организация',
            'is_visible' => 'Опубликовать',
        ];
    }

    /**
     * Gets query for [[Docs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocs()
    {
        return $this->hasMany(Doc::className(), ['presentation_id' => 'id']);
    }

    /**
     * Gets query for [[Marks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarks()
    {
        return $this->hasMany(Mark::className(), ['presentation_id' => 'id']);
    }

    /**
     * Gets query for [[PresentationPeople]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPresentationPeople()
    {
        return $this->hasMany(PresentationPerson::className(), ['presentation_id' => 'id']);
    }

    /**
     * Gets query for [[SchedulePresentations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSchedulePresentations()
    {
        return $this->hasMany(SchedulePresentation::className(), ['presentation_id' => 'id']);
    }

    public function getSection() {
        return Section::findOne($this->section_id);
    }
}
