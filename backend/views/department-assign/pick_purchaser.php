<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;



/* @var $this yii\web\View */
/* @var $model backend\models\Preview */

$this->title = Yii::t('app', 'Create Preview');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Previews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="product-create">


    <div class="product-form">

        <?php $form = ActiveForm::begin(); ?>
        <?php echo $form->field($model, 'purchaser',

                [
                    'options'=>['class' => 'form-group form-md-radios'],
                    'template' => '{label}<div class="col-md-offset-1 md-radio-inline">{input}</div>{hint}{error}',
                ]
            )->radioList($purset,
            [   'item' => function($index, $label, $name, $checked, $value)
            {
                $checked=$checked? "checked": "";
                $return = '<div class="md-radio">';
                $return .= '<input type="radio" id="' . $name . $value . '" name="' . $name . '" value="' . $value . '" class="md-radiobtn"  '.$checked.'>';
                $return .= '<label for="' . $name . $value . '"><span></span><span class="check"></span><span class="box"></span>' . ucwords($label) . '</label>';
                $return .= '</div></br>';
                return $return;
            }
            ]
            ) ?>


        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
