<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property int $id
 * @property string $surname
 * @property string $name
 * @property string|null $name_2
 * @property string|null $vocation
 * @property int $person_role_id
 * @property string $organization
 * @property string $info
 * @property string|null $photo
 * @property int|null $is_visible
 *
 * @property Like[] $likes
 * @property Photo[] $photos
 * @property Mark[] $marks
 * @property PersonRole $personRole
 * @property PresentationPerson[] $presentationPeople
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['surname', 'name', 'person_role_id', 'organization'], 'required'],
            [['person_role_id', 'is_visible'], 'integer'],
            [['surname', 'name', 'name_2'], 'string', 'max' => 30],
            [['vocation', 'organization'], 'string', 'max' => 200],
            [['photo'], 'string', 'max' => 100],
            [['info'], 'string'],
            [['person_role_id'], 'exist', 'skipOnError' => true, 'targetClass' => PersonRole::className(), 'targetAttribute' => ['person_role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'surname' => 'Фамилия',
            'name' => 'Имя',
            'name_2' => 'Отчество',
            'vocation' => 'Должность',
            'info' => 'Информация об участнике',
            'person_role_id' => 'Роль на конференции',
            'organization' => 'Наименование организации',
            'photo' => 'Фото',
            'is_visible' => 'Активный',
        ];
    }

    public function getNameSurname() {
        return $this->name . ' ' . $this->surname;
    }

    public function getSurnameName() {
        return $this->surname . ' ' . $this->name;
    }

    /**
     * Gets query for [[Likes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Like::className(), ['person_id' => 'id']);
    }

    /**
     * Gets query for [[Photos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(Photo::className(), ['id' => 'photo_id'])->viaTable('like', ['person_id' => 'id']);
    }

    /**
     * Gets query for [[Marks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarks()
    {
        return $this->hasMany(Mark::className(), ['jury_id' => 'id']);
    }

    /**
     * Gets query for [[PersonRole]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonRole()
    {
        return $this->hasOne(PersonRole::className(), ['id' => 'person_role_id']);
    }

    /**
     * Gets query for [[PresentationPeople]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPresentationPeople()
    {
        return $this->hasMany(PresentationPerson::className(), ['person_id' => 'id']);
    }

}
