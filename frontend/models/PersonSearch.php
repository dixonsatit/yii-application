<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Person;

/**
 * PersonSearch represents the model behind the search form about `frontend\models\Person`.
 */
class PersonSearch extends Person
{
    public $fullname;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'age'], 'integer'],
            [['title', 'fname', 'lname', 'idcard','fullname'], 'safe'],
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
        $query = Person::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['fullname'] = [
          'asc' => ['fname' => SORT_ASC, 'lname' => SORT_ASC],
          'desc' => ['fname' => SORT_DESC, 'lname' => SORT_DESC]
        ];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        // grid filtering conditions
        $query->andFilterWhere([
            'age' => $this->age,
        ]);
        // fname like "%สาธิต%" or lname like "%สาธิต%"
        $query->andWhere('fname like :fullname or lname like :fullname ',[
          ':fullname' => "%".$this->fullname."%"
        ]);

        $query->andFilterWhere(['like', 'idcard', $this->idcard]);

        return $dataProvider;
    }
}
