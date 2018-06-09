<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cart".
 *
 * @property int $cart_id
 * @property int $cart_fish_id
 * @property int $cart_fish_qty
 * @property int $cart_user_id
 * @property int $cart_status
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cart_fish_id', 'cart_fish_qty', 'cart_user_id', 'cart_status'], 'required'],
            [['cart_fish_id', 'cart_fish_qty', 'cart_user_id', 'cart_status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cart_id' => 'Cart ID',
            'cart_fish_id' => 'Cart Fish ID',
            'cart_fish_qty' => 'Cart Fish Qty',
            'cart_user_id' => 'Cart User ID',
            'cart_status' => 'Cart Status',
        ];
    }
}
