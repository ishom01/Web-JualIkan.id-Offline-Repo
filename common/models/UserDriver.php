<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_driver".
 *
 * @property int $driver_id
 * @property string $driver_full_name
 * @property string $driver_phone
 * @property string $driver_email
 * @property string $driver_password
 * @property string $driver_device_id
 * @property string $driver_image
 * @property int $driver_koperasi_id
 * @property int $driver_vehicle_weight
 * @property string $driver_address
 * @property int $driver_saldo
 * @property int $driver_status
 */
class UserDriver extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_driver';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['driver_full_name', 'driver_phone', 'driver_email', 'driver_password', 'driver_koperasi_id', 'driver_vehicle_weight', 'driver_address'], 'required'],
            [['driver_image', 'driver_address'], 'string'],
            [['driver_koperasi_id', 'driver_vehicle_weight', 'driver_saldo', 'driver_status'], 'integer'],
            [['driver_full_name', 'driver_email'], 'string', 'max' => 100],
            [['driver_phone'], 'string', 'max' => 12],
            [['driver_password'], 'string', 'max' => 150],
            [['driver_device_id'], 'string', 'max' => 191],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'driver_id' => 'ID Driver',
            'driver_full_name' => 'Nama Lengkap Driver',
            'driver_phone' => 'No HP Driver',
            'driver_email' => 'Email Driver',
            'driver_password' => 'Password Driver',
            'driver_device_id' => 'Device Driver ID',
            'driver_image' => 'Foto Driver',
            'driver_koperasi_id' => 'Nama Koperasi',
            'driver_vehicle_weight' => 'Muatan Maks',
            'driver_address' => 'Alamat Driver',
            'driver_saldo' => 'Saldo Driver',
            'driver_status' => 'Status Driver',
        ];
    }
}
