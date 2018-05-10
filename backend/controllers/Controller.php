<?php
namespace backend\controllers;

use yii\filters\AccessControl;

class Controller extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            // 后台必须登录才能使用
            'access' => [
            'class' => AccessControl::className(),
            'rules' => [
                            [
                            'allow' => true,
                            'roles' => ['@'],
                            ],
             ],
             ],
        ];
}
}