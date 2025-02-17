<?php

use Carbon\Carbon;
use yii\db\Migration;

/**
 * Class m231212_005152_create_pages_tabale
 */
class m231212_005152_create_pages_tabale extends Migration
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
        $this->createTable('{{%pages}}', [
            'id' => $this->primaryKey(),
            'key' => $this->string(255)->unique()->notNull(),
            'title_ar' => $this->string(255)->null(),
            'title_en' => $this->string(255)->notNull(),
            'desc_ar' => $this->text()->null(),
            'desc_en' => $this->text()->notNull(),
            'meta_tag_ar' => $this->string(255)->null()->defaultValue(null),
            'meta_tag_en' => $this->string(255)->null()->defaultValue(null),
            'meta_desc_ar' => $this->text()->null()->defaultValue(null),
            'meta_desc_en' => $this->text()->null()->defaultValue(null),
            'image' => $this->string()->null(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);


        $data = [
            [
                'key' => "aboutus",
                'title_ar' => "aboutus",
                'title_en' => "aboutus",
                'desc_ar' => "aboutus",
                'desc_en' => "aboutus",
                'meta_tag_ar' => "aboutus",
                'meta_tag_en' => "aboutus",
                'meta_desc_ar' => "aboutus",
                'meta_desc_en' => "aboutus",
                'image' => 'service.jpg',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'key' => "termsandconditions",
                'title_ar' => "termsandconditions",
                'title_en' => "termsandconditions",
                'desc_ar' => "termsandconditions",
                'desc_en' => "termsandconditions",
                'meta_tag_ar' => "termsandconditions",
                'meta_tag_en' => "termsandconditions",
                'meta_desc_ar' => "termsandconditions",
                'meta_desc_en' => "termsandconditions",
                'image' => 'service.jpg',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'key' => "privacypolicy",
                'title_ar' => "privacypolicy",
                'title_en' => "privacypolicy",
                'desc_ar' => "privacypolicy",
                'desc_en' => "privacypolicy",
                'meta_tag_ar' => "privacypolicy",
                'meta_tag_en' => "privacypolicy",
                'meta_desc_ar' => "privacypolicy",
                'meta_desc_en' => "privacypolicy",
                'image' => 'service.jpg',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        ];
        Yii::$app->db
            ->createCommand()
            ->batchInsert(
                'pages',
                [
                    'key',
                    'title_ar',
                    'title_en',
                    'desc_ar',
                    'desc_en',
                    'meta_tag_ar',
                    'meta_tag_en',
                    'meta_desc_ar',
                    'meta_desc_en',
                    'image',
                    'created_at',
                    'updated_at'
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
        $this->dropTable('{{%pages}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231212_005152_create_pages_tabale cannot be reverted.\n";

        return false;
    }
    */
}
