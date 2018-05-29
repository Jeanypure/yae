<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PurInfo;

/**
 * AuditSearch represents the model behind the search form of `backend\models\PurInfo`.
 */
class AuditSearch extends PurInfo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_submit_manager','pur_info_id', 'pur_group', 'is_huge', 'pd_purchase_num', 'has_shipping_fee', 'bill_tax_value', 'hs_code', 'bill_tax_rebate', 'parent_product_id'], 'integer'],
            [['preview_status','member','purchaser', 'pd_title', 'pd_title_en', 'pd_pic_url', 'pd_package', 'pd_length', 'pd_width', 'pd_height', 'pd_material', 'bill_type', 'bill_rebate_amount',
                'no_rebate_amount', 'retail_price', 'ebay_url', 'amazon_url', 'url_1688', 'shipping_fee', 'oversea_shipping_fee', 'transaction_fee', 'gross_profit', 'remark'], 'safe'],
            [['pd_weight', 'pd_throw_weight', 'pd_count_weight', 'pd_pur_costprice'], 'number'],
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
    public function search($params,$pur_group,$member)
    {
        $member = Yii::$app->user->identity->username;


        if($member!='Jenny'&&$member!='admin'&&empty($pur_group)){

            $query = PurInfo::find()
                ->joinWith('preview')
                ->andWhere(['in','preview_status',['待评审','已评审']])
                ->andWhere(['member'=>$member])
                ->andWhere(['is_submit'=>1])
                ->andWhere(['brocast_status'=>'公示结束'])
//                ->orderBy('pur_info_id desc')
            ;

        }else{
            $query = PurInfo::find()
                ->joinWith('preview')
                ->andWhere(['in','preview_status',['待评审','已评审']])
                ->andWhere(['is_submit'=>1])
                ->andWhere(['brocast_status'=>'公示结束'])

//                ->orderBy('pur_info_id desc')
            ;
            $this->pur_group = $pur_group;


        }




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

        // grid filtering conditions
        $query->andFilterWhere([
            'pur_info_id' => $this->pur_info_id,
            'is_submit_manager' => $this->is_submit_manager,
            'pur_group' => $this->pur_group,
            'is_huge' => $this->is_huge,
            'pd_weight' => $this->pd_weight,
            'pd_throw_weight' => $this->pd_throw_weight,
            'pd_count_weight' => $this->pd_count_weight,
            'pd_purchase_num' => $this->pd_purchase_num,
            'pd_pur_costprice' => $this->pd_pur_costprice,
            'has_shipping_fee' => $this->has_shipping_fee,
            'bill_tax_value' => $this->bill_tax_value,
            'hs_code' => $this->hs_code,
            'bill_tax_rebate' => $this->bill_tax_rebate,
            'parent_product_id' => $this->parent_product_id,
        ]);

        $query->andFilterWhere(['like', 'purchaser', $this->purchaser])
            ->andFilterWhere(['like', 'member', $this->member])
            ->andFilterWhere(['like', 'preview_status', $this->preview_status])
            ->andFilterWhere(['like', 'pd_title', $this->pd_title])
            ->andFilterWhere(['like', 'pd_title_en', $this->pd_title_en])
            ->andFilterWhere(['like', 'pd_pic_url', $this->pd_pic_url])
            ->andFilterWhere(['like', 'pd_package', $this->pd_package])
            ->andFilterWhere(['like', 'pd_length', $this->pd_length])
            ->andFilterWhere(['like', 'pd_width', $this->pd_width])
            ->andFilterWhere(['like', 'pd_height', $this->pd_height])
            ->andFilterWhere(['like', 'pd_material', $this->pd_material])
            ->andFilterWhere(['like', 'bill_type', $this->bill_type])
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
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
