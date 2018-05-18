<?php

namespace backend\controllers;

use Yii;

class DinnerController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }


    public  function actionTotal(){
       $result =  Yii::$app->db->createCommand("
                    SELECT 
            ls.`food_name`,
            count(*) as num
            from `yae_user_food` uf 
            LEFT JOIN `user` u ON u.`id`=uf.`user_id`
            LEFT JOIN `yae_food_lists` ls ON ls.`id`=uf.`food_id`
            group by ls.`food_name`
            ORDER BY count(*) DESC
        ")->queryAll();
        $food_name = [];
        $number = [];
        $data = [];
        foreach($result as $key=>$v){
            $food_name[$key] =$v['food_name'];
            $number[$key] =$v['num'];

        }
        $data['food_name'] = $food_name;
        $data['number'] = $number;

        echo json_encode($data,true);

    }




}
