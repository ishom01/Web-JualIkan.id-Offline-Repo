<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "saldo_history".
 *
 * @property int $saldo_history_id
 * @property string $saldo_history_title
 * @property int $saldo_user_id
 * @property int $saldo_user_level
 * @property int $saldo_value
 */
class SaldoHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'saldo_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['saldo_history_title', 'saldo_user_id', 'saldo_user_level', 'saldo_value'], 'required'],
            [['saldo_user_id', 'saldo_user_level', 'saldo_value'], 'integer'],
            [['saldo_history_title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'saldo_history_id' => 'Saldo History ID',
            'saldo_history_title' => 'Saldo History Title',
            'saldo_user_id' => 'Saldo User ID',
            'saldo_user_level' => 'Saldo User Level',
            'saldo_value' => 'Saldo Value',
        ];
    }
}
