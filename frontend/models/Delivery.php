<?php

namespace frontend\models;

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
            'delivery_id' => 'ID Pengiriman',
            'delivery_code' => 'Kode Pengiriman',
            'delivery_order_id' => 'ID Pengiriman Order',
            'delivery_order_koperasi_id' => 'Nama Koperasi',
            'delivery_driver_id' => 'Nama Driver',
            'delivery_driver_track_id' => 'Delivery Driver Track ID',
            'delivery_time_depart' => 'Waktu Keberangkatan',
            'delivery_time_arrival' => 'Waktu Tiba',
            'delivery_travel_time' => 'Waktu Tempuh Pengriman',
            'delivery_travel_distance' => 'Jarak Tempuh Pengriman',
            'delivery_payment' => 'Biaya Pengriman',
            'delivery_status' => 'Status Pengiriman',
        ];
    }
}
