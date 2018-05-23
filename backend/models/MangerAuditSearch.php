<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PurInfo;
use yii\data\SqlDataProvider;


/**
 * MangerAuditSearch represents the model behind the search form of `backend\models\PurInfo`.
 */
class MangerAuditSearch extends PurInfo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pur_info_id', 'pur_group', 'is_huge', 'pd_purchase_num', 'has_shipping_fee', 'bill_tax_value', 'hs_code', 'bill_tax_rebate', 'parent_product_id'], 'integer'],
            [['preview_status','purchaser', 'pd_title', 'pd_title_en', 'pd_pic_url', 'pd_package', 'pd_length', 'pd_width', 'pd_height', 'pd_material', 'bill_type', 'bill_rebate_amount',
                'no_rebate_amount', 'retail_price', 'ebay_url', 'amazon_url', 'url_1688', 'shipping_fee', 'oversea_shipping_fee', 'transaction_fee', 'gross_profit', 'remark', 'source', 'member', 'preview_status',
                'brocast_status', 'master_member', 'master_mark', 'master_result'], 'safe'],
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
    public function search($params,$preview_status)
    {
        $query = PurInfo::find();
//        $this->preview_status = $preview_status;

        // add conditions that should always apply here

//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//            'pagination' => [
//                'pagesize' => '10',
//            ]
//        ]);

        $count = Yii::$app->db->createCommand("
                      SELECT count(*) 
                        FROM
                        (
                          SELECT 
                        p.`product_id`,
                        Max(case p.member when 'Jenny' then p.result else 0 end)   'Jenny',
                        Max(case   p.member when 'admin' then p.result else 0 end ) 'admin',
                        Max(case p.member when 'Heidi' then p.result else 0 end)  'Heidi',
                        Max(case p.member when 'Max' then p.result else 0 end)  'Max',
                        Max(case p.member when 'Sue' then p.result else 0 end)  'Sue',
                        Max(case p.member when 'Bianca' then p.result else 0 end)  'Bianca',
                        Max(case p.member when 'Molly' then p.result else 0 end)  'Molly',
                        Max(case p.member when 'Betty' then p.result else 0 end)  'Betty',
                        Max(case p.member when 'John' then p.result else 0 end)  'John'
                        FROM `preview` p
                        LEFT JOIN `pur_info` o  on o.pur_info_id = p.`product_id`
                        GROUP BY p.`product_id`
) ss
             ")->queryScalar();

        $dataProvider = new SqlDataProvider([
            'sql' => "
                        SELECT
                          o.*,
                         p.`product_id`,
                        Max(case p.member when 'Jenny' then p.result else 0 end)   'Jenny',
                        Max(case p.member when 'admin' then p.result else 0 end ) 'admin',
                        Max(case p.member when 'Heidi' then p.result else 0 end)  'Heidi',
                        Max(case p.member when 'Max' then p.result else 0 end)  'Max',
                        Max(case p.member when 'Sue' then p.result else 0 end)  'Sue',
                        Max(case p.member when 'Bianca' then p.result else 0 end)  'Bianca',
                        Max(case p.member when 'Molly' then p.result else 0 end)  'Molly',
                        Max(case p.member when 'Betty' then p.result else 0 end)  'Betty',
                        Max(case p.member when 'John' then p.result else 0 end)  'John'
                        FROM `preview` p
                        LEFT JOIN `pur_info` o  on o.pur_info_id = p.`product_id`
                        GROUP BY p.`product_id`

                        ",
            'totalCount' => $count,
            'sort' => [
                'attributes' => [
                    'product_id',
                    'Jenny',
                    'Max',
                    'Heidi',
                    'admin',

//                    'name' => [
//                        'asc' => ['product_id' => SORT_ASC, 'member' => SORT_ASC],
//                        'desc' => ['product_id' => SORT_DESC, 'member' => SORT_DESC],
//                        'default' => SORT_DESC,
//                        'label' => 'Name',
//                    ],
                ],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
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
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'member', $this->member])
            ->andFilterWhere(['like', 'preview_status', $this->preview_status])
            ->andFilterWhere(['like', 'brocast_status', $this->brocast_status])
            ->andFilterWhere(['like', 'master_member', $this->master_member])
            ->andFilterWhere(['like', 'master_mark', $this->master_mark])
            ->andFilterWhere(['like', 'master_result', $this->master_result])
//            ->andFilterWhere(['like', 'Jenny', $this->Jenny])
//            ->andFilterWhere(['like', 'Max', $this->Max])
//            ->andFilterWhere(['like', 'admin', $this->admin])
        ;

        return $dataProvider;
    }
}
