<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Delivery;

/**
 * DeliverySearch represents the model behind the search form of `frontend\models\Delivery`.
 */
class DeliverySearch extends Delivery
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['delivery_id', 'delivery_order_koperasi_id', 'delivery_driver_id', 'delivery_driver_track_id', 'delivery_travel_time', 'delivery_travel_distance', 'delivery_payment', 'delivery_status'], 'integer'],
            [['delivery_code', 'delivery_order_id', 'delivery_time_depart', 'delivery_time_arrival'], 'safe'],
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
        $query = Delivery::find();

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
            'delivery_id' => $this->delivery_id,
            'delivery_order_koperasi_id' => $this->delivery_order_koperasi_id,
            'delivery_driver_id' => $this->delivery_driver_id,
            'delivery_driver_track_id' => $this->delivery_driver_track_id,
            'delivery_time_depart' => $this->delivery_time_depart,
            'delivery_time_arrival' => $this->delivery_time_arrival,
            'delivery_travel_time' => $this->delivery_travel_time,
            'delivery_travel_distance' => $this->delivery_travel_distance,
            'delivery_payment' => $this->delivery_payment,
            'delivery_status' => $this->delivery_status,
        ]);

        $query->andFilterWhere(['like', 'delivery_code', $this->delivery_code])
            ->andFilterWhere(['like', 'delivery_order_id', $this->delivery_order_id]);

        return $dataProvider;
    }
}
