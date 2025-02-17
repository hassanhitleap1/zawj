<?php

namespace app\models\Settings;

use Yii;

/**
 * This is the model class for table "{{%settings}}".
 *
 * @property int $id
 * @property string|null $facebook
 * @property string|null $instagram
 * @property string|null $snapchat
 * @property string|null $tiktok
 * @property string|null $youtube
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $fax
 * @property string|null $lag
 * @property string|null $lat
 * @property string|null $email
 * @property string|null $mobile
 * @property string $created_at
 * @property string $updated_at
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%settings}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['facebook', 'mobile', 'email', 'instagram', 'snapchat', 'tiktok', 'youtube', 'phone', 'address', 'fax', 'lag', 'lat'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'facebook' => Yii::t('app', 'Facebook'),
            'instagram' => Yii::t('app', 'Instagram'),
            'snapchat' => Yii::t('app', 'Snapchat'),
            'tiktok' => Yii::t('app', 'Tiktok'),
            'youtube' => Yii::t('app', 'Youtube'),
            'phone' => Yii::t('app', 'Phone'),
            'address' => Yii::t('app', 'Address'),
            'fax' => Yii::t('app', 'Fax'),
            'lag' => Yii::t('app', 'Lag'),
            'lat' => Yii::t('app', 'Lat'),
            'email' => Yii::t('app', 'Email'),
            'mobile' => Yii::t('app', 'Mobile'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return SettingsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SettingsQuery(get_called_class());
    }
}
