<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2018/7/17
 * Time: 13:23
 */

namespace backend\components;

use Yii;
use yii\helpers\Url;

class AdminLog
{
    public static function write($event)
    {
        // 具体要记录什么东西，自己来优化$description
        if(!empty($event->changedAttributes)) {
            $desc = '';
            foreach($event->changedAttributes as $name => $value) {
                $desc .= $name . ' : ' . $value . '=>' . $event->sender->getAttribute($name) . ',';
            }
            $desc = substr($desc, 0, -1);
            $description = Yii::$app->user->identity->username . '修改了' . $event->sender->className() . 'id:' . $event->sender->primaryKey()[0] . '的' . $desc;
            $route = Url::to();
            $userId = Yii::$app->user->id;
            $data = [
                'route' => $route,
                'description' => $description,
                'created_at'=>time(),
                'user_id' => $userId
            ];
            $model = new \common\models\AdminLog();
            $model->setAttributes($data);
            $model->save();
        }
    }
}