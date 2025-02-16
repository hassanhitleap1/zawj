<?php

namespace app\models\subscriptions;

use Yii;

/**
 * This is the model class for table "{{%subscriptions}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $plan_id
 * @property string $expiration_date
 * @property string $status
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Subscriptions extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_EXPIRED = 'EXPIRED';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%subscriptions}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 'ACTIVE'],
            [['user_id', 'plan_id', 'expiration_date'], 'required'],
            [['user_id', 'plan_id'], 'integer'],
            [['expiration_date', 'created_at', 'updated_at'], 'safe'],
            [['status'], 'string'],
            ['status', 'in', 'range' => array_keys(self::optsStatus())],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'plan_id' => Yii::t('app', 'Plan ID'),
            'expiration_date' => Yii::t('app', 'Expiration Date'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return SubscriptionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubscriptionsQuery(get_called_class());
    }


    /**
     * column status ENUM value labels
     * @return string[]
     */
    public static function optsStatus()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('app', 'ACTIVE'),
            self::STATUS_EXPIRED => Yii::t('app', 'EXPIRED'),
        ];
    }

    /**
     * @return string
     */
    public function displayStatus()
    {
        return self::optsStatus()[$this->status];
    }

    /**
     * @return bool
     */
    public function isStatusActive()
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function setStatusToActive()
    {
        $this->status = self::STATUS_ACTIVE;
    }

    /**
     * @return bool
     */
    public function isStatusExpired()
    {
        return $this->status === self::STATUS_EXPIRED;
    }

    public function setStatusToExpired()
    {
        $this->status = self::STATUS_EXPIRED;
    }
}
