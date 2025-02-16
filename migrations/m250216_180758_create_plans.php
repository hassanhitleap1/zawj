<?php

use yii\db\Migration;

class m250216_180758_create_plans extends Migration
{
 


    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%plans}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description'=> $this->text()->notNull(),
            'price' => $this->double()->notNull(),
            'created_at' => $this->dateTime()->defaultValue(null),
            'updated_at' => $this->dateTime()->defaultValue(null),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%subscriptions}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250216_180758_create_plans cannot be reverted.\n";

        return false;
    }
    */
}
