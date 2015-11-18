<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Sell;

/**
 * SellSearch represents the model behind the search form about `common\models\Sell`.
 */
class SellSearch extends Sell
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sell_order_id', 'departement_id', 'customer_user_id', 'created_user_id', 'subtotal', 'discount', 'ppn', 'other', 'dp', 'credit', 'payment', 'total'], 'integer'],
            [['code', 'created', 'modified', 'description', 'term', 'resi'], 'safe'],
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
        $query = Sell::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'sell_order_id' => $this->sell_order_id,
            'departement_id' => $this->departement_id,
            'customer_user_id' => $this->customer_user_id,
            'created' => $this->created,
            'created_user_id' => $this->created_user_id,
            'modified' => $this->modified,
            'subtotal' => $this->subtotal,
            'discount' => $this->discount,
            'ppn' => $this->ppn,
            'other' => $this->other,
            'term' => $this->term,
            'dp' => $this->dp,
            'credit' => $this->credit,
            'payment' => $this->payment,
            'total' => $this->total,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'resi', $this->resi]);

        return $dataProvider;
    }
}
