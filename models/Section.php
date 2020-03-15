<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "section".
 *
 * @property int $id
 * @property string $name
 * @property integer $is_visible
 */
class Section extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'section';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 200],
            [['name'], 'unique'],
            [['is_visible'], 'integer']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'is_visible' => 'Опубликовать'
        ];
    }

    public function getPresentations()
    {
        return Presentation::find()
            ->where(['section_id' => $this->id, 'is_visible' => 1])
            ->orderBy('ordering ASC')
            ->all();
    }

    public static function zeroPresentations()
    {
        return Presentation::find()
            ->where(['section_id' => 0, 'is_visible' => 1])
            ->orderBy('ordering ASC')
            ->all();
    }
}
