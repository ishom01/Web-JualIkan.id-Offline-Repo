<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fish_size".
 *
 * @property int $fish_size_id
 * @property string $fish_size_name
 */
class FishSize extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fish_size';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fish_size_name'], 'required'],
            [['fish_size_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fish_size_id' => 'Fish Size ID',
            'fish_size_name' => 'Fish Size Name',
        ];
    }
}
