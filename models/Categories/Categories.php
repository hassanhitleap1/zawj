<?php

namespace app\models\Categories;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%categories}}".
 *
 * @property int $id
 * @property string $name_ar
 * @property string $name_en
 * @property int|null $category_id
 * @property string|null $image
 * @property string|null $meta_tag_ar
 * @property string|null $meta_tag_en
 * @property string|null $meta_desc_ar
 * @property string|null $meta_desc_en
 * @property string $slug
 * @property string $created_at
 * @property string $updated_at
 */
class Categories extends \yii\db\ActiveRecord
{

    public $file;
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%categories}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_en'], 'required', 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],
            [['category_id'], 'integer', 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],
            [['meta_desc_ar', 'meta_desc_en'], 'string', 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],
            [['created_at', 'slug', 'updated_at'], 'safe', 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],
            [['name_ar', 'name_en', 'meta_tag_ar', 'meta_tag_en'], 'string', 'max' => 255, 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],
            [['image'], 'string', 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],

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
            'category_id' => Yii::t('app', 'Category '),
            'image' => Yii::t('app', 'Image'),
            'slug' => Yii::t('app', 'slug'),
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
     * @return CategoriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoriesQuery(get_called_class());
    }



    public function getCategory()
    {
        return $this->hasOne(self::className(), ['id' => 'category_id']);
    }

    public function getImageUrl()
    {
        // Assuming your imageFile attribute stores the path to the image
        return \Yii::getAlias('@web/' . $this->image);
    }
    public function beforeSave($insert)
    {

        $today = Carbon::now("Asia/Amman");

        if (parent::beforeSave($insert)) {
            // Place your custom code here
            if ($this->isNewRecord) {
                $this->slug = str_replace(' ', '-', strtolower($this->name_en));
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
}
