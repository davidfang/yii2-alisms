<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model zc\yii2Alisms\models\SmsTemplate */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="sms-template-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'appkey')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'secretKey')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'sms_free_sign_name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'tmpId')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'content')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'param')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'status')->textInput() ?>

    <?php echo $form->field($model, 'captcha')->textInput() ?>

    <?php  $form->field($model, 'created_at')->textInput() ?>

    <?php  $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
