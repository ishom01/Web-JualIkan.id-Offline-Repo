<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserDriver;

/**
 * UserDriverSearch represents the model behind the search form of `common\models\UserDriver`.
 */
class UserDriverSearch extends UserDriver
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['driver_id', 'driver_koperasi_id', 'driver_vehicle_weight', 'driver_saldo', 'driver_status'], 'integer'],
            [['driver_full_name', 'driver_phone', 'driver_email', 'driver_password', 'driver_device_id', 'driver_image', 'driver_address'], 'safe'],
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
        $query = UserDriver::find();

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
            'driver_id' => $this->driver_id,
            'driver_koperasi_id' => $this->driver_koperasi_id,
            'driver_vehicle_weight' => $this->driver_vehicle_weight,
            'driver_saldo' => $this->driver_saldo,
            'driver_status' => $this->driver_status,
        ]);

        $query->andFilterWhere(['like', 'driver_full_name', $this->driver_full_name])
            ->andFilterWhere(['like', 'driver_phone', $this->driver_phone])
            ->andFilterWhere(['like', 'driver_email', $this->driver_email])
            ->andFilterWhere(['like', 'driver_password', $this->driver_password])
            ->andFilterWhere(['like', 'driver_device_id', $this->driver_device_id])
            ->andFilterWhere(['like', 'driver_image', $this->driver_image])
            ->andFilterWhere(['like', 'driver_address', $this->driver_address]);

        return $dataProvider;
    }
}
