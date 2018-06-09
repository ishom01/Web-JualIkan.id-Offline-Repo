<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fish_review".
 *
 * @property int $id
 * @property int $user_id
 * @property int $fish_id
 * @property int $koperasi_id
 * @property string $review_text
 * @property int $review_jumalh
 */
class FishReview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fish_review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'fish_id', 'koperasi_id', 'review_text', 'review_jumalh'], 'required'],
            [['user_id', 'fish_id', 'koperasi_id', 'review_jumalh'], 'integer'],
            [['review_text'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID Review',
            'user_id' => 'Nama User',
            'fish_id' => 'Nama Ikan',
            'koperasi_id' => 'Nama Koperasi',
            'review_text' => 'Review',
            'review_jumalh' => 'Rating',
        ];
    }
}
