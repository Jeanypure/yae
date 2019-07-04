<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PurInfo;

/**
 * FinancialAgreestSearch represents the model behind the search form of `backend\models\PurInfo`.
 */
class FinancialAgreestSearch extends PurInfo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sample_return','has_pay','pur_info_id', 'pur_group', 'is_huge', 'pd_purchase_num', 'has_shipping_fee', 'bill_tax_rebate', 'parent_product_id', 'source', 'preview_status', 'brocast_status', 'master_result', 'is_submit', 'is_submit_manager', 'pur_group_status', 'junior_submit', 'is_assign', 'audit_a', 'audit_b', 'bill_tax_value', 'pur_complete_status', 'pur_compelte_result', 'sample_submit2', 'sample_submit1'], 'integer'],
            [['pay_way','pd_sku','sure_purchase_time','submit2_at','pay_at','purchaser', 'pd_title', 'pd_title_en', 'pd_pic_url', 'pd_package', 'pd_length', 'pd_width', 'pd_height', 'pd_material', 'bill_type', 'hs_code', 'bill_rebate_amount', 'no_rebate_amount', 'retail_price', 'ebay_url', 'amazon_url', 'url_1688', 'else_url', 'shipping_fee', 'oversea_shipping_fee', 'transaction_fee', 'gross_profit', 'remark', 'member', 'master_member', 'master_mark', 'priview_time', 'pd_create_time', 'purchaser_leader', 'profit_rate', 'gross_profit_amz', 'profit_rate_amz', 'amz_fulfillment_cost', 'selling_on_amz_fee', 'amz_retail_price', 'amz_retail_price_rmb', 'commit_date'], 'safe'],
            [['pay_amount','pd_weight', 'pd_throw_weight', 'pd_count_weight', 'pd_pur_costprice', 'ams_logistics_fee'], 'number'],
        ];
    }

    /**
     *
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


        $role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        if(array_key_exists('超级管理员',$role)){
            $query = PurInfo::find()
                ->select(['
                    `pur_info`.pur_info_id,
                    `pur_info`.pd_title,`pur_info`.pd_title_en,`pur_info`.purchaser,`pur_info`.pd_pic_url,
                    `pur_info`.pur_group,`pur_info`.master_result,`pur_info`.master_mark,
                    `pur_info`.payer,`pur_info`.pay_at,`pur_info`.has_pay,`pur_info`.sample_return,
                    `pur_info`.submit1_at,`pur_info`.submit2_at,`pur_info`.sure_purchase_time,
                    `sample`.pay_amount,`sample`.sample_sku,`sample`.pd_sku,`sample`.for_free,`sample`.pay_way'
                ])
                ->joinWith('sample')
                ->andWhere(['sample_submit1'=>1])
                ->andWhere(['sample_submit2'=>1])
                ->andWhere(['is_agreest'=>1])
                ->orderBy('pur_info_id desc')
            ;
        }else{
            $username = Yii::$app->user->identity->username;
            $groupPayer = [
                'Michael' => [2,3,5,6],
                '赵志星' => [1,4,7,8],
                '刘胜男' => [4,6],
                'Xiexiaolong' => [1,2,3,4,5,6,7,8]
            ];
            $query = PurInfo::find()
                ->select(['
                    `pur_info`.pur_info_id,
                    `pur_info`.pd_title,`pur_info`.pd_title_en,`pur_info`.purchaser,`pur_info`.pd_pic_url,
                    `pur_info`.pur_group,
                    `pur_info`.master_result,`pur_info`.master_mark,
                    `pur_info`.payer,`pur_info`.pay_at,`pur_info`.has_pay,`pur_info`.sample_return, 
                    `pur_info`.submit1_at,`pur_info`.submit2_at,`pur_info`.sure_purchase_time,
                    `sample`.pay_amount,`sample`.pd_sku,`sample`.sample_sku,`sample`.for_free,`sample`.pay_way'
                ])
                ->joinWith('sample')
                ->andWhere(['sample_submit1'=>1])
                ->andWhere(['sample_submit2'=>1])
                ->andWhere(['is_agreest'=>1])
                ->andWhere(['in','substring_index(`pur_info`.pur_group,",",1)',$groupPayer[$username]])
                ->orderBy('pur_info_id desc')
            ;
        }
        $this->has_pay = 0;
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

        if (!empty($this->pay_at)) {
            $query->andFilterCompare('pay_at', explode('/', $this->pay_at)[0], '>=');//起始时间
            $query->andFilterCompare('pay_at', explode('/', $this->pay_at)[1], '<');//结束时间
        }

        if (!empty($this->sure_purchase_time)) {
            $query->andFilterCompare('sure_purchase_time', explode('/', $this->sure_purchase_time)[0], '>=');//起始时间
            $query->andFilterCompare('sure_purchase_time', explode('/', $this->sure_purchase_time)[1], '<');//结束时间
        }

        if (!empty($this->submit2_at)) {
            $query->andFilterCompare('submit2_at', explode('/', $this->submit2_at)[0], '>=');//起始时间
            $query->andFilterCompare('submit2_at', explode('/', $this->submit2_at)[1], '<');//结束时间
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'pur_info_id' => $this->pur_info_id,
            'has_pay' => $this->has_pay,
            'sample_return' => $this->sample_return,
            'pur_group' => $this->pur_group,
            'is_huge' => $this->is_huge,
            'pd_weight' => $this->pd_weight,
            'pd_throw_weight' => $this->pd_throw_weight,
            'pd_count_weight' => $this->pd_count_weight,
            'pd_purchase_num' => $this->pd_purchase_num,
            'pd_pur_costprice' => $this->pd_pur_costprice,
            'has_shipping_fee' => $this->has_shipping_fee,
            'bill_tax_rebate' => $this->bill_tax_rebate,
            'parent_product_id' => $this->parent_product_id,
            'source' => $this->source,
            'preview_status' => $this->preview_status,
            'brocast_status' => $this->brocast_status,
            'master_result' => $this->master_result,
            'priview_time' => $this->priview_time,
            'ams_logistics_fee' => $this->ams_logistics_fee,
            'is_submit' => $this->is_submit,
            'pd_create_time' => $this->pd_create_time,
            'is_submit_manager' => $this->is_submit_manager,
            'pur_group_status' => $this->pur_group_status,
            'junior_submit' => $this->junior_submit,
            'is_assign' => $this->is_assign,
            'commit_date' => $this->commit_date,
            'audit_a' => $this->audit_a,
            'audit_b' => $this->audit_b,
            'bill_tax_value' => $this->bill_tax_value,
            'pur_complete_status' => $this->pur_complete_status,
            'pur_compelte_result' => $this->pur_compelte_result,
            'sample_submit2' => $this->sample_submit2,
            'sample_submit1' => $this->sample_submit1,
            'pd_sku' => $this->pd_sku,
            'submit2_at' => $this->submit2_at,
        ]);

        $query->andFilterWhere(['like', 'purchaser', $this->purchaser])
            ->andFilterWhere(['like', 'pd_title', $this->pd_title])
            ->andFilterWhere(['like', 'pd_title_en', $this->pd_title_en])
            ->andFilterWhere(['like', 'pd_pic_url', $this->pd_pic_url])
            ->andFilterWhere(['like', 'pd_package', $this->pd_package])
            ->andFilterWhere(['like', 'pd_length', $this->pd_length])
            ->andFilterWhere(['like', 'pd_width', $this->pd_width])
            ->andFilterWhere(['like', 'pd_height', $this->pd_height])
            ->andFilterWhere(['like', 'pd_material', $this->pd_material])
            ->andFilterWhere(['like', 'bill_type', $this->bill_type])
            ->andFilterWhere(['like', 'hs_code', $this->hs_code])
            ->andFilterWhere(['like', 'bill_rebate_amount', $this->bill_rebate_amount])
            ->andFilterWhere(['like', 'no_rebate_amount', $this->no_rebate_amount])
            ->andFilterWhere(['like', 'retail_price', $this->retail_price])
            ->andFilterWhere(['like', 'ebay_url', $this->ebay_url])
            ->andFilterWhere(['like', 'amazon_url', $this->amazon_url])
            ->andFilterWhere(['like', 'url_1688', $this->url_1688])
            ->andFilterWhere(['like', 'else_url', $this->else_url])
            ->andFilterWhere(['like', 'shipping_fee', $this->shipping_fee])
            ->andFilterWhere(['like', 'oversea_shipping_fee', $this->oversea_shipping_fee])
            ->andFilterWhere(['like', 'transaction_fee', $this->transaction_fee])
            ->andFilterWhere(['like', 'gross_profit', $this->gross_profit])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'member', $this->member])
            ->andFilterWhere(['like', 'master_member', $this->master_member])
            ->andFilterWhere(['like', 'master_mark', $this->master_mark])
            ->andFilterWhere(['like', 'purchaser_leader', $this->purchaser_leader])
            ->andFilterWhere(['like', 'profit_rate', $this->profit_rate])
            ->andFilterWhere(['like', 'gross_profit_amz', $this->gross_profit_amz])
            ->andFilterWhere(['like', 'profit_rate_amz', $this->profit_rate_amz])
            ->andFilterWhere(['like', 'amz_fulfillment_cost', $this->amz_fulfillment_cost])
            ->andFilterWhere(['like', 'selling_on_amz_fee', $this->selling_on_amz_fee])
            ->andFilterWhere(['like', 'amz_retail_price', $this->amz_retail_price])
            ->andFilterWhere(['like', 'amz_retail_price_rmb', $this->amz_retail_price_rmb])
            ->andFilterWhere(['like', 'pay_way', $this->pay_way])
        ;

        return $dataProvider;
    }
}
