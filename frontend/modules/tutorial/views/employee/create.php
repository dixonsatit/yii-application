<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\tutorial\models\Employee */

$this->title = 'Create Employee';
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="employee-create panel panel-default">
<div class="panel-body">
    <?= $this->render('_form', [
      'model' => $model,
      'amphur'=> $amphur,
      'district' =>$district,
    ]) ?>
</div>
</div>
