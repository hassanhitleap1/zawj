<?php

use yii\db\Migration;

class m250216_175930_create_subscriptions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%subscriptions}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'plan_id'=> $this->integer()->notNull(),
            'expiration_date'=> $this->date()->notNull(),
            'status' => "ENUM('ACTIVE', 'EXPIRED') default 'ACTIVE' NOT NULL",
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
        echo "m250216_175930_create_subscriptions cannot be reverted.\n";

        return false;
    }
    */
}
