<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CallData]].
 *
 * @see CallData
 */
class CallDataQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CallData[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CallData|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
