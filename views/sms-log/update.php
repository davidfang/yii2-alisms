<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model zc\yii2Alisms\models\SmsLog */

$this->title = 'Update Sms Log: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sms Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sms-log-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
