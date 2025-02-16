<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m250215_235630_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string(150)->notNull(),
            'phone_number' => $this->integer()->notNull()->unique(),
            'email' => $this->string()->null()->unique(),
            'second_phone' =>  $this->integer()->notNull()->unique(),
            'date_of_birth'=>$this->date()->notNull(),
            'gender' => "ENUM('MALE', 'FEMALE') NOT NULL",
            'height' => $this->double(10,2)->null(),
            'weight' => $this->double(10,2)->null(),
            'hijab_status' => "ENUM('VEILED', 'NOT_VEILED','NONE') default 'NONE' NOT NULL",
            'religion'=>"enum('ISLAMIC', 'CHRISTIAN') NOT NULL",
            'residence_country_id' => $this->integer()->notNull(),
            'residence_city_id' => $this->integer()->notNull(),
            'origin_country_id' => $this->integer()->notNull(),
            'origin_city_id' => $this->integer()->notNull(),
            'marriage_preference' => "ENUM('NO', 'YES','MAYBE') default 'MAYBE' NOT NULL",
            'marital_status' => "ENUM('MARRIED', 'SINGLE','SEPARATED','WIDOW','DIVORCED','NONE') default 'NONE' NOT NULL",
            'has_children' => $this->boolean()->defaultValue(0),
            'children_count' => $this->integer()->null(),
            'education_level' => "ENUM('MIDDLE_SCHOOL', 'HIGH_SCHOOL', 'UNIVERSITY','MASTER','DOCTORATE','NONE') default 'NONE' NOT NULL",
            'profession' => $this->string(100)->null(),
            'skin_color' =>"ENUM('BLACK', 'WHITE', 'BROWN') NOT NULL",
            'password_hash' => $this->string()->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'religious_commitment' => "ENUM('COMMITTED', 'NOT_COMMITTED', 'ABANDONED', 'NONE') default 'NONE' NOT NULL",
            'communication_preference' => "ENUM('DIRECT', 'WITH_FAMILY','NONE') default 'NONE' NOT NULL",
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
