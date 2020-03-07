<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "presentation_doc".
 *
 * @property int $id
 * @property int $presentation_id
 * @property int $doc_id
 * @property int $ordering
 *
 * @property Doc $doc
 * @property Presentation $presentation
 */
class PresentationDoc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'presentation_doc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['presentation_id', 'doc_id', 'ordering'], 'required'],
            [['presentation_id', 'doc_id', 'ordering'], 'integer'],
            [['doc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Doc::className(), 'targetAttribute' => ['doc_id' => 'id']],
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
            'presentation_id' => 'Presentation ID',
            'doc_id' => 'Doc ID',
            'ordering' => 'Ordering',
        ];
    }

    /**
     * Gets query for [[Doc]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDoc()
    {
        return $this->hasOne(Doc::className(), ['id' => 'doc_id']);
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
