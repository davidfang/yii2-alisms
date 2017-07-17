<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model zc\yii2Alisms\models\SmsTemplate */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sms Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-template-view">

    <p>
        <?php echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'appkey',
            'secretKey',
            'sms_free_sign_name',
            'name',
            'tmpId',
            'content',
            'param',
            'status',
            'captcha',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
