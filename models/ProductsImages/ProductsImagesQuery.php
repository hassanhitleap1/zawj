<?php

namespace app\models\ProductsImages;

/**
 * This is the ActiveQuery class for [[ProductsImages]].
 *
 * @see ProductsImages
 */
class ProductsImagesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProductsImages[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProductsImages|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
