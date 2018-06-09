<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payment_type".
 *
 * @property int $payment_type_id
 * @property string $payment_type_name
 */
class PaymentType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_type_name'], 'required'],
            [['payment_type_name'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'payment_type_id' => 'Payment Type ID',
            'payment_type_name' => 'Payment Type Name',
        ];
    }
}
