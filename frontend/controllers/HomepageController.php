<?php
namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use frontend\models\User;
use yii\helpers\VarDumper;
class HomepageController extends Controller
{
  public $layout = 'Homepage';

  public function actionCreate(){

    $model = new User;
    $model->username = 'sathit';
    $model->save();

    print_r($model->getErrors());
  }

  public function actionUpdate(){
    $model = User::findOne(3);
    $model->username = 'sathit-update';
    $model->save();
    print_r($model->getErrors());
  }

  public function actionDelete(){
    // $model = User::find()->where([
    //   'id'=>3
    // ])->one();
    // $model->delete();
    // User::findOne(3)->delete();
    $model = User::findOne(3);

    if($model != null){
      $model->delete();
    }else{
      echo 'ไม่พบรายการ!';
    }

  }

  public function actionIndex(){
    //findOne
    //$model = User::find()->one();
    $model = User::find()
    ->where(['id'=>2])
    ->one();
    $model = User::findOne(2);

    VarDumper::dump($model->attributes,10,true);
    echo $model->email;
    echo $model->id;
    //findAll
    $models = User::find()->all();
    //VarDumper::dump($models,10,true);
    echo '<h5>findAll</h5>';
    echo '<hr />';
    echo $models[0]->email;
    echo $models[1]->email;
    foreach ($models as $key => $row) {
      echo $row->email;
      echo '<br/>';
    }
    //VarDumper::dump($models,10,true);
    //print_r($model->attributes);


    return $this->render('index');
  }

  public function actionView($id,$v=1){
    return $this->render('view',[
      'id'=> $id,
      'v' => $v
    ]);
  }
}
