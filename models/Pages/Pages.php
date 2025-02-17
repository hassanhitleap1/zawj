<?php

namespace app\models\Pages;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%pages}}".
 *
 * @property int $id
 * @property string $key
 * @property string $title_ar
 * @property string $title_en
 * @property string $desc_ar
 * @property string $desc_en
 * @property string|null $meta_tag_ar
 * @property string|null $meta_tag_en
 * @property string|null $meta_desc_ar
 * @property string|null $meta_desc_en
 * @property string|null $image
 * @property string $created_at
 * @property string $updated_at
 */
class Pages extends \yii\db\ActiveRecord
{



    public $file;

    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%pages}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key', 'title_en', 'desc_en'], 'required', 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],
            [['desc_ar', 'desc_en', 'meta_desc_ar', 'meta_desc_en'], 'string', 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],
            [['created_at', 'updated_at'], 'safe', 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],
            [['key', 'title_ar', 'title_en', 'meta_tag_ar', 'meta_tag_en'], 'string', 'max' => 255, 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],
            [['image'], 'string', 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],
            [['key'], 'unique', 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],
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
            'key' => Yii::t('app', 'Key'),
            'title_ar' => Yii::t('app', 'Title Ar'),
            'title_en' => Yii::t('app', 'Title En'),
            'desc_ar' => Yii::t('app', 'Desc Ar'),
            'desc_en' => Yii::t('app', 'Desc En'),
            'meta_tag_ar' => Yii::t('app', 'Meta Tag Ar'),
            'meta_tag_en' => Yii::t('app', 'Meta Tag En'),
            'meta_desc_ar' => Yii::t('app', 'Meta Desc Ar'),
            'meta_desc_en' => Yii::t('app', 'Meta Desc En'),
            'image' => Yii::t('app', 'Image'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }


    public function getImageUrl()
    {
        // Assuming your imageFile attribute stores the path to the image
        return \Yii::getAlias('@web/' . $this->image);
    }
    /**
     * {@inheritdoc}
     * @return PagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PagesQuery(get_called_class());
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
}
