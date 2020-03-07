<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "doc".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $path
 * @property int $is_visible
 * @property string|null $extension
 * @property int|null $ordering
 * @property int|null $presentation_id
 *
 * @property Presentation $presentation
 */
class Doc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'path'], 'required'],
            [['description'], 'string'],
            [['is_visible', 'ordering', 'presentation_id'], 'integer'],
            [['name'], 'string', 'max' => 200],
            // [['path'], 'string', 'max' => 100],
            [['path'], 'file', 'skipOnEmpty' => true],
            [['extension'], 'string', 'max' => 10],
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
            'name' => 'Name',
            'description' => 'Description',
            'path' => 'Path',
            'is_visible' => 'Is Visible',
            'extension' => 'Extension',
            'ordering' => 'Ordering',
            'presentation_id' => 'Presentation ID',
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

    public function upload($file) {
        $extension = array_pop(explode('.',  array_shift($file['name'])));
        $tmp= array_shift($file['tmp_name']);
        $name = Yii::$app->security->generateRandomString() . '.' . $extension;
        rename($tmp, Yii::getAlias('@webroot/docs/' . $name));
        return [
            'path' => $name,
            'extension' => $extension
        ];
    }



}
