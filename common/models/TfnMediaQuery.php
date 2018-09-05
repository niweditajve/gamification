<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TfnMedia]].
 *
 * @see TfnMedia
 */
class TfnMediaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TfnMedia[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TfnMedia|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
