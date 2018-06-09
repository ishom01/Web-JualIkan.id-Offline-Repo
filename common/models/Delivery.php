<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "delivery".
 *
 * @property int $delivery_id
 * @property string $delivery_code
 * @property string $delivery_order_id
 * @property int $delivery_order_koperasi_id
 * @property int $delivery_driver_id
 * @property int $delivery_driver_track_id
 * @property string $delivery_time_depart
 * @property string $delivery_time_arrival
 * @property int $delivery_travel_time
 * @property int $delivery_travel_distance
 * @property int $delivery_payment
 * @property int $delivery_status
 */
class Delivery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'delivery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['delivery_code', 'delivery_order_id', 'delivery_order_koperasi_id', 'delivery_driver_id', 'delivery_driver_track_id', 'delivery_time_depart', 'delivery_time_arrival', 'delivery_travel_time', 'delivery_travel_distance', 'delivery_payment', 'delivery_status'], 'required'],
            [['delivery_order_id'], 'string'],
            [['delivery_order_koperasi_id', 'delivery_driver_id', 'delivery_driver_track_id', 'delivery_travel_time', 'delivery_travel_distance', 'delivery_payment', 'delivery_status'], 'integer'],
            [['delivery_time_depart', 'delivery_time_arrival'], 'safe'],
            [['delivery_code'], 'string', 'max' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'delivery_id' => 'Delivery ID',
            'delivery_code' => 'Delivery Code',
            'delivery_order_id' => 'Delivery Order ID',
            'delivery_order_koperasi_id' => 'Delivery Order Koperasi ID',
            'delivery_driver_id' => 'Delivery Driver ID',
            'delivery_driver_track_id' => 'Delivery Driver Track ID',
            'delivery_time_depart' => 'Delivery Time Depart',
            'delivery_time_arrival' => 'Delivery Time Arrival',
            'delivery_travel_time' => 'Delivery Travel Time',
            'delivery_travel_distance' => 'Delivery Travel Distance',
            'delivery_payment' => 'Delivery Payment',
            'delivery_status' => 'Delivery Status',
        ];
    }
}
