<?php

namespace frontend\modules\tutorial\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\tutorial\models\Employee;

/**
 * EmployeeSearch represents the model behind the search form about `frontend\modules\tutorial\models\Employee`.
 */
class EmployeeSearch extends Employee
{
    public $fullname;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emp_id', 'sex', 'salary', 'age', 'marital', 'count_download_resume'], 'integer'],
            [['title', 'name', 'surname', 'address', 'zip_code', 'birthday', 'email', 'mobile_phone', 'modify_date', 'create_date', 'position', 'expire_date', 'website', 'skill', 'countries', 'experience', 'personal_id', 'province', 'amphur', 'district', 'social', 'resume', 'token_forupload','fullname'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Employee::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $dataProvider->sort->attributes['fullname'] = [
          'asc'=>['name'=>SORT_ASC,'surname'=>SORT_ASC],
          'desc'=>['name'=>SORT_DESC,'surname'=>SORT_DESC],
        ];

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'emp_id' => $this->emp_id,
            'sex' => $this->sex,
            'birthday' => $this->birthday,
            'modify_date' => $this->modify_date,
            'create_date' => $this->create_date,
            'salary' => $this->salary,
            'expire_date' => $this->expire_date,
            'age' => $this->age,
            'marital' => $this->marital,
            'count_download_resume' => $this->count_download_resume,
        ]);

        $query->andWhere(' name LIKE :fullname OR surname LIKE :fullname',[
          ':fullname' => "%{$this->fullname}%"
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'zip_code', $this->zip_code])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'mobile_phone', $this->mobile_phone])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'skill', $this->skill])
            ->andFilterWhere(['like', 'countries', $this->countries])
            ->andFilterWhere(['like', 'experience', $this->experience])
            ->andFilterWhere(['like', 'personal_id', $this->personal_id])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'amphur', $this->amphur])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'social', $this->social])
            ->andFilterWhere(['like', 'resume', $this->resume])
            ->andFilterWhere(['like', 'token_forupload', $this->token_forupload]);

        return $dataProvider;
    }
}
