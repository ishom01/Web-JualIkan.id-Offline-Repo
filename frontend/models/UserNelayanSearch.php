<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserNelayan;

/**
 * UserNelayanSearch represents the model behind the search form of `common\models\UserNelayan`.
 */
class UserNelayanSearch extends UserNelayan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nelayan_id', 'nelayan_cooperative_id', 'nelayan_saldo'], 'integer'],
            [['nelayan_full_name', 'nelayan_image', 'nelayan_phone', 'nelayan_address'], 'safe'],
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
        $query = UserNelayan::find();

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
            'nelayan_id' => $this->nelayan_id,
            'nelayan_cooperative_id' => $this->nelayan_cooperative_id,
            'nelayan_saldo' => $this->nelayan_saldo,
        ]);

        $query->andFilterWhere(['like', 'nelayan_full_name', $this->nelayan_full_name])
            ->andFilterWhere(['like', 'nelayan_image', $this->nelayan_image])
            ->andFilterWhere(['like', 'nelayan_phone', $this->nelayan_phone])
            ->andFilterWhere(['like', 'nelayan_address', $this->nelayan_address]);

        return $dataProvider;
    }
}
