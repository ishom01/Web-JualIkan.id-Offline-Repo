<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fish_category".
 *
 * @property int $fish_category_id
 * @property string $fish_category_name
 */
class FishCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fish_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fish_category_name'], 'required'],
            [['fish_category_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fish_category_id' => 'Fish Category ID',
            'fish_category_name' => 'Fish Category Name',
        ];
    }
}
