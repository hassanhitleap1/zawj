<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%regions}}`.
 */
class m250216_175737_create_regions_table extends Migration
{
    public $data = [
        ['name_ar' => 'عمان' ,'price_delivery'=>2],
        ['name_ar' => 'اربد','price_delivery'=>2],
        ['name_ar' => 'الزرقاء','price_delivery'=>2],
        ['name_ar' => 'معان','price_delivery'=>2],
        ['name_ar' => 'المفرق','price_delivery'=>2],
        ['name_ar' => 'العقبة','price_delivery'=>2],
        ['name_ar' => 'مادبا','price_delivery'=>2],
        ['name_ar' => 'السلط','price_delivery'=>2],
        ['name_ar' => 'الكرك','price_delivery'=>2],
        ['name_ar' => 'الطفيلة','price_delivery'=>2],
        ['name_ar' => 'عجلون','price_delivery'=>2],
        ['name_ar' => 'جرش','price_delivery'=>2],
        ['name_ar' => 'البلقاء','price_delivery'=>2],
    ];
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%regions}}', [
            'id' => $this->primaryKey(),
            'name_en' => $this->string(250)->defaultValue(null),
            'name_ar'=> $this->string(250)->notNull(),
            'price_delivery'=>$this->double()->defaultValue(null),
            'country_id'=> $this->integer()->notNull()->defaultValue(1),
            'created_at' => $this->dateTime()->defaultValue(null),
            'updated_at' => $this->dateTime()->defaultValue(null),
        ], $tableOptions);


        Yii::$app->db
        ->createCommand()
        ->batchInsert('regions', ['name_ar','price_delivery'], $this->data)
        ->execute();
    }

    public function down()
    {
        $this->dropTable('{{%regions}}');
    }
}
