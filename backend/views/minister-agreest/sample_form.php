<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\builder\Form;
use kartik\widgets\ActiveForm;



/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sample-form">

    <?php $form = ActiveForm::begin([
            'id' =>'sample',
            'enableAjaxValidation' => true,
            'validationUrl' => Url::toRoute(['validate-form'])
        ]); ?>

    <?php
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>6,
        'contentBefore'=>'<legend class="text-info"><h3>1.样品审核</h3></legend>',
        'attributes'=>[       // 3 column layout
            'is_agreest'=>[
                'type'=>Form::INPUT_RADIO_LIST,
                'label'=>"<span style = 'color:red'><big>*</big></span>是否同意支付样品费",
                'items'=>[1=>'是', 0=>'否'],
                'options'=>['placeholder'=>'',]
            ],
            'spur_info_id'=>['type'=>Form::INPUT_HIDDEN, 'options'=>['placeholder'=>'']],
        ],

    ]);

    ?>




    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn-lg btn-success']) ?>
        <?php echo Html::button( '导到NS', ['class' => 'btn-lg btn-info to-ns-sample']) ?>

    </div>
    <div class="form-group">
<!--        --><?php //echo Html::button('提交申请',['class' => 'btn btn-info' ,'id'=>'is_submit'])?>
<!--        --><?php //echo Html::button('取消提交',['class' => 'btn btn-primary' ,'id'=>'un_submit'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
    $commit = Url::toRoute(['single-commit']);
    $cancel = Url::toRoute(['single-cancel']);
    $js = <<<JS
    $('#is_submit').on('click',function(){
        var  button = $(this);
         button.attr('disabled','disabled');
         var id = $('#sample-spur_info_id').val();
        if(id==false) alert('请选择产品!') ;
        $.ajax({
         url: "{$commit}", 
         type: 'post',
         data:{id:id},
         success:function(res){
           if(res=='success') alert('提交申请成功!');     
           button.attr('disabled',false);
           // location.reload();
         },
         error: function (jqXHR, textStatus, errorThrown) {
             button.attr('disabled',false);
         }
      
    });
        
    });
    $('#un_submit').on('click',function(){
        var  button = $(this);
         button.attr('disabled','disabled');
         var id = $('#sample-spur_info_id').val();
        if(id==false) alert('请选择产品!') ;
        $.ajax({
         url: "{$cancel}", 
         type: 'post',
         data:{id:id},
         success:function(res){
           if(res=='success') alert('取消申请成功!');     
           button.attr('disabled',false);
           // location.reload();
         },
         error: function (jqXHR, textStatus, errorThrown) {
             button.attr('disabled',false);
         }
      
    });
        
    });

JS;
//   $this->registerJs($js);
?>
<?php
//导入NS
    $export_ns = Url::toRoute(['ns-sample']);
    $id = $model->spur_info_id;
    $tonsjs = <<<JS
          $(".to-ns-sample").on('click',function(){
            var  button = $(this);
            button.attr('disabled','disabled');
            $.ajax({
            url: "{$export_ns}",
            type: 'post',
            data:{id:$id},
            success:function(res) {
                console.log(res);
              // var obj = JSON.parse(res);
              // console.log(obj);
              button.attr('disabled',false);
              alert(res);
              // if(obj.error){
              //    alert('code:'+obj.error.code+'\\n message:'+obj.error.message);
              // }else{
              //     alert(obj.message);
              // }
              
            },
            error: function(jqXHR, textStatus, errorThrown){
                button.attr('disabled',false);
            }
            });
   
          });
JS;
    $this->registerJs($tonsjs);
?>

