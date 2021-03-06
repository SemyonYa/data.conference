<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mark".
 *
 * @property int $id
 * @property int|null $rating_id
 * @property string|null $description
 * @property int $jury_id
 * @property int $presentation_id
 *
 * @property Person $jury
 * @property Presentation $presentation
 */
class Mark extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mark';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rating_id', 'jury_id', 'presentation_id'], 'integer'],
            [['jury_id', 'presentation_id'], 'required'],
            [['description'], 'string', 'max' => 200],
            [['jury_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['jury_id' => 'id']],
            [['presentation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Presentation::className(), 'targetAttribute' => ['presentation_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rating_id' => 'Rating ID',
            'description' => 'Description',
            'jury_id' => 'Jury ID',
            'presentation_id' => 'Presentation ID',
        ];
    }

    /**
     * Gets query for [[Jury]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJury()
    {
        return $this->hasOne(Person::className(), ['id' => 'jury_id']);
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
}
