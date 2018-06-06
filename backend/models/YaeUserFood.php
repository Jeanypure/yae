<?php

namespace backend\models;

use Yii;
use backend\models\User;
use backend\models\YaeFoodLists;

/**
 * This is the model class for table "yae_user_food".
 *
 * @property int $id
 * @property int $user_id
 * @property int $food_id
 * @property string $note 备注
 * @property string $order_date 下单时间
 */
class YaeUserFood extends \yii\db\ActiveRecord
{
    public $username;
    public $food_name;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yae_user_food';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'food_id'], 'required'],
            [['user_id', 'food_id'], 'integer'],
            [['order_date'], 'safe'],
            [['username','food_name','note'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'food_id' => 'Food ID',
            'note' => 'Note',
            'order_date' => 'Order Date',
            'username' => 'username',
            'food_name' => 'food_name',
        ];
    }


    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }

    public function getYaeFoodLists()
    {
        return $this->hasOne(YaeFoodLists::className(),['id'=>'food_id']);
    }


}
