<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\KoperasiPinjaman;

/**
 * KoperasiPinjamanSearch represents the model behind the search form of `common\models\KoperasiPinjaman`.
 */
class KoperasiPinjamanSearch extends KoperasiPinjaman
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pinjaman_id', 'pinjaman_koperasi_id', 'pinjaman_nelayan_id', 'pinjaman_jumlah'], 'integer'],
            [['pinjaman_date', 'pinjaman_desc'], 'safe'],
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
        $query = KoperasiPinjaman::find();

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
            'pinjaman_id' => $this->pinjaman_id,
            'pinjaman_koperasi_id' => $this->pinjaman_koperasi_id,
            'pinjaman_nelayan_id' => $this->pinjaman_nelayan_id,
            'pinjaman_date' => $this->pinjaman_date,
            'pinjaman_jumlah' => $this->pinjaman_jumlah,
        ]);

        $query->andFilterWhere(['like', 'pinjaman_desc', $this->pinjaman_desc]);

        return $dataProvider;
    }
}
