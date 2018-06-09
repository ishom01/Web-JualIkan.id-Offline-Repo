<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_nelayan".
 *
 * @property int $nelayan_id
 * @property string $nelayan_full_name
 * @property string $nelayan_image
 * @property string $nelayan_phone
 * @property int $nelayan_cooperative_id
 * @property string $nelayan_address
 * @property int $nelayan_saldo
 */
class UserNelayan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_nelayan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nelayan_full_name', 'nelayan_image', 'nelayan_phone', 'nelayan_cooperative_id', 'nelayan_address', 'nelayan_saldo'], 'required'],
            [['nelayan_image', 'nelayan_address'], 'string'],
            [['nelayan_cooperative_id', 'nelayan_saldo'], 'integer'],
            [['nelayan_full_name'], 'string', 'max' => 100],
            [['nelayan_phone'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nelayan_id' => 'ID Nelayaan',
            'nelayan_full_name' => 'Nama Lengkap Nelayan',
            'nelayan_image' => 'Gambar Nelayan',
            'nelayan_phone' => 'No Telp Nelayan',
            'nelayan_cooperative_id' => 'Nama Koperasi Nelayan',
            'nelayan_address' => 'Alamat Nelayan',
            'nelayan_saldo' => 'Saldo Nelayan',
        ];
    }
}
