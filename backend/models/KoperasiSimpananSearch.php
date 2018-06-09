<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\KoperasiSimpanan;

/**
 * KoperasiSimpananSearch represents the model behind the search form of `common\models\KoperasiSimpanan`.
 */
class KoperasiSimpananSearch extends KoperasiSimpanan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['simpanan_id', 'simpanan_koperasi_id', 'simpanan_nelayan_id', 'simpanan_jumlah'], 'integer'],
            [['simpanan_date', 'simpanan_desc'], 'safe'],
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
        $query = KoperasiSimpanan::find();

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
            'simpanan_id' => $this->simpanan_id,
            'simpanan_koperasi_id' => $this->simpanan_koperasi_id,
            'simpanan_date' => $this->simpanan_date,
            'simpanan_nelayan_id' => $this->simpanan_nelayan_id,
            'simpanan_jumlah' => $this->simpanan_jumlah,
        ]);

        $query->andFilterWhere(['like', 'simpanan_desc', $this->simpanan_desc]);

        return $dataProvider;
    }
}
