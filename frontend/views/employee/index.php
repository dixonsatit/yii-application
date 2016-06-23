<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employees';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Employee', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'emp_id',
            //'sex',
            [
              'attribute'=>'sex',
              'filter'=> [1=>'ชาย',2=>'หญิง']
            ],
            'fullname',
            // [
            //   'attribute'=>'fullname',
            //   'value'=>function($model){
            //     return $model->getFullname();
            //   }
            // ],
            'email:email',
            'mobile_phone',
            'position',
            // 'title',
            // 'name',
            // 'surname',
            // 'address:ntext',
            // 'zip_code',
            // 'birthday',

            // 'modify_date',
            //'create_date:php:m/d/Y',
            // [
            //   'attribute'=>'create_date',
            //   'format'=>['date', 'php:Y-m-d']
            // ],

            // 'salary',
            // 'expire_date',
            // 'website',
            // 'skill',
            // 'countries',
            // 'age',
            // 'experience',
            // 'personal_id',
            // 'marital',
            // 'province',
            // 'amphur',
            // 'district',
            // 'social',
            // 'resume',
            // 'token_forupload',
            // 'count_download_resume',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
