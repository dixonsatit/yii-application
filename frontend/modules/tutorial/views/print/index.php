<?php
/* @var $this yii\web\View */

 $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@frontend/modules/acc/assets/assets');
 $billItems =  isset($model->items) ? $model->items : [];
?>


<div class="logoThaiGovernment">
  <img src="<?=$directoryAsset?>/images/Thai_government.png" alt="" style="width:100px;" />
  <p class="text-center">
    <strong>ในราชการ</strong>
  </p>
</div>

<div class="logoHospital">
  <img src="<?=$directoryAsset?>/images/kkh-logo.jpg" alt="" style="width:100px;" />
</div>

<h4 style="margin-bottom:8px; " class="text-center">
  โรงพยาบาลขอนแก่น<br />
  <small>KHON KAEN HOSPITAL</small>
</h4>
<p class="text-center">
    สำนักงานปลัดกระทรวง กระทรวงสาธารณะสุข <br />
    ถ.ศรีจันทร์ ต.ในเมือง อ.เมือง จ.ขอนแก่น 40000 โทร 043-336789
</p>

<h3 class="text-center text-primary">ต้นฉบับใบเสร็จรับเงิน</h3>
<br><br>
<table class="table table-info">
  <tbody>
    <tr>
      <td >
        <strong>เลขที่:</strong> <?=$model->bill_number;?>
      </td>
      <td >
        <strong>วันที่: </strong><?=$model->payment_date;?>
      </td>
    </tr>
    <tr>
      <td>
        <strong>เลขประจำตัว:</strong> <?=$model->hn;?>
      </td>
      <td>
        <strong>ได้รับเงินจาก:</strong> <?=$model->fullName;?>
      </td>
    </tr>
  </tbody>
</table>

<table class="table table-striped">
  <caption>
      <strong>ตามรายละเอียดดังนี้:</strong>
  </caption>
  <thead>
    <tr>
      <th>
        #
      </th>
      <th>
        รายการ
      </th>
      <th style="width:100px;" class="text-right tborder">
        จำนวนเงิน
      </th>
    </tr>
  </thead>
  <tbody>
      
  </tbody>
</table>

<div class="signature">
  <table class="table">
    <tfoot>
      <tr>
        <td class="text-right" colspan="2">
            รวมเป็นเงิน
        </td>
        <td class="text-right ">
            <strong><?=Yii::$app->formatter->asDecimal($model->value) ?></strong> บาท
        </td>
      </tr>
      <tr>
        <td class="text-center" style="background-color:#e0e0e0;" colspan="3">
            <strong><?=Yii::$app->thaiBath->asText($model->value)?></strong>
        </td>
      </tr>
    </tfoot>
  </table>
  <p class="">
    ได้รับเงินไว้เป็นการถูกต้องแล้ว
  </p>
  <br>
  <br>
  <p class="text-right">
    <strong>ลงชื่อ</strong>
    ......................................................
    <strong>ผู้รับเงิน</strong>
  </p>
  <p class="text-right" style="padding-right:100px;">
    <strong>( นายสาธิต สีถาพล ) </strong>
  </p>
  <p class="text-right" style="padding-right:100px; padding-left:50px;">
    <strong>ตำแหน่ง: นักวิชาการคอมพิวเตอร์</strong>
  </p>
</div>
