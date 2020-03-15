<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "photo".
 *
 * @property int $id
 * @property string $name
 * @property string|null $title
 * @property int $is_visible
 *
 * @property Like[] $likes
 * @property Person[] $people
 * @property string $thumb
 * @property string $wide
 * @property string $origin
 */
class Photo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['is_visible'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['title'], 'string', 'max' => 100],
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
            'title' => 'Подпись к фото',
            'is_visible' => 'Опубликовать',
        ];
    }

    /**
     * Gets query for [[Likes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Like::className(), ['photo_id' => 'id']);
    }

    /**
     * Gets query for [[People]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['id' => 'person_id'])->viaTable('like', ['photo_id' => 'id']);
    }

    public function getThumb()
    {
        return '/web/galery/' . $this->name . '-s.jpg';
    }

    public function getWide()
    {
        return '/web/galery/' . $this->name . '-m.jpg';
    }
    
    public function getOrigin()
    {
        return '/web/galery/' . $this->name . '.jpg';
    }
}
