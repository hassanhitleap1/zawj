<?php

namespace app\models\Slider;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%slider}}".
 *
 * @property int $id
 * @property string $src
 * @property string|null $test
 * @property string $created_at
 * @property string $updated_at
 */
class Slider extends \yii\db\ActiveRecord
{

    public $file;
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%slider}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe', 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],
            [['src', 'test', 'title', 'sub_title'], 'string', 'max' => 255, 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'maxFiles' => 20, 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'src' => Yii::t('app', 'Src'),
            'test' => Yii::t('app', 'Test'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }


    public function getImageUrl()
    {
        // Assuming your imageFile attribute stores the path to the image
        return \Yii::getAlias('@web/' . $this->src);
    }
    /**
     * {@inheritdoc}
     * @return SliderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SliderQuery(get_called_class());
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
