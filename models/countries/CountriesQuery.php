<?php

namespace app\models\countries;

/**
 * This is the ActiveQuery class for [[Countries]].
 *
 * @see Countries
 */
class CountriesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Countries[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Countries|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
