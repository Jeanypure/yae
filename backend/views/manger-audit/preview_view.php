<?php
/**
 * Created by PhpStorm.
 * User: jenny
 * Date: 2018/5/25
 * Time: 下午4:00
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $preview_model backend\models\Preview */

?>
<div class="preview-view">
<h3> <?php
    echo $preview_model->member2
    ?>评审结果</h3>


    <?= DetailView::widget([
        'model' => $preview_model,
        'attributes' => [
            'member2',
            [
                'attribute'=>'result',
                'value'=>function($model){
                        if($model->result==0){
                            return "拒绝";
                        }elseif($model->result==1){
                            return "采样";
                        }elseif($model->result==2){
                            return "需议价或谈其他条件";
                        }elseif($model->result==3){
                            return "未评审";
                        }elseif($model->result==4){
                            return "直接下单";
                        }elseif($model->result==5){
                            return "季节产品推迟";
                        }
                }
            ],
            'content',
            ['attribute'=>'ref_url1','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'ref_url12','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'ref_url13','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'ref_url2','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'ref_url22','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'ref_url23','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'ref_url3','format'=>['url',['target'=>'_blank']]],
            'bottom_price',
            ['attribute'=>'ref_url4','format'=>['url',['target'=>'_blank']]],
            'priview_time',
        ],
    ]) ?>

</div>
