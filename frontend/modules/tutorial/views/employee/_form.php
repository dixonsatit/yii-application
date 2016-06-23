<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

use kartik\widgets\Select2;
use kartik\widgets\TypeaheadBasic;
use kartik\widgets\DepDrop;
use kartik\widgets\FileInput;
use kartik\widgets\DatePicker;

use frontend\modules\tutorial\models\Countries;
use frontend\modules\tutorial\models\Employee;
use frontend\modules\tutorial\models\Province;
use frontend\modules\tutorial\models\Amphur;
use frontend\modules\tutorial\models\District;

/* @var $this yii\web\View */
/* @var $model frontend\modules\tutorial\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->errorSummary($model); ?>

    <div class="row">
    <div class="col-xs-4 col-sm-2 col-md-2">
        <?= $form->field($model, 'title')->widget(TypeaheadBasic::classname(), [
                'data' =>  ['นาย','นาง','นางสาว'],
                'pluginOptions' => ['highlight'=>true],
            ]);
        ?>
    </div>
    <div class="col-xs-4 col-sm-5 col-md-5">
        <?= $form->field($model, 'name')->textInput(['maxlength' => 50]) ?>
    </div>
    <div class="col-xs-4 col-sm-5 col-md-5">
        <?= $form->field($model, 'surname')->textInput(['maxlength' => 50]) ?>
    </div>
</div>

<div class="row">
    <div class="col-xs-6 col-sm-4 col-md-4">
     <?= $form->field($model, 'sex')->inline()->radioList($model->getItemSex()) ?>
    </div>

    <div class="col-xs-6 col-sm-4 col-md-4">
      <?= $form->field($model, 'birthday')->widget(DatePicker::classname(), [
        'language' => 'th',
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]
      ]) ?>
    </div>

    <div class="col-xs-12 col-sm-4 col-md-4">
      <?= $form->field($model, 'age')->textInput() ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-md-6">
      <?= $form->field($model, 'personal_id')->widget(\yii\widgets\MaskedInput::classname(), [
        'mask' => '9-9999-99999-999',
        'clientOptions'=>[
            'removeMaskOnSubmit'=>true //กรณีไม่ต้องการให้มันบันทึก format ลงไปด้วยเช่น 9-9999-99999-999 ก็จะเป็น 9999999999999
        ]
    ]) ?>
    </div>

    <div class="col-sm-6 col-md-6">
      <?= $form->field($model, 'marital')->dropdownList($model->itemAlias('marital'),[
           'prompt'=>'เลือกสถานะ'
      ]); ?>
    </div>
</div>


<div class="page-header">
  <h4>รายละเอียดตำแหน่งงาน </h4>
</div>

<div class="row">
    <div class="col-sm-4 col-md-4">
       <?= $form->field($model, 'position')->textInput() ?>
    </div>
    <div class="col-sm-4 col-md-4">
       <?= $form->field($model, 'salary')->textInput() ?>
    </div>
    <div class="col-sm-4 col-md-4">
       <?= $form->field($model, 'experience')->textInput() ?>
    </div>
</div>


<div class="page-header">
  <h4>ข้อมูลสำหรับการติดต่อ </h4>
</div>
<?= $form->field($model, 'address')->textInput() ?>
<div class="row">
    <div class="col-sm-4 col-md-4">
       <?= $form->field($model, 'province')->dropdownList(
            ArrayHelper::map(Province::find()->all(),
            'PROVINCE_ID',
            'PROVINCE_NAME'),
            [
                'id'=>'ddl-province',
                'prompt'=>'เลือกจังหวัด'
       ]); ?>
    </div>
    <div class="col-sm-4 col-md-4">
       <?= $form->field($model, 'amphur')->widget(DepDrop::classname(), [
            'options'=>['id'=>'ddl-amphur'],
            'data'=> $amphur,
            'pluginOptions'=>[
                'depends'=>['ddl-province'],
                'placeholder'=>'เลือกอำเภอ...',
                'url'=>Url::to(['/tutorial/employee/get-amphur'])
            ]
        ]); ?>
    </div>
    <div class="col-sm-4 col-md-4">
      <?= $form->field($model, 'district')->widget(DepDrop::classname(), [
            'data' =>$district,
            'pluginOptions'=>[
                'depends'=>['ddl-province', 'ddl-amphur'],
                'placeholder'=>'เลือกตำบล...',
                'url'=>Url::to(['/tutorial/employee/get-district'])
            ]
        ]); ?>
    </div>
</div>





    <div class="row">
    <div class="col-sm-4 col-md-4">
        <?= $form->field($model, 'zip_code')->widget(\yii\widgets\MaskedInput::classname(), [
            'mask' => '99999',
        ]) ?>
    </div>

    <div class="col-sm-4 col-md-4">
  <?= $form->field($model, 'countries')->widget(Select2::classname(), [
        'language' => 'de',
        'data' => ArrayHelper::map(Countries::find()->all(),'country_code','country_name'),
        'options' => ['placeholder' => 'เลือกประเทศ ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    </div>

    <div class="col-sm-4 col-md-4">
       <?= $form->field($model, 'mobile_phone')->widget(\yii\widgets\MaskedInput::classname(), [
        'mask' => '99-9999-9999',
    ]) ?>
    </div>

</div>

<div class="row">
    <div class="col-sm-6 col-md-6">
       <?= $form->field($model, 'email')->textInput(['maxlength' => 150]) ?>
    </div>
    <div class="col-sm-6 col-md-6">
        <?= $form->field($model, 'website')->textInput(['maxlength' => 150]) ?>
    </div>
</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
