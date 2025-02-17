<?php

use app\models\Categories\Categories;
use app\models\Products\Products;
use yii\db\Migration;

/**
 * Class m240115_183835_set_defulat_image
 */
class m240115_183835_set_defulat_image extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $products = Products::find()->all();
        foreach ($products as $product) {

            if (empty($product->image)) {
                $product->image = 'chemical-engineering.png';
                $product->save();
            }
        }
        $catageories = Categories::find()->all();
        foreach ($catageories as $catageory) {

            if (empty($catageory->image)) {
                $catageory->image = 'chemical-engineering.png';
                $catageory->save();
            }
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240115_183835_set_defulat_image cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240115_183835_set_defulat_image cannot be reverted.\n";

        return false;
    }
    */
}
