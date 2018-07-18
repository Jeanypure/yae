
<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2018/7/18
 * Time: 9:57
 */

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SupplierContact */

$this->title = 'Create Supplier Contact';
$this->params['breadcrumbs'][] = ['label' => 'Supplier Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-contact-create">


    <?= $this->render('contact_form', [
        'model' => $model,
    ]) ?>

</div>