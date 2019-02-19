<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;


/* @var $this yii\web\View */
/* @var $model backend\models\Goodssku */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goodssku-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]); ?>
    <?php
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
        'contentBefore'=>'<legend class="text-info"><h2>6 审核记录</h2></legend>',
        'attributes'=>[       // 3 column layout
            'audit_result'=>['type'=>Form::INPUT_RADIO_LIST, 'items'=>[1=>'是', 2=>'否'],
                'label'=>"<span style = 'color:red'><big>*</big></span>是否通过",],
        ],

    ]);
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
        'attributes'=>[       // 3 column layout
            'audit_content'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'']],
        ],

    ]);




    ?>


    <div class="form-group">
        <?php
        echo  Html::submitButton('Save', ['class' => 'btn btn-success btn-lg']) ?>
<!--        --><?php //echo Html::button('导出excel到易仓',['class' => 'btn btn-info' ,'id'=>'export-eccang'])?>
        <?php echo Html::button('导入NetSuite',['class' => 'btn btn-warning' ,'id'=>'export-netsuite'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
//导出excel到易仓
$export = Url::toRoute(['export']);
$id = $model->sku_id;
$export_debit =<<<JS
        $(function() {
          $('#export-eccang').on('click',function() {
                 var button = $(this);
                 button.attr('disabled','disabled');
                $.ajax({
                 url: "{$export}", 
                 type: 'get',
                 data:{id:$id},
                 success:function(res){
                   button.attr('disabled',false);
                   window.location.href = '{$export}'+'?id='+{$id};
                 },
                 error: function (jqXHR, textStatus, errorThrown) {
                            button.attr('disabled',false);
                 }
                  });
             });
        });
JS;

$this->registerJs($export_debit);

?>

<?php
//导入NetSuite
$to_netsuite = Url::toRoute(['export-ns']);
$id = $model->sku_id;
$export_ns = <<<JS
    $(function() {
      $('#export-netsuite').on('click',function(){
                var button = $(this);
                 button.attr('disabled','disabled');
                $.ajax({
                 url: "{$to_netsuite}", 
                 type: 'get',
                 data:{id:$id},
                 success:function(res){
                   button.attr('disabled',false);
                  /* var obj = JSON.parse(res);
                   if(obj.code =='200 OK'){ alert(obj.message); }
                   else{alert('code:'+obj.error.code+'\\n message:'+obj.error.message);}*/
                  alert(res);
                 },
                 error: function (jqXHR, textStatus, errorThrown) {
                            button.attr('disabled',false);
                 }
                });
                });
      });
JS;

$this->registerJs($export_ns);

?>

