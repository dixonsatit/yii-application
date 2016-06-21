<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Person */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="person-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
      <div class="col-md-4">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-sm-6 col-md-4">
        <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-sm-6 col-md-4">
        <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-6 col-sm-6">
        <?= $form->field($model, 'age')->textInput() ?>
      </div>
      <div class="col-xs-6 col-sm-6">
        <?= $form->field($model, 'idcard')->textInput(['maxlength' => true]) ?>
      </div>
    </div>











    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-danger' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
