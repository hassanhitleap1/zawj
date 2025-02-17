<?php

use Carbon\Carbon;
use yii\db\Migration;

/**
 * Class m231212_005113_create_productes_tabale
 */
class m231212_005113_create_productes_tabale extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'name_ar' => $this->string(255)->null(),
            'name_en' => $this->string(255)->notNull(),
            'desc_ar' => $this->text()->null(),
            'desc_en' => $this->text()->notNull(),
            'price' => $this->double()->null(),
            'category_id' => $this->integer()->null(),
            'image' => $this->string()->null(),
            'meta_tag_ar' => $this->string(255)->null()->defaultValue(null),
            'meta_tag_en' => $this->string(255)->null()->defaultValue(null),
            'meta_desc_ar' => $this->text()->null()->defaultValue(null),
            'meta_desc_en' => $this->text()->null()->defaultValue(null),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);


        $data = [];

        for ($x = 0; $x <= 10; $x++) {
            $data[] = [
                'name_ar' => "product $x",
                'name_en' => "product $x",
                'desc_ar' => "product $x",
                'desc_en' => "product $x",
                'price' => 10,
                'category_id' => 1,
                'image' => 'mechanical-engineering.jpg',
                'meta_tag_ar' => "product $x",
                'meta_tag_en' => "product $x",
                'meta_desc_ar' => "product $x",
                'meta_desc_en' => "product $x",
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];
        }

        for ($x = 0; $x <= 10; $x++) {
            $data[] = [
                'name_ar' => "product $x",
                'name_en' => "product $x",
                'desc_ar' => "product $x",
                'desc_en' => "product $x",
                'price' => 32,
                'category_id' => 2,
                'image' => 'mechanical-engineering.jpg',
                'meta_tag_ar' => "product $x",
                'meta_tag_en' => "product $x",
                'meta_desc_ar' => "product $x",
                'meta_desc_en' => "product $x",
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];
        }


        for ($x = 0; $x <= 10; $x++) {
            $data[] = [
                'name_ar' => "product $x",
                'name_en' => "product $x",
                'desc_ar' => "product $x",
                'desc_en' => "product $x",
                'price' => 15,
                'category_id' => 3,
                'image' => 'mechanical-engineering.jpg',
                'meta_tag_ar' => "product $x",
                'meta_tag_en' => "product $x",
                'meta_desc_ar' => "product $x",
                'meta_desc_en' => "product $x",
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];
        }

        Yii::$app->db
            ->createCommand()
            ->batchInsert(
                'products',
                [
                    'name_ar',
                    'name_en',
                    'desc_ar',
                    'desc_en',
                    'price',
                    'category_id',
                    'image',
                    'meta_tag_ar',
                    'meta_tag_en',
                    'meta_desc_ar',
                    'meta_desc_en',
                    'created_at',
                    'updated_at',
                ],
                $data
            )
            ->execute();


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231212_005113_create_productes_tabale cannot be reverted.\n";

        return false;
    }
    */
}
