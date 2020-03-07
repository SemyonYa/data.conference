<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PresentationPerson;

/**
 * PresentationPersonSearch represents the model behind the search form of `app\models\PresentationPerson`.
 */
class PresentationPersonSearch extends PresentationPerson
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'presentation_id', 'person_id', 'is_coauthor'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PresentationPerson::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'presentation_id' => $this->presentation_id,
            'person_id' => $this->person_id,
            'is_coauthor' => $this->is_coauthor,
        ]);

        return $dataProvider;
    }
}
