<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 5/3/2018
 * Time: 12:09 PM
 */
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use backend\models\BulletinBoard;

$dataProvider = new ActiveDataProvider([
    'query' => BulletinBoard::find(),
    'pagination' => [
        'pageSize' => 20,
    ],
]);
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_post',
]);

