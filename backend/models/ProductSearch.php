<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Product;

/**
 * ProductSearch represents the model behind the search form of `backend\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_submit','product_id','sale_submit','group_status','brocast_status','sub_company',], 'integer'],
            [['complete_status','accept_status','product_title_en', 'product_title', 'ref_url1', 'ref_url2', 'ref_url3', 'ref_url4', 'product_add_time', 'product_update_time','creator'], 'safe'],
            [['product_purchase_value'], 'number'],
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
        $creator = Yii::$app->user->identity->username;
        $role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        if(array_key_exists('超级管理员',$role)||array_key_exists('审核组',$role)){
            $query = Product::find()
                ->select(['`product`.*,`pur_info`.is_submit'])
                ->joinWith('purinfo')
                ->orderBy('product_id desc');
        }else{

            $query = Product::find()
                ->select(['`product`.*,`pur_info`.is_submit'])
                ->joinWith('purinfo')
                ->andWhere(['creator'=> $creator])
                ->orderBy('product_id desc');

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
            'product_id' => $this->product_id,
            'sub_company' => $this->sub_company,
            'product_purchase_value' => $this->product_purchase_value,
            'product_update_time' => $this->product_update_time,
            'is_submit' => $this->is_submit,
            'sale_submit' => $this->sale_submit,
            'brocast_status' => $this->brocast_status,
            'sub_company' => $this->sub_company,
            'group_status' => $this->group_status,
        ]);


        if (!empty($this->product_add_time)) {
            $query->andFilterCompare('product_add_time', explode('/', $this->product_add_time)[0], '>=');//起始时间
            $query->andFilterCompare('product_add_time', explode('/', $this->product_add_time)[1], '<');//结束时间
        }

        $query->andFilterWhere(['like', 'product_title_en', $this->product_title_en])
            ->andFilterWhere(['like', 'product_title', $this->product_title])
            ->andFilterWhere(['like', 'ref_url1', $this->ref_url1])
            ->andFilterWhere(['like', 'ref_url2', $this->ref_url2])
            ->andFilterWhere(['like', 'ref_url3', $this->ref_url3])
            ->andFilterWhere(['like', 'ref_url4', $this->ref_url4])
            ->andFilterWhere(['like', 'creator', $this->creator])
            ->andFilterWhere(['like', 'accept_status', $this->accept_status])
            ->andFilterWhere(['like', 'complete_status', $this->complete_status]);

        return $dataProvider;
    }
}
