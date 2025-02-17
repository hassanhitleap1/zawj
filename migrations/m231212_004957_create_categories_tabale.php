<?php

use Carbon\Carbon;
use yii\db\Migration;

/**
 * Class m231212_004957_create_categories_tabale
 */
class m231212_004957_create_categories_tabale extends Migration
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
        $this->createTable('{{%categories}}', [
            'id' => $this->primaryKey(),
            'name_ar' => $this->string(255)->null(),
            'name_en' => $this->string(255)->notNull(),
            'slug' => $this->string(255)->notNull(),
            'category_id' => $this->integer()->null()->defaultValue(null),
            'image' => $this->string()->null(),
            'meta_tag_ar' => $this->string(255)->null()->defaultValue(null),
            'meta_tag_en' => $this->string(255)->null()->defaultValue(null),
            'meta_desc_ar' => $this->text()->null()->defaultValue(null),
            'meta_desc_en' => $this->text()->null()->defaultValue(null),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        $date = Carbon::now()->toDateTimeString();
        $data = [
            [
                'name_ar' => 'Chemical Engineering',
                'name_en' => 'Chemical Engineering',
                'slug' => 'chemical-engineering',
                'category_id' => null,
                'image' => 'chemical-engineering.png',
                'meta_tag_ar' => "Chemical Engineering",
                'meta_tag_en' => "Chemical Engineering",
                'meta_desc_ar' => "Chemical Engineering",
                'meta_desc_en' => "Chemical Engineering",
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'name_ar' => 'Electrical Engineering',
                'name_en' => 'Electrical Engineering',
                'slug' => 'electrical-engineering',
                'category_id' => null,
                'image' => 'electrical-engineering.jpg',
                'meta_tag_ar' => "Electrical Engineering",
                'meta_tag_en' => "Electrical Engineering",
                'meta_desc_ar' => "Electrical Engineering",
                'meta_desc_en' => "Electrical Engineering",
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'name_ar' => 'Mechanical Engineering',
                'name_en' => 'Mechanical Engineering',
                'slug' => 'echanical-engineering',
                'category_id' => null,
                'image' => 'mechanical-engineering.jpg',
                'meta_tag_ar' => "Mechanical Engineering",
                'meta_tag_en' => "Mechanical Engineering",
                'meta_desc_ar' => "Mechanical Engineering",
                'meta_desc_en' => "Mechanical Engineering",
                'created_at' => $date,
                'updated_at' => $date,
            ]
        ];
        Yii::$app->db
            ->createCommand()
            ->batchInsert('categories', [
                'name_ar',
                'name_en',
                'slug',
                'category_id',
                'image',
                'meta_tag_ar',
                'meta_tag_en',
                'meta_desc_ar',
                'meta_desc_en',
                'created_at',
                'updated_at'
            ], $data)
            ->execute();


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%categories}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231212_004957_create_categories_tabale cannot be reverted.\n";

        return false;
    }
    */
}
