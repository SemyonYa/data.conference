<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mark".
 *
 * @property int $id
 * @property int $rating_id
 * @property string $description
 * @property int $jury_id
 * @property int $presentation_id
 *
 * @property Person $jury
 * @property Presentation $presentation
 * @property Rating $rating
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
            [['rating_id', 'jury_id', 'presentation_id'], 'required'],
            [['rating_id', 'jury_id', 'presentation_id'], 'integer'],
            [['description'], 'string', 'max' => 200],
            [['jury_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['jury_id' => 'id']],
            [['presentation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Presentation::className(), 'targetAttribute' => ['presentation_id' => 'id']],
            [['rating_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rating::className(), 'targetAttribute' => ['rating_id' => 'id']],
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

    /**
     * Gets query for [[Rating]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRating()
    {
        return $this->hasOne(Rating::className(), ['id' => 'rating_id']);
    }
}
