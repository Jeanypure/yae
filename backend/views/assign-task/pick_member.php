<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\PurInfo */

$this->title = Yii::t('app', 'Create Pur Info');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pur Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pur-info-create">



    <div class="pur-info-form">

        <?php $form = ActiveForm::begin(); ?>


        <?= $form->field($model, 'member',
            [
                'options'=>['class' => 'form-group form-md-radios'],
                'template' => '{label}<div class="col-md-offset-1 md-radio-inline">{input}</div>{hint}{error}',
            ]
            )->radioList($member,
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
