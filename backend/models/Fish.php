<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fish".
 *
 * @property int $fish_id
 * @property string $fish_image
 * @property string $fish_name
 * @property int $fish_price
 * @property int $fish_koperasi_id
 * @property int $fish_category_id
 * @property int $fish_condition_id
 * @property int $fish_size_id
 * @property int $fish_stock
 * @property string $fish_description
 * @property string $fish_date
 */
class Fish extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fish';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fish_name', 'fish_price', 'fish_koperasi_id', 'fish_category_id', 'fish_condition_id', 'fish_size_id', 'fish_stock', 'fish_description', 'fish_date'], 'required'],
            [['fish_image', 'fish_description'], 'string'],
            [['fish_price', 'fish_koperasi_id', 'fish_category_id', 'fish_condition_id', 'fish_size_id', 'fish_stock'], 'integer'],
            [['fish_date'], 'safe'],
            [['fish_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fish_id' => 'Fish ID',
            'fish_image' => 'Fish Image',
            'fish_name' => 'Fish Name',
            'fish_price' => 'Fish Price',
            'fish_koperasi_id' => 'Fish Koperasi ID',
            'fish_category_id' => 'Fish Category ID',
            'fish_condition_id' => 'Fish Condition ID',
            'fish_size_id' => 'Fish Size ID',
            'fish_stock' => 'Fish Stock',
            'fish_description' => 'Fish Description',
            'fish_date' => 'Fish Date',
        ];
    }
}
