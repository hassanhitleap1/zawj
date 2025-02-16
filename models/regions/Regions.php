<?php

namespace app\models\regions;

use Yii;

/**
 * This is the model class for table "{{%regions}}".
 *
 * @property int $id
 * @property string|null $name_en
 * @property string $name_ar
 * @property float|null $price_delivery
 * @property int $country_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Regions extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%regions}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_en', 'price_delivery', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['country_id'], 'default', 'value' => 1],
            [['name_ar'], 'required'],
            [['price_delivery'], 'number'],
            [['country_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name_en', 'name_ar'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_en' => Yii::t('app', 'Name En'),
            'name_ar' => Yii::t('app', 'Name Ar'),
            'price_delivery' => Yii::t('app', 'Price Delivery'),
            'country_id' => Yii::t('app', 'Country ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return RegionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RegionsQuery(get_called_class());
    }

}
