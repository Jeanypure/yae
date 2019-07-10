<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\VendorPool */
/* @var $form ActiveForm */
?>
<div class="suppliername">

    <?php $form = ActiveForm::begin(); ?>
    <h1>供应商池</h1>
    <p><font color="red">创建新供应商前 按供应商名字搜下 如果已存在则不需创建 使用已存在的供应商代码等信息</font></p>
        <?= $form->field($model, 'supplier_name')->hint('完整的供应商名称  搜索结果才准确') ?>
    
        <div class="form-group">
            <?= Html::button('Submit', ['class' => 'btn btn-primary','id'=>'supplier-name']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- suppliername -->
<?php
$find = Url::toRoute(['index']);
$submit = <<<JS
//根据传过去的supplier_name 模糊查找 code
    $('#supplier-name').on('click',function() {
      var  button = $(this);
      button.attr('disabled','disabled');
      var supplier_name = $('#vendorpool-supplier_name').val();
      console.log(supplier_name);
      $.ajax({
      url: "{$find}",
      type: 'post',
      data:{supplier_name:supplier_name},
      success:function(res) {
          if(res=='empty!') alert('没找到!!!');
           console.log(res);
          var ret = eval("("+res+")");
         if(res) alert(ret[0].supplier_name+'  供应商编码:'+ret[0].supplier_code);     
           button.attr('disabled',false);
      }
      });
    })
JS;

$this->registerJs($submit);
?>