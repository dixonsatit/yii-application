<?php

namespace frontend\modules\tutorial\models;

/**
 * This is the ActiveQuery class for [[Amphur]].
 *
 * @see Amphur
 */
class AmphurQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Amphur[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Amphur|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
