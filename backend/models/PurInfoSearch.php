<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PurInfo;

/**
 * PurInfoSearch represents the model behind the search form of `backend\models\PurInfo`.
 */
class PurInfoSearch extends PurInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_submit','source','pur_info_id', 'pur_group', 'pd_purchase_num', 'hs_code', 'parent_product_id'], 'integer'],
            [['pd_create_time','master_mark','master_result','brocast_status','member','purchaser','pd_title', 'pd_title_en',
                'pd_pic_url', 'pd_package', 'pd_length', 'pd_width', 'pd_height', 'is_huge', 'pd_material', 'has_shipping_fee',
                'profit_rate', 'bill_type', 'bill_tax_rebate', 'bill_rebate_amount', 'no_rebate_amount', 'retail_price', 'ebay_url',
                'amazon_url', 'url_1688','else_url', 'shipping_fee', 'oversea_shipping_fee', 'transaction_fee', 'gross_profit', 'remark'], 'safe'],
            [['pd_weight', 'pd_throw_weight', 'pd_count_weight', 'pd_pur_costprice'], 'number'],
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
    public function search($params,$data_source)
    {

        $username = Yii::$app->user->identity->username;
        $role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        if(array_key_exists('超级管理员',$role)||array_key_exists('审核组',$role)){
            $query = PurInfo::find()->orderBy('pur_info_id desc');
        }else{
            $query = PurInfo::find()
                ->andWhere(['purchaser'=>$username])
                ->orderBy('pur_info_id desc');

        }

        $this->source = $data_source;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => '10',
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        if (!empty($this->pd_create_time)) {
            $query->andFilterCompare('pd_create_time', explode('/', $this->pd_create_time)[0], '>=');//起始时间
            $query->andFilterCompare('pd_create_time', explode('/', $this->pd_create_time)[1], '<');//结束时间
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'pur_info_id' => $this->pur_info_id,
            'is_submit' => $this->is_submit,
            'master_result' => $this->master_result,
            'purchaser' => $this->purchaser,
            'pur_group' => $this->pur_group,
            'pd_weight' => $this->pd_weight,
            'pd_throw_weight' => $this->pd_throw_weight,
            'pd_count_weight' => $this->pd_count_weight,
            'pd_purchase_num' => $this->pd_purchase_num,
            'pd_pur_costprice' => $this->pd_pur_costprice,
            'hs_code' => $this->hs_code,
            'parent_product_id' => $this->parent_product_id,
        ]);

        $query->andFilterWhere(['like', 'pd_title', $this->pd_title])
            ->andFilterWhere(['like', 'pd_title_en', $this->pd_title_en])
            ->andFilterWhere(['like', 'pd_pic_url', $this->pd_pic_url])
            ->andFilterWhere(['like', 'pd_package', $this->pd_package])
            ->andFilterWhere(['like', 'pd_length', $this->pd_length])
            ->andFilterWhere(['like', 'pd_width', $this->pd_width])
            ->andFilterWhere(['like', 'pd_height', $this->pd_height])
            ->andFilterWhere(['like', 'is_huge', $this->is_huge])
            ->andFilterWhere(['like', 'pd_material', $this->pd_material])
            ->andFilterWhere(['like', 'has_shipping_fee', $this->has_shipping_fee])
            ->andFilterWhere(['like', 'bill_type', $this->bill_type])
            ->andFilterWhere(['like', 'bill_tax_rebate', $this->bill_tax_rebate])
            ->andFilterWhere(['like', 'bill_rebate_amount', $this->bill_rebate_amount])
            ->andFilterWhere(['like', 'no_rebate_amount', $this->no_rebate_amount])
            ->andFilterWhere(['like', 'retail_price', $this->retail_price])
            ->andFilterWhere(['like', 'ebay_url', $this->ebay_url])
            ->andFilterWhere(['like', 'amazon_url', $this->amazon_url])
            ->andFilterWhere(['like', 'url_1688', $this->url_1688])
            ->andFilterWhere(['like', 'shipping_fee', $this->shipping_fee])
            ->andFilterWhere(['like', 'oversea_shipping_fee', $this->oversea_shipping_fee])
            ->andFilterWhere(['like', 'transaction_fee', $this->transaction_fee])
            ->andFilterWhere(['like', 'gross_profit', $this->gross_profit])
            ->andFilterWhere(['like', 'member', $this->member])
            ->andFilterWhere(['like', 'brocast_status', $this->brocast_status])
            ->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
