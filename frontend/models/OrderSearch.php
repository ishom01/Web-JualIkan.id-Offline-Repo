<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Order;

/**
 * OrderSearch represents the model behind the search form of `common\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'order_user_id', 'order_driver_id', 'order_drive_track_id', 'order_koperasi_location_id', 'order_delivery_time', 'order_delivery_distance', 'order_delivery_payment', 'order_weight', 'order_payment_type_id', 'order_payment_total', 'order_delivery_time_id', 'order_status'], 'integer'],
            [['order_cart_id', 'order_location_adress', 'order_location_lat', 'order_location_lng', 'order_delivery_payment_url', 'order_date'], 'safe'],
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
        $query = Order::find();

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
            'order_id' => $this->order_id,
            'order_user_id' => $this->order_user_id,
            'order_driver_id' => $this->order_driver_id,
            'order_drive_track_id' => $this->order_drive_track_id,
            'order_koperasi_location_id' => $this->order_koperasi_location_id,
            'order_delivery_time' => $this->order_delivery_time,
            'order_delivery_distance' => $this->order_delivery_distance,
            'order_delivery_payment' => $this->order_delivery_payment,
            'order_weight' => $this->order_weight,
            'order_payment_type_id' => $this->order_payment_type_id,
            'order_payment_total' => $this->order_payment_total,
            'order_delivery_time_id' => $this->order_delivery_time_id,
            'order_status' => $this->order_status,
        ]);

        $query->andFilterWhere(['like', 'order_cart_id', $this->order_cart_id])
            ->andFilterWhere(['like', 'order_location_adress', $this->order_location_adress])
            ->andFilterWhere(['like', 'order_date', $this->order_date])
            ->andFilterWhere(['like', 'order_location_lat', $this->order_location_lat])
            ->andFilterWhere(['like', 'order_location_lng', $this->order_location_lng])
            ->andFilterWhere(['like', 'order_delivery_payment_url', $this->order_delivery_payment_url]);

        return $dataProvider;
    }
}
