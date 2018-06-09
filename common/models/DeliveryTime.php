<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "delivery_time".
 *
 * @property int $delivery_time_id
 * @property string $delivery_time_name
 * @property string $delivery_time_start
 * @property string $delivery_time_end
 */
class DeliveryTime extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'delivery_time';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['delivery_time_name', 'delivery_time_start', 'delivery_time_end'], 'required'],
            [['delivery_time_start', 'delivery_time_end'], 'safe'],
            [['delivery_time_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'delivery_time_id' => 'Delivery Time ID',
            'delivery_time_name' => 'Delivery Time Name',
            'delivery_time_start' => 'Delivery Time Start',
            'delivery_time_end' => 'Delivery Time End',
        ];
    }
}
