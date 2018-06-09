<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\KoperasiLevel;

/**
 * KoperasiLevelSearch represents the model behind the search form of `backend\models\KoperasiLevel`.
 */
class KoperasiLevelSearch extends KoperasiLevel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['koperasi_level_id'], 'integer'],
            [['koperasi_level_name', 'koperasi_level_desc'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = KoperasiLevel::find();

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
            'koperasi_level_id' => $this->koperasi_level_id,
        ]);

        $query->andFilterWhere(['like', 'koperasi_level_name', $this->koperasi_level_name])
            ->andFilterWhere(['like', 'koperasi_level_desc', $this->koperasi_level_desc]);

        return $dataProvider;
    }
}
