<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[BulletinBoard]].
 *
 * @see BulletinBoard
 */
class BulletinBoardQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BulletinBoard[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BulletinBoard|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
