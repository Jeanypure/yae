<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */

$this->title = Yii::t('app', '可以从下列表选择食物');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pur Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pur-info-create">



    <div class="pur-info-form">

        <?php $form = ActiveForm::begin(); ?>


        <?= $form->field($model, 'food_name'

            )->radioList($food

            ) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success','id'=>'save-food']) ?>
            <?= Html::submitButton(Yii::t('app', 'Cancel'), ['class' => 'btn btn-success','id'=>'cancel-food']) ?>
<!--            <button>CANCEL</button>-->
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
<div id="div1"></div>

<?php
$cancel = Url::toRoute(['cancel']);
$js = <<<JS
    $('#cancel-food').on('click', function(e) {
        e.preventDefault();
        $('[name="YaeFoodLists[food_name]"]').prop('checked', false );
        $.ajax({
        url:"{$cancel}",
        success:function(result){
            
        $("#div1").html(result);
    }});
        
    });

JS;

$this->registerJs($js);

?>
