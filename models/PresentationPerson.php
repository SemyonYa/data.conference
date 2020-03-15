<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "presentation_person".
 *
 * @property int $id
 * @property int $presentation_id
 * @property int $person_id
 * @property int $is_coauthor
 *
 * @property Presentation $presentation
 * @property Person $person
 */
class PresentationPerson extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'presentation_person';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['presentation_id', 'person_id'], 'required'],
            [['presentation_id', 'person_id', 'is_coauthor'], 'integer'],
            [['presentation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Presentation::className(), 'targetAttribute' => ['presentation_id' => 'id']],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['person_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'presentation_id' => 'Presentation ID',
            'person_id' => 'Person ID',
            'is_coauthor' => 'Является соавтором',
        ];
    }

    /**
     * Gets query for [[Presentation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPresentation()
    {
        return $this->hasOne(Presentation::className(), ['id' => 'presentation_id']);
    }

    /**
     * Gets query for [[Person]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'person_id']);
    }
}
