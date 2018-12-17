<?php

namespace backend\modules\bargain\models;

use Yii;

/**
 * This is the model class for table "{{%tb_crontab}}".
 *
 * @property int $id
 * @property string $name 定时任务名称
 * @property string $route 任务路由
 * @property string $crontab_str crontab格式
 * @property int $switch 任务开关 0关闭 1开启
 * @property int $status 任务运行状态 0正常 1任务报错
 * @property string $last_rundate 任务上次运行时间
 * @property string $next_rundate 任务下次运行时间
 * @property string $execmemory 任务执行消耗内存(单位/byte)
 * @property string $exectime 任务执行消耗时间
 */
class Crontab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tb_crontab}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'route', 'crontab_str'], 'required'],
            [['switch', 'status'], 'integer'],
            [['last_rundate', 'next_rundate'], 'safe'],
            [['execmemory', 'exectime'], 'number'],
            [['name', 'route', 'crontab_str'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'route' => 'Route',
            'crontab_str' => 'Crontab Str',
            'switch' => 'Switch',
            'status' => 'Status',
            'last_rundate' => 'Last Rundate',
            'next_rundate' => 'Next Rundate',
            'execmemory' => 'Execmemory',
            'exectime' => 'Exectime',
        ];
    }
}
