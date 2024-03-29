<?php

namespace frontend\modules\tutorial\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property integer $emp_id
 * @property integer $sex
 * @property string $title
 * @property string $name
 * @property string $surname
 * @property string $address
 * @property string $zip_code
 * @property string $birthday
 * @property string $email
 * @property string $mobile_phone
 * @property string $modify_date
 * @property string $create_date
 * @property string $position
 * @property integer $salary
 * @property string $expire_date
 * @property string $website
 * @property string $skill
 * @property string $countries
 * @property integer $age
 * @property string $experience
 * @property string $personal_id
 * @property integer $marital
 * @property string $province
 * @property string $amphur
 * @property string $district
 * @property string $social
 * @property string $resume
 * @property string $token_forupload
 * @property integer $count_download_resume
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * @inheritdoc
     */
     public function rules()
     {
         return [
             [['title','name','surname','sex'], 'required'],
             [['emp_id', 'salary','province','amphur','district','marital','sex','age','count_download_resume'], 'integer'],
             [['address'], 'string'],
             [['birthday', 'modify_date', 'create_date', 'expire_date','social','skill'], 'safe'],
             [['title'], 'string', 'max' => 50],
             [['name', 'surname', 'email','token_forupload'], 'string', 'max' => 100],
             [['zip_code','countries','experience'], 'string', 'max' => 10],
             [['mobile_phone','personal_id'], 'string', 'max' => 20],
             [['website','position'], 'string', 'max' => 150],
             //[['skill'], 'string', 'max' => 255],
             [['resume'],'file'],
             [['email'],'email'],
             [['website'],'url']
         ];
     }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'emp_id' => 'Emp ID',
            'sex' => 'เพศ',
            'fullname' => 'ชื่อ-นามสกุล',
            'title' => 'คำนำหน้า',
            'name' => 'ชื่อ',
            'surname' => 'นามสกุล',
            'address' => 'ที่อยู่',
            'zip_code' => 'รหัสไปรษณีย์',
            'birthday' => 'วันเกิด',
            'email' => 'อีเมล์',
            'mobile_phone' => 'เบอร์มือถือ',
            'modify_date' => 'แก้ไขวันที่',
            'create_date' => 'สร้างวันที่',
            'position' => 'ตำแหน่งงาน',
            'salary' => 'เงินเดือน',
            'expire_date' => 'วันที่ลาออก',
            'website' => 'Website',
            'skill' => 'Skill',
            'countries' => 'ประเทศ',
            'age' => 'อายุ',
            'experience' => 'ประสบการณ์การทำงาน',
            'personal_id' => 'เลขที่บัตรประชาชน',
            'marital' => 'สถานนะภาพการสมรส',
            'province' => 'จังหวัด',
            'amphur' => 'อำเภอ',
            'district' => 'ตำบล',
            'social' => 'ใช้ social network อะไรบ้าง',
            'resume' => 'ไฟล์ resume',
            'token_forupload' => 'Token Forupload',
            'count_download_resume' => 'นับจำนวนที่ download resume',
        ];
    }

    /**
     * @inheritdoc
     * @return EmployeeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmployeeQuery(get_called_class());
    }

    public function getFullname(){
      return $this->title.$this->name.' '.$this->surname;
    }

    public function itemAlias($type){
      $items = [
        'sex' => [
            '1' => 'ชาย',
            '2' => 'หญิง',
        ],
        'marital' => [
            '1' => 'โสด',
            '2' => 'สมรส',
            '3' => 'อย่างร้าง',
            '4' => 'แยกกันอยู่',
            '5' => 'หมา้ย',
        ],
        'skill'=>[
            'Objective C'=>'Objective C',
            'Python'=>'Python',
            'Java'=>'Java',
            'JavaScript'=>'JavaScript',
            'PHP'=>'PHP',
            'SQL'=>'SQL',
            'Ruby'=>'Ruby',
            'FoxPro'=>'FoxPro',
            'C++'=>'C++',
            'C'=>'C',
            'ASP'=>'ASP',
            'Assembly'=>'Assembly',
            'Visual Basic'=>'Visual Basic'
        ],
        'social' => [
            'facebook' => 'Facebook',
            'twiter' => 'Twiter',
            'google+' => 'Google+',
            'tumblr' => 'Tumblr'
        ],
      ];
      return array_key_exists($type, $items) ? $items[$type] : [];
    }

    public function getItemSex(){
      return $this->itemAlias('sex');
    }

    public function getSexName(){
      $items = $this->getItemSex();
      return array_key_exists($this->sex, $items) ? $items[$this->sex] : null;
    }
}
