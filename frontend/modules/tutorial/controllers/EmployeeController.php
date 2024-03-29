<?php

namespace frontend\modules\tutorial\controllers;

use Yii;
use frontend\modules\tutorial\models\Employee;
use frontend\modules\tutorial\models\EmployeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\Arrayhelper;
use frontend\modules\tutorial\models\Province;
use frontend\modules\tutorial\models\Amphur;
use frontend\modules\tutorial\models\District;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Employee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employee model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Employee();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->emp_id]);
        } else {
            return $this->render('create', [
              'model' => $model,
              'amphur'=> [],
              'district' => [],
            ]);
        }
    }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model    = $this->findModel($id);
        $amphur   = ArrayHelper::map($this->getAmphur($model->province),'id','name');
        $district = ArrayHelper::map($this->getDistrict($model->amphur),'id','name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->emp_id]);
        } else {
            return $this->render('update', [
              'model' => $model,
              'amphur'=> $amphur,
              'district' =>$district,
            ]);
        }
    }

    /**
     * Deletes an existing Employee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetAmphur() {
        $out = [];
        if (($parents = Yii::$app->request->post('depdrop_parents'))!=null) {
            if ($parents != null) {
                $province_id = $parents[0];
                $out = $this->getAmphur($province_id);
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionGetDistrict() {
        $out = [];
        if (($ids = Yii::$app->request->post('depdrop_parents'))!=null) {
            $province_id = empty($ids[0]) ? null : $ids[0];
            $amphur_id   = empty($ids[1]) ? null : $ids[1];
            if ($province_id != null) {
               $data = $this->getDistrict($amphur_id);
               echo Json::encode(['output'=>$data, 'selected'=>'']);
               return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

  protected function getAmphur($id){
      $datas = Amphur::find()->where(['PROVINCE_ID'=>$id])->all();
      return $this->MapData($datas,'AMPHUR_ID','AMPHUR_NAME');
  }

  protected function getDistrict($id){
      $datas = District::find()->where(['AMPHUR_ID'=>$id])->all();
      return $this->MapData($datas,'DISTRICT_ID','DISTRICT_NAME');
  }

  protected function MapData($datas,$fieldId,$fieldName){
      $obj = [];
      foreach ($datas as $key => $value) {
          array_push($obj, ['id'=>$value->{$fieldId},'name'=>$value->{$fieldName}]);
      }
      return $obj;
  }
}
