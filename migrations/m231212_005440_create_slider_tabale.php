<?php

use Carbon\Carbon;
use yii\db\Migration;

/**
 * Class m231212_005440_create_slider_tabale
 */
class m231212_005440_create_slider_tabale extends Migration
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
        $this->createTable('{{%slider}}', [
            'id' => $this->primaryKey(),
            'src' => $this->string(255)->notNull(),
            'title' => $this->string()->null(),
            'sub_title' => $this->string()->null(),
            'test' => $this->string()->null(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);


        $data = [
            [
                'src' => 'mb-1.jpg',
                'test' => 'Engineering business is my passion',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'src' => 'chemicalengineeringbackground.jpeg',
                'test' => 'Engineering business is my passion',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        ];


        Yii::$app->db
            ->createCommand()
            ->batchInsert(
                'slider',
                [
                    'src',
                    'test',
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
        $this->dropTable('{{%slider}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231212_005440_create_slider_tabale cannot be reverted.\n";

        return false;
    }
    */
}
