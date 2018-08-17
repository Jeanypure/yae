<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Goodssku;

/**
 * GoodsskuSearch represents the model behind the search form of `backend\models\Goodssku`.
 */
class GoodsskuSearch extends Goodssku
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sku_id', 'is_quantity_check', 'contain_battery', 'qty_of_ctn', 'min_order_num', 'pd_get_days', 'pur_info_id'], 'integer'],
            [[ 'pd_creator','pd_title','pd_title_en','image_url','sku', 'currency_code', 'old_sku', 'sale_company', 'vendor_code', 'origin_code', 'pd_costprice_code', 'bill_name', 'bill_unit', 'brand', 'sku_mark'], 'safe'],
            [['declared_value', 'ctn_length', 'ctn_width', 'ctn_height', 'ctn_fact_weight', 'pd_costprice'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $username = Yii::$app->user->identity->username;

        if($username=='Mark'||$username=='Jenny'||$username=='David'){
            $query = Goodssku::find()
                ->orderBy('sku_id desc')
            ;
        }else{
            $query = Goodssku::find()
                ->andWhere(['pd_creator' => $username])
                ->orderBy('sku_id desc')
            ;
        }


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
            'sku_id' => $this->sku_id,
            'declared_value' => $this->declared_value,
            'is_quantity_check' => $this->is_quantity_check,
            'contain_battery' => $this->contain_battery,
            'qty_of_ctn' => $this->qty_of_ctn,
            'ctn_length' => $this->ctn_length,
            'ctn_width' => $this->ctn_width,
            'ctn_height' => $this->ctn_height,
            'ctn_fact_weight' => $this->ctn_fact_weight,
            'min_order_num' => $this->min_order_num,
            'pd_get_days' => $this->pd_get_days,
            'pd_costprice' => $this->pd_costprice,
            'pur_info_id' => $this->pur_info_id,
        ]);

        $query->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'currency_code', $this->currency_code])
            ->andFilterWhere(['like', 'old_sku', $this->old_sku])
            ->andFilterWhere(['like', 'sale_company', $this->sale_company])
            ->andFilterWhere(['like', 'vendor_code', $this->vendor_code])
            ->andFilterWhere(['like', 'origin_code', $this->origin_code])
            ->andFilterWhere(['like', 'pd_costprice_code', $this->pd_costprice_code])
            ->andFilterWhere(['like', 'bill_name', $this->bill_name])
            ->andFilterWhere(['like', 'bill_unit', $this->bill_unit])
            ->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'pd_title', $this->pd_title])
            ->andFilterWhere(['like', 'pd_title_en', $this->pd_title_en])
            ->andFilterWhere(['like', 'sku_mark', $this->sku_mark]);

        return $dataProvider;
    }
}
