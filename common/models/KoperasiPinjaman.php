<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "koperasi_pinjaman".
 *
 * @property int $pinjaman_id
 * @property int $pinjaman_koperasi_id
 * @property int $pinjaman_nelayan_id
 * @property string $pinjaman_date
 * @property string $pinjaman_desc
 * @property int $pinjaman_jumlah
 */
class KoperasiPinjaman extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'koperasi_pinjaman';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pinjaman_koperasi_id', 'pinjaman_nelayan_id', 'pinjaman_date', 'pinjaman_desc', 'pinjaman_jumlah'], 'required'],
            [['pinjaman_koperasi_id', 'pinjaman_nelayan_id', 'pinjaman_jumlah'], 'integer'],
            [['pinjaman_date'], 'safe'],
            [['pinjaman_desc'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pinjaman_id' => 'ID Peminjaman',
            'pinjaman_koperasi_id' => 'Nama Koperasi',
            'pinjaman_nelayan_id' => 'Nama Nelayan',
            'pinjaman_date' => 'Tanggal Pinjaman',
            'pinjaman_desc' => 'Keterangan Pinjaman',
            'pinjaman_jumlah' => 'Jumlah Pinjaman',
        ];
    }
}
