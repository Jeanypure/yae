<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2019/4/22
 * Time: 18:21
 */
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class="post">
    <h2><?= Html::encode($model->role_name) ?></h2>

    <?= HtmlPurifier::process($model->note) ?>
</div>