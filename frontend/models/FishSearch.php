<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Fish;
use frontend\models\UserKoperasi;

/**
 * FishSearch represents the model behind the search form of `backend\models\Fish`.
 */
class FishSearch extends Fish
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fish_id', 'fish_price', 'fish_koperasi_id', 'fish_category_id', 'fish_condition_id', 'fish_size_id', 'fish_stock'], 'integer'],
            [['fish_image', 'fish_name', 'fish_description', 'fish_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $object = UserKoperasi::find()->where(['koperasi_email' => Yii::$app->user->identity->username])->one();
        $query = Fish::find()->where(['fish_koperasi_id' => $object->koperasi_id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'fish_id' => $this->fish_id,
            'fish_price' => $this->fish_price,
            'fish_koperasi_id' => $this->fish_koperasi_id,
            'fish_category_id' => $this->fish_category_id,
            'fish_condition_id' => $this->fish_condition_id,
            'fish_size_id' => $this->fish_size_id,
            'fish_stock' => $this->fish_stock,
            'fish_date' => $this->fish_date,
        ]);

        $query->andFilterWhere(['like', 'fish_image', $this->fish_image])
            ->andFilterWhere(['like', 'fish_name', $this->fish_name])
            ->andFilterWhere(['like', 'fish_description', $this->fish_description]);

        return $dataProvider;
    }
}
