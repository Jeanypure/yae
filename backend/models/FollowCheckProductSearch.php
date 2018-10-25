<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Goodssku;

/**
 * FollowCheckProductSearch represents the model behind the search form of `backend\models\Goodssku`.
 */
class FollowCheckProductSearch extends Goodssku
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sku_id', 'is_quantity_check', 'contain_battery', 'qty_of_ctn', 'min_order_num', 'pd_get_days', 'pur_info_id', 'pur_group', 'has_commit', 'has_toeccang', 'has_tons', 'audit_result'], 'integer'],
            [['sku', 'pd_title', 'pd_title_en', 'currency_code', 'old_sku', 'sale_company', 'vendor_code', 'origin_code', 'pd_costprice_code', 'bill_name', 'bill_unit', 'pd_creator', 'brand', 'sku_mark', 'image_url', 'sku_create_date', 'sku_update_date', 'audit_content'], 'safe'],
            [['declared_value', 'pd_length', 'pd_width', 'pd_height', 'pd_weight', 'ctn_length', 'ctn_width', 'ctn_height', 'ctn_fact_weight', 'pd_costprice'], 'number'],
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
        $user_dict = [
            'Lulu'=> '1,2,3,4,5,6,7,8',
            'Cara'=> '2,6',
            'Ivy'=> '3,4',
            'Belle'=> '3,4',
            'Yilia'=> '1'];

        if ($username =='Jenny'||$username =='David'||$username =='Mark' ){
            $query = Goodssku::find()->orderBy('sku_id desc');
        }else{
            $val = $user_dict[$username];
            $query = Goodssku::find()
                ->Where('pur_group IN('.$val.')')
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
            'pd_length' => $this->pd_length,
            'pd_width' => $this->pd_width,
            'pd_height' => $this->pd_height,
            'pd_weight' => $this->pd_weight,
            'qty_of_ctn' => $this->qty_of_ctn,
            'ctn_length' => $this->ctn_length,
            'ctn_width' => $this->ctn_width,
            'ctn_height' => $this->ctn_height,
            'ctn_fact_weight' => $this->ctn_fact_weight,
            'min_order_num' => $this->min_order_num,
            'pd_get_days' => $this->pd_get_days,
            'pd_costprice' => $this->pd_costprice,
            'pur_info_id' => $this->pur_info_id,
            'pur_group' => $this->pur_group,
            'sku_create_date' => $this->sku_create_date,
            'sku_update_date' => $this->sku_update_date,
            'has_commit' => $this->has_commit,
            'has_toeccang' => $this->has_toeccang,
            'has_tons' => $this->has_tons,
            'audit_result' => $this->audit_result,
        ]);

        $query->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'pd_title', $this->pd_title])
            ->andFilterWhere(['like', 'pd_title_en', $this->pd_title_en])
            ->andFilterWhere(['like', 'currency_code', $this->currency_code])
            ->andFilterWhere(['like', 'old_sku', $this->old_sku])
            ->andFilterWhere(['like', 'sale_company', $this->sale_company])
            ->andFilterWhere(['like', 'vendor_code', $this->vendor_code])
            ->andFilterWhere(['like', 'origin_code', $this->origin_code])
            ->andFilterWhere(['like', 'pd_costprice_code', $this->pd_costprice_code])
            ->andFilterWhere(['like', 'bill_name', $this->bill_name])
            ->andFilterWhere(['like', 'bill_unit', $this->bill_unit])
            ->andFilterWhere(['like', 'pd_creator', $this->pd_creator])
            ->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'sku_mark', $this->sku_mark])
            ->andFilterWhere(['like', 'image_url', $this->image_url])
            ->andFilterWhere(['like', 'audit_content', $this->audit_content]);

        return $dataProvider;
    }
}
