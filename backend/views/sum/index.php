<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '销售推荐汇总公示');
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="product-index">

        <h5><?= Html::encode($this->title) ?></h5>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
            <?= Html::button('确认公示', ['id' => 'brocast', 'class' => 'btn btn-primary']) ;?>
            <?=  Html::button('公示结束', ['id' => 'end-brocast', 'class' => 'btn btn-info']) ?>

        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'id' => 'group',
            'options' => [
                'style'=>'overflow: auto;  white-space:nowrap;'
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'class' => 'yii\grid\CheckboxColumn',
                    'name' => 'id',
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                ],
                [
                    'class' => 'yii\grid\Column',
                    'headerOptions' => [
                        'width'=>'100'
                    ],
                    'header' => '图片',
                    'content' => function ($model, $key, $index, $column){
                        return "<img src='" .$model->pd_pic_url. "' width='100' height='100'>";


                    }
                ],
                'sub_company',
                'product_title',
                'product_title_en',
                'product_purchase_value',
                [
                    'class' => 'yii\grid\Column',
                    'headerOptions' => [
                        'width'=>'100'
                    ],
                    'header' => 'Amazon链接',
                    'content' => function ($model, $key, $index, $column){
                        if (!empty($model->ref_url1)) return "<a href='$model->ref_url1' target='_blank'>".parse_url($model->ref_url1)['host']."</a>";
                    }
                ],
                [
                    'class' => 'yii\grid\Column',
                    'headerOptions' => [
                        'width'=>'100'
                    ],
                    'header' => 'eBay链接',
                    'content' => function ($model, $key, $index, $column){
                        if (!empty($model->ref_url2))  return "<a href='$model->ref_url2' target='_blank'>".parse_url($model->ref_url2)['host']."</a>";

                    }
                ],
                [
                    'class' => 'yii\grid\Column',
                    'headerOptions' => [
                        'width'=>'100'
                    ],
                    'header' => '1688链接',
                    'content' => function ($model, $key, $index, $column){
                        if (!empty($model->ref_url3))  return "<a href='$model->ref_url3' target='_blank'>".parse_url($model->ref_url3)['host']."</a>";

                    }
                ],
                [
                    'class' => 'yii\grid\Column',
                    'headerOptions' => [
                        'width'=>'100'
                    ],
                    'header' => '其他链接',
                    'content' => function ($model, $key, $index, $column){
                        if (!empty($model->ref_url4))  return "<a href='$model->ref_url4' target='_blank'>".parse_url($model->ref_url4)['host'] ."</a>";



                    }
                ],
                'product_add_time:date',
                'product_update_time:date',
//                'purchaser',
                'creator',
                'product_status',
                'brocast_status',

            ],
        ]); ?>

    </div>
<?php
$group_brocast = Url::toRoute(['group/brocast']);
$group_end_brocast = Url::toRoute(['group/end-brocast']);


$js = <<<JS
    //批量公示
    $('#brocast').on('click',function(){
            var ids = $("#group").yiiGridView("getSelectedRows");
            console.log(ids);
            if(ids.length ==0) return false;
            $.ajax({
                url:'{$group_brocast}',
                type: 'post',
                data:{id:ids},
                success:function(res){
                    if(res) alert(res);
                }
            });
    });

//批量结束公示
    $('#end-brocast').on('click',function(){
            var ids = $("#group").yiiGridView("getSelectedRows");
            console.log(ids);
            if(ids.length ==0) return false;
            $.ajax({
                url:'{$group_end_brocast}',
                type: 'post',
                data:{id:ids},
                success:function(res){
                    if(res) alert(res);
                    location.reload();
                }
            });
    });

JS;
$this->registerJs($js);

?>