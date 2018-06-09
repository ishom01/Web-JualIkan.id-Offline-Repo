<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fish_condition".
 *
 * @property int $fish_condition_id
 * @property string $fish_condition_name
 */
class FishCondition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fish_condition';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fish_condition_name'], 'required'],
            [['fish_condition_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fish_condition_id' => 'Fish Condition ID',
            'fish_condition_name' => 'Fish Condition Name',
        ];
    }
}
