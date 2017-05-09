<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model zc\yii2Alisms\models\SmsTemplate */

$this->title = 'Update Sms Template: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sms Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sms-template-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
