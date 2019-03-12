<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
?>
<h1>新品到货日期同步更新</h1>

<p>
    <?php echo Html::button('同步到货清单',['class' => 'btn btn-info' ,'id'=>'receipt'])?>
    <?php echo Html::button('同步采购明细',['class' => 'btn btn-primary' ,'id'=>'purchase'])?>
</p>
<?php
$hide_url = <<<JS
    $(function() {
      $('h3').hide();
    });
JS;
$this->registerJs($hide_url);

?>

<?php
$receipt_url = Url::toRoute(['get-receipt']);
$purchase_url = Url::toRoute(['get-purchase-order']);
$request_receipt = <<<JS
    $(function(){
        $('#receipt').on('click',function() {
          var button = $(this);
          button.attr('disabled','disabled');
          $.ajax({
          url: "{$receipt_url}",
          type: 'GET',
          success:function(res) {
                alert(res);            
          button.attr('disabled',false);
          }
          });
        });
        //同步采购订单
         $('#purchase').on('click',function() {
             console.log(666);
          var button = $(this);
          button.attr('disabled','disabled');
          $.ajax({
          url: "{$purchase_url}",
          type: 'GET',
          success:function(res) {
                alert(res);            
          button.attr('disabled',false);
          }
          });
        });
        
    });
JS;

$this->registerJs($request_receipt);
?>

