<?php
use yii\grid\GridView;

?>

 <?=  GridView::widget([
   'dataProvider' =>$dataProvider,
   'filterModel' => $model,
   'columns' => [
     'fname',
     'lname',
     [
       'header' => 'ชื่อ-นามสกุล',
       'value' => function($model){
         return $model->title.$model->fname.' '.$model->lname;
       }
     ],
    //  [
    //    'attribute'=>'fname',
    //    'value' => function($model){
    //      return $model->title.$model->fname.' '.$model->lname;
    //    }
    //  ]
   ]
 ]);
?>
