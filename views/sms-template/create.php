<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model zc\yii2Alisms\models\SmsTemplate */

$this->title = 'Create Sms Template';
$this->params['breadcrumbs'][] = ['label' => 'Sms Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-template-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
