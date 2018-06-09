<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "koperasi_level".
 *
 * @property int $koperasi_level_id
 * @property string $koperasi_level_name
 * @property string $koperasi_level_desc
 */
class KoperasiLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'koperasi_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['koperasi_level_name', 'koperasi_level_desc'], 'required'],
            [['koperasi_level_desc'], 'string'],
            [['koperasi_level_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'koperasi_level_id' => 'Koperasi Level ID',
            'koperasi_level_name' => 'Koperasi Level Name',
            'koperasi_level_desc' => 'Koperasi Level Desc',
        ];
    }
}
