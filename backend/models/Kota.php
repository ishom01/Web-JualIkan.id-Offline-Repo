<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "kota".
 *
 * @property int $kota_id
 * @property int $kota_provinsi_id
 * @property string $kota_name
 */
class Kota extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kota';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kota_provinsi_id', 'kota_name'], 'required'],
            [['kota_provinsi_id'], 'integer'],
            [['kota_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kota_id' => 'Kota ID',
            'kota_provinsi_id' => 'Kota Provinsi ID',
            'kota_name' => 'Kota Name',
        ];
    }
}
