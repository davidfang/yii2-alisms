<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model zc\yii2Alisms\models\SmsLog */

$this->title = 'Create Sms Log';
$this->params['breadcrumbs'][] = ['label' => 'Sms Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-log-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
