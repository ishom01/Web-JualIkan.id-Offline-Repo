<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $order_id
 * @property string $order_cart_id
 * @property int $order_user_id
 * @property string $order_location_adress
 * @property string $order_location_lat
 * @property string $order_location_lng
 * @property int $order_driver_id
 * @property int $order_drive_track_id
 * @property int $order_koperasi_location_id
 * @property int $order_delivery_time
 * @property int $order_delivery_distance
 * @property int $order_delivery_payment
 * @property string $order_delivery_payment_url
 * @property int $order_weight
 * @property string $order_date
 * @property int $order_payment_type_id
 * @property int $order_payment_total
 * @property int $order_delivery_time_id
 * @property int $order_status
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_cart_id', 'order_user_id', 'order_location_adress', 'order_location_lat', 'order_location_lng', 'order_driver_id', 'order_drive_track_id', 'order_koperasi_location_id', 'order_delivery_time', 'order_delivery_distance', 'order_delivery_payment', 'order_delivery_payment_url', 'order_weight', 'order_date', 'order_payment_type_id', 'order_payment_total', 'order_delivery_time_id', 'order_status'], 'required'],
            [['order_cart_id', 'order_location_adress', 'order_delivery_payment_url'], 'string'],
            [['order_user_id', 'order_driver_id', 'order_drive_track_id', 'order_koperasi_location_id', 'order_delivery_time', 'order_delivery_distance', 'order_delivery_payment', 'order_weight', 'order_payment_type_id', 'order_payment_total', 'order_delivery_time_id', 'order_status'], 'integer'],
            [['order_date'], 'safe'],
            [['order_location_lat', 'order_location_lng'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'order_cart_id' => 'Order Cart ID',
            'order_user_id' => 'Order User ID',
            'order_location_adress' => 'Order Location Adress',
            'order_location_lat' => 'Order Location Lat',
            'order_location_lng' => 'Order Location Lng',
            'order_driver_id' => 'Order Driver ID',
            'order_drive_track_id' => 'Order Drive Track ID',
            'order_koperasi_location_id' => 'Order Koperasi Location ID',
            'order_delivery_time' => 'Order Delivery Time',
            'order_delivery_distance' => 'Order Delivery Distance',
            'order_delivery_payment' => 'Order Delivery Payment',
            'order_delivery_payment_url' => 'Order Delivery Payment Url',
            'order_weight' => 'Order Weight',
            'order_date' => 'Order Date',
            'order_payment_type_id' => 'Order Payment Type ID',
            'order_payment_total' => 'Order Payment Total',
            'order_delivery_time_id' => 'Order Delivery Time ID',
            'order_status' => 'Order Status',
        ];
    }
}
