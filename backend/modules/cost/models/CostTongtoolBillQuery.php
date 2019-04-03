<?php

namespace backend\modules\cost\models;

/**
 * This is the ActiveQuery class for [[CostTongtoolBill]].
 *
 * @see CostTongtoolBill
 */
class CostTongtoolBillQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CostTongtoolBill[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CostTongtoolBill|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
