<?php

use app\models\Settings\Settings;
use Carbon\Carbon;
use yii\db\Migration;

/**
 * Class m231212_005310_create_settings_tabale
 */
class m231212_005310_create_settings_tabale extends Migration
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
        $this->createTable('{{%settings}}', [
            'id' => $this->primaryKey(),
            'facebook' => $this->string(255)->null(),
            'instagram' => $this->string(255)->null(),
            'snapchat' => $this->string(255)->null(),
            'tiktok' => $this->string(255)->null(),
            'youtube' => $this->string(255)->null(),
            'phone' => $this->string(255)->null(),
            'address' => $this->string(255)->null(),
            'fax' => $this->string(255)->null(),
            'lag' => $this->string(255)->null(),
            'lat' => $this->string(255)->null(),
            'mobile' => $this->string(255)->null(),
            'email' => $this->string(255)->null(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);


        $data = [
            [
                'facebook' => 'facebook',
                'instagram' => 'instagram',
                'snapchat' => 'snapchat',
                'tiktok' => 'tiktok',
                'youtube' => 'youtube',
                'phone' => 'phone',
                'address' => 'address',
                'fax' => 'fax',
                'lag' => 'lag',
                'lat' => 'lat',
                'mobile' => 'mobile',
                'email' => 'email',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        ];





        Yii::$app->db
            ->createCommand()
            ->batchInsert(
                'settings',
                [
                    'facebook',
                    'instagram',
                    'snapchat',
                    'tiktok',
                    'youtube',
                    'phone',
                    'address',
                    'fax',
                    'lag',
                    'lat',
                    'mobile',
                    'email',
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
        $this->dropTable('{{%settings}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231212_005310_create_settings_tabale cannot be reverted.\n";

        return false;
    }
    */
}
