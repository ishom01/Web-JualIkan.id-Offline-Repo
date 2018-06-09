<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_pengguna".
 *
 * @property int $user_id
 * @property string $user_full_name
 * @property string $user_image
 * @property string $user_phone
 * @property string $user_email
 * @property string $user_password
 * @property string $user_device_id
 * @property int $user_kota_id
 * @property string $user_address
 * @property int $user_saldo
 */
class UserPengguna extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_pengguna';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_full_name', 'user_image', 'user_phone', 'user_email', 'user_password', 'user_device_id', 'user_kota_id', 'user_address', 'user_saldo'], 'required'],
            [['user_image', 'user_address'], 'string'],
            [['user_kota_id', 'user_saldo'], 'integer'],
            [['user_full_name', 'user_email', 'user_password', 'user_device_id'], 'string', 'max' => 100],
            [['user_phone'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_full_name' => 'User Full Name',
            'user_image' => 'User Image',
            'user_phone' => 'User Phone',
            'user_email' => 'User Email',
            'user_password' => 'User Password',
            'user_device_id' => 'User Device ID',
            'user_kota_id' => 'User Kota ID',
            'user_address' => 'User Address',
            'user_saldo' => 'User Saldo',
        ];
    }
}
