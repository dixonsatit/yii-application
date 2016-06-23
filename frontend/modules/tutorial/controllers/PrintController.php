<?php

namespace frontend\modules\acc\controllers;

use kartik\mpdf\Pdf;
use frontend\modules\acc\models\Bill;
use frontend\modules\acc\models\BillItem;
use frontend\modules\acc\models\BillSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;

class PrintController extends Controller
{
    public function actionIndex($id)
    {

      $content = $this->renderPartial('index',[
        'model'=>$this->findModel($id)
      ]);

      $pdf = new Pdf([
         'content' => $content,
         'options' => [
              'title' => 'สรุปการเก็บค่าบริการผู้ป่วย',
          ],
          'format' => array(177,203),
          // set to use core fonts only
          'mode' => Pdf::MODE_UTF8,
          // A4 paper format
          'format' => Pdf::FORMAT_A4,
          //'format' => [100,100],//[17.78,20.32],
          // portrait orientation
          'orientation' => Pdf::ORIENT_PORTRAIT,
          // stream to browser inline
          'destination' => Pdf::DEST_BROWSER,
          // your html content input
          'marginTop' => 10,
          'marginLeft' => 15,
          'marginRight' => 15,
          // format content from your own css file if needed or use the
          // enhanced bootstrap css built by Krajee for mPDF formatting
          'cssFile' => '@frontend/modules/acc/assets/assets/css/kv-mpdf-bootstrap.css',
          // any css to be embedded if required
          'cssInline' => '
            body{
              font-family:"garuda", "sans-serif";
              font-size:14px;
            }
          ',
          // set mPDF properties on the fly
          // call mPDF methods on the fly
          'methods' => [
            // 'SetHeader' => ['กลุ่มงานการเงินและบัญชี โรงพยาบาลขอนแก่น'],
             'SetFooter' => ['JAccount Power By Dimple Thechnology','หน้า {PAGENO}'],
          ]
      ]);

   // return the pdf output as per the destination setting
   return $pdf->render();
    }

    /**
     * Finds the Bill model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Bill the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bill::find()->joinWith(['items'])->where(['acc_bill.id'=>$id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
