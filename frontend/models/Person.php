<?php

namespace frontend\models;


use Yii;

/**
 * This is the model class for table "person".
 *
 * @property integer $id
 * @property string $title
 * @property string $fname
 * @property string $lname
 * @property integer $age
 * @property string $idcard
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'fname', 'lname','idcard'],'required'],
            [['age'], 'integer'],
            [['title', 'fname', 'lname'], 'string', 'max' => 255],
            [['idcard'], 'string', 'min'=>13,'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullname'=>'ชื่อ-นามสกุล',
            'title' => 'คำนำหน้า',
            'fname' => 'ชื่อ',
            'lname' => 'นามสกุล',
            'age' => 'Age',
            'idcard' => 'Idcard',
        ];
    }

    /**
     * @inheritdoc
     * @return PersonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PersonQuery(get_called_class());
    }
}
