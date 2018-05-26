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
    echo $preview_model->member
    ?>评审结果</h3>


    <?= DetailView::widget([
        'model' => $preview_model,
        'attributes' => [
//            'preview_id',
            'member',
//            'product_id',
            'result',
            'content',
            ['attribute'=>'ref_url1','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'ref_url2','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'ref_url3','format'=>['url',['target'=>'_blank']]],
            ['attribute'=>'ref_url4','format'=>['url',['target'=>'_blank']]],
            'priview_time',
//            'member_id',
        ],
    ]) ?>

</div>
