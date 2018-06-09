<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Kota;

/**
 * KotaSearch represents the model behind the search form of `backend\models\Kota`.
 */
class KotaSearch extends Kota
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kota_id', 'kota_provinsi_id'], 'integer'],
            [['kota_name'], 'safe'],
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
        $query = Kota::find();

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
            'kota_id' => $this->kota_id,
            'kota_provinsi_id' => $this->kota_provinsi_id,
        ]);

        $query->andFilterWhere(['like', 'kota_name', $this->kota_name]);

        return $dataProvider;
    }
}
