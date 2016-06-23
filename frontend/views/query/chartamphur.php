<?php
use yii\helpers\Vardumper;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;
?>

<h1>อำเภอ</h1>
<?php
//VarDumper::dump($name,10,true)?>
<?php
echo Highcharts::widget([
   'options' => [
      'title' => ['text' => 'Fruit Consumption'],
      'xAxis' => [
         'categories' => $name
      ],
      'yAxis' => [
         'title' => ['text' => 'sdf']
      ],
      'series' => [
         ['name' => 'จังหวัด', 'data' => $total]
      ]
   ]
]);
?>
<!-- use yii\grid\GridView; -->
<?=GridView::widget([
  'dataProvider' => $dataProvider,
  'columns'=>[
    [
      'attribute'=>'name',
      'label'=>'จังหวัด'
    ],
    [
      'attribute'=>'total',
      'label'=>'จำนวนอำเภอ'
    ]
  ]
]);
?>
