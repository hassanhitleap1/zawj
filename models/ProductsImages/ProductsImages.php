<?php

namespace app\models\ProductsImages;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%products_images}}".
 *
 * @property int $id
 * @property string $image
 * @property int $product_id
 * @property string $created_at
 * @property string $updated_at
 */
class ProductsImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%products_images}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image', 'product_id'], 'required'],
            [['product_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['image'], 'string', 'max' => 255],
        ];
    }



    public function getImageUrl()
    {
        // Assuming your imageFile attribute stores the path to the image
        return \Yii::getAlias('@web/' . $this->image);
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'image' => Yii::t('app', 'Image'),
            'product_id' => Yii::t('app', 'Product '),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProductsImagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductsImagesQuery(get_called_class());
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
