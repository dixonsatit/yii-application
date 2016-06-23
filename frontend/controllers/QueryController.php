<?php
namespace frontend\controllers;
use Yii;
use yii\data\ArrayDataProvider;

class QueryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $results =  Yii::$app->db
        ->createCommand('select * from employee')
        ->queryAll();

        $result =  Yii::$app->db
        ->createCommand('select * from employee')
        ->queryOne();

        return $this->render('index',[
          'results'=> $results,
          'result' => $result
        ]);
    }

    public function actionChart(){
      $sql = 'SELECT
                	p.PROVINCE_NAME as name,
                	p.PROVINCE_ID as id,
                	count(*) as total
              FROM
              	province p
              INNER JOIN amphur a ON a.PROVINCE_ID
              = p.PROVINCE_ID
              GROUP BY p.PROVINCE_ID
              LIMIT 10';

      $data = Yii::$app->db->createCommand($sql)
      ->queryAll();

      $name  = [];
      $total = [];
      foreach ($data as $key => $value) {
        $name[]  = $value['name'];
        $total[] = (int)$value['total'];
      }
      // use yii\data\ArrayDataProvider;
      $dataProvider = new ArrayDataProvider([
        'allModels' => $data,
        'sort' => [
          'attributes' => [ 'name', 'total'],
        ],
        'pagination' => [
            'pageSize' => 20,
        ],
      ]);
      return $this->render('chart',[
        'data' => $data,
        'name' => $name,
        'total'=> $total,
        'dataProvider' => $dataProvider
      ]);
    }

    public function actionChartamphur($id){
      $sql = 'SELECT
            	a.AMPHUR_NAME as name,
            	count(*) as total
            FROM
            	amphur a
            INNER JOIN district d ON d.AMPHUR_ID = a.AMPHUR_ID
            where a.PROVINCE_ID = :id
            GROUP BY a.AMPHUR_ID';

      $query = Yii::$app->db->createCommand($sql)
               ->bindValue(':id',$id);
      $data = $query->queryAll();

      $name  = [];
      $total = [];
      foreach ($data as $key => $value) {
        $name[]  = $value['name'];
        $total[] = (int)$value['total'];
      }
      // use yii\data\ArrayDataProvider;
      $dataProvider = new ArrayDataProvider([
        'allModels' => $data,
        'sort' => [
          'attributes' => [ 'name', 'total'],
        ],
        'pagination' => [
            'pageSize' => 20,
        ],
      ]);
      return $this->render('chartamphur',[
        'data' => $data,
        'name' => $name,
        'total'=> $total,
        'dataProvider' => $dataProvider
      ]);
    }
}
