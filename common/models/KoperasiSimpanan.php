<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "koperasi_simpanan".
 *
 * @property int $simpanan_id
 * @property int $simpanan_koperasi_id
 * @property string $simpanan_date
 * @property int $simpanan_nelayan_id
 * @property string $simpanan_desc
 * @property int $simpanan_jumlah
 */
class KoperasiSimpanan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'koperasi_simpanan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['simpanan_koperasi_id', 'simpanan_date', 'simpanan_nelayan_id', 'simpanan_desc', 'simpanan_jumlah'], 'required'],
            [['simpanan_koperasi_id', 'simpanan_nelayan_id', 'simpanan_jumlah'], 'integer'],
            [['simpanan_date'], 'safe'],
            [['simpanan_desc'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'simpanan_id' => 'ID Simpanan',
            'simpanan_koperasi_id' => 'Nama Koperasi',
            'simpanan_date' => 'Tanggal Simpanan',
            'simpanan_nelayan_id' => 'Nama Nelayan',
            'simpanan_desc' => 'Deskripsi Simpanan',
            'simpanan_jumlah' => 'Jumlah Simpanan',
        ];
    }
}
