<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductSearch represents the model behind the search form about `app\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_brand_id', 'product_category_id', 'product_measure_id', 'price_sell', 'price_buy', 'discount', 'product_photo_id', 'created_user_id', 'hits'], 'integer'],
            [['code', 'name', 'alias', 'type', 'description', 'stock', 'created', 'modified', 'assembly_product_id'], 'safe'],
            [['stock_min', 'stock_max', 'weight', 'width', 'height', 'length'], 'number'],
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
        $query = Product::find();

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
            'product_brand_id' => $this->product_brand_id,
            'product_category_id' => $this->product_category_id,
            'product_measure_id' => $this->product_measure_id,
            'price_sell' => $this->price_sell,
            'price_buy' => $this->price_buy,
            'discount' => $this->discount,
            'stock_min' => $this->stock_min,
            'stock_max' => $this->stock_max,
            'product_photo_id' => $this->product_photo_id,
            'weight' => $this->weight,
            'width' => $this->width,
            'height' => $this->height,
            'length' => $this->length,
            'created' => $this->created,
            'created_user_id' => $this->created_user_id,
            'modified' => $this->modified,
            'hits' => $this->hits,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'stock', $this->stock])
            ->andFilterWhere(['like', 'assembly_product_id', $this->assembly_product_id]);

        return $dataProvider;
    }
}
