<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "person_role".
 *
 * @property int $id
 * @property string $name
 * @property integer $ordering
 * @property integer $is_visible
 *
 * @property Person[] $people
 */
class PersonRole extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'person_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['is_visible', 'ordering'], 'integer'],
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
            'is_visible' => 'Показывать',
            'ordering' => 'Сортировка',
        ];
    }

    /**
     * Gets query for [[People]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['person_role_id' => 'id']);
    }
}
