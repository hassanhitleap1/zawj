<?php

namespace app\models\Products;

use app\models\Categories\Categories;
use app\models\ProductsImages\ProductsImages;
use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%products}}".
 *
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property string $desc_ar
 * @property string $desc_en
 * @property float $price
 * @property int $category_id
 * @property string|null $image
 * @property string|null $meta_tag_ar
 * @property string|null $meta_tag_en
 * @property string|null $meta_desc_ar
 * @property string|null $meta_desc_en
 * @property string $created_at
 * @property string $updated_at
 */
class Products extends \yii\db\ActiveRecord
{

    public $file;

    public $files;

    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%products}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_en', 'desc_en', 'category_id'], 'required', 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],
            [['desc_ar', 'name_ar', 'desc_en', 'meta_desc_ar', 'meta_desc_en'], 'string', 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],
            [['price'], 'number', 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],
            [['category_id'], 'integer', 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],
            [['created_at', 'updated_at'], 'safe', 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],
            [['name_ar', 'name_en', 'meta_tag_ar', 'meta_tag_en'], 'string', 'max' => 255, 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],
            [['image'], 'string', 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],
            [['files'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'maxFiles' => 20, 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_ar' => Yii::t('app', 'Name Ar'),
            'name_en' => Yii::t('app', 'Name En'),
            'desc_ar' => Yii::t('app', 'Desc Ar'),
            'desc_en' => Yii::t('app', 'Desc En'),
            'price' => Yii::t('app', 'Price'),
            'category_id' => Yii::t('app', 'Category'),
            'image' => Yii::t('app', 'Image'),
            'meta_tag_ar' => Yii::t('app', 'Meta Tag Ar'),
            'meta_tag_en' => Yii::t('app', 'Meta Tag En'),
            'meta_desc_ar' => Yii::t('app', 'Meta Desc Ar'),
            'meta_desc_en' => Yii::t('app', 'Meta Desc En'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProductsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductsQuery(get_called_class());
    }



    public function getImageUrl()
    {
        // Assuming your imageFile attribute stores the path to the image
        return \Yii::getAlias('@web/' . $this->image);
    }

    public function getImages()
    {
        return $this->hasMany(ProductsImages::className(), ['product_id' => 'id']);
    }


    public function beforeSave($insert)
    {

        $today = Carbon::now("Asia/Amman");
        if (parent::beforeSave($insert)) {
            // Place your custom code here
            if ($this->isNewRecord) {
                $this->created_at = $today;
                $this->updated_at = $today;
            } else {
                $this->updated_at = $today;
            }

            return true;
        } else {
            return false;
        }
    }



    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }
}
