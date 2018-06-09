<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserKoperasi;

/**
 * UserKoperasiSearch represents the model behind the search form of `backend\models\UserKoperasi`.
 */
class UserKoperasiSearch extends UserKoperasi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['koperasi_id', 'koperasi_level_id', 'koperasi_kota_id', 'koperasi_status'], 'integer'],
            [['koperasi_name', 'kopreasi_image', 'koperasi_holder_name', 'koperasi_holder_phone', 'koperasi_email', 'koperasi_password', 'koperasi_address', 'koperasi_lat', 'koperasi_lng'], 'safe'],
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
        $query = UserKoperasi::find();

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
            'koperasi_id' => $this->koperasi_id,
            'koperasi_level_id' => $this->koperasi_level_id,
            'koperasi_kota_id' => $this->koperasi_kota_id,
            'koperasi_status' => $this->koperasi_status,
        ]);

        $query->andFilterWhere(['like', 'koperasi_name', $this->koperasi_name])
            ->andFilterWhere(['like', 'kopreasi_image', $this->kopreasi_image])
            ->andFilterWhere(['like', 'koperasi_holder_name', $this->koperasi_holder_name])
            ->andFilterWhere(['like', 'koperasi_holder_phone', $this->koperasi_holder_phone])
            ->andFilterWhere(['like', 'koperasi_email', $this->koperasi_email])
            ->andFilterWhere(['like', 'koperasi_password', $this->koperasi_password])
            ->andFilterWhere(['like', 'koperasi_address', $this->koperasi_address])
            ->andFilterWhere(['like', 'koperasi_lat', $this->koperasi_lat])
            ->andFilterWhere(['like', 'koperasi_lng', $this->koperasi_lng]);

        return $dataProvider;
    }
}
