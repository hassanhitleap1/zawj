<?php

namespace app\models\user;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $full_name
 * @property int $phone_number
 * @property string|null $email
 * @property int $second_phone
 * @property string $date_of_birth
 * @property string $gender
 * @property float|null $height
 * @property float|null $weight
 * @property string $hijab_status
 * @property string $religion
 * @property int $residence_country_id
 * @property int $residence_city_id
 * @property int $origin_country_id
 * @property int $origin_city_id
 * @property string $marriage_preference
 * @property string $marital_status
 * @property int|null $has_children
 * @property int|null $children_count
 * @property string $education_level
 * @property string|null $profession
 * @property string $skin_color
 * @property string $password_hash
 * @property string $auth_key
 * @property int $status
 * @property string $religious_commitment
 * @property string $communication_preference
 * @property int $created_at
 * @property int $updated_at
 */
class User extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const GENDER_MALE = 'MALE';
    const GENDER_FEMALE = 'FEMALE';
    const HIJAB_STATUS_VEILED = 'VEILED';
    const HIJAB_STATUS_NOT_VEILED = 'NOT_VEILED';
    const HIJAB_STATUS_NONE = 'NONE';
    const RELIGION_ISLAMIC = 'ISLAMIC';
    const RELIGION_CHRISTIAN = 'CHRISTIAN';
    const MARRIAGE_PREFERENCE_NO = 'NO';
    const MARRIAGE_PREFERENCE_YES = 'YES';
    const MARRIAGE_PREFERENCE_MAYBE = 'MAYBE';
    const MARITAL_STATUS_MARRIED = 'MARRIED';
    const MARITAL_STATUS_SINGLE = 'SINGLE';
    const MARITAL_STATUS_SEPARATED = 'SEPARATED';
    const MARITAL_STATUS_WIDOW = 'WIDOW';
    const MARITAL_STATUS_DIVORCED = 'DIVORCED';
    const MARITAL_STATUS_NONE = 'NONE';
    const EDUCATION_LEVEL_MIDDLE_SCHOOL = 'MIDDLE_SCHOOL';
    const EDUCATION_LEVEL_HIGH_SCHOOL = 'HIGH_SCHOOL';
    const EDUCATION_LEVEL_UNIVERSITY = 'UNIVERSITY';
    const EDUCATION_LEVEL_MASTER = 'MASTER';
    const EDUCATION_LEVEL_DOCTORATE = 'DOCTORATE';
    const EDUCATION_LEVEL_NONE = 'NONE';
    const SKIN_COLOR_BLACK = 'BLACK';
    const SKIN_COLOR_WHITE = 'WHITE';
    const SKIN_COLOR_BROWN = 'BROWN';
    const RELIGIOUS_COMMITMENT_COMMITTED = 'COMMITTED';
    const RELIGIOUS_COMMITMENT_NOT_COMMITTED = 'NOT_COMMITTED';
    const RELIGIOUS_COMMITMENT_ABANDONED = 'ABANDONED';
    const RELIGIOUS_COMMITMENT_NONE = 'NONE';
    const COMMUNICATION_PREFERENCE_DIRECT = 'DIRECT';
    const COMMUNICATION_PREFERENCE_WITH_FAMILY = 'WITH_FAMILY';
    const COMMUNICATION_PREFERENCE_NONE = 'NONE';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'height', 'weight', 'children_count', 'profession'], 'default', 'value' => null],
            [['communication_preference'], 'default', 'value' => 'NONE'],
            [['marriage_preference'], 'default', 'value' => 'MAYBE'],
            [['has_children'], 'default', 'value' => 0],
            [['status'], 'default', 'value' => 10],
            [['full_name', 'phone_number', 'second_phone', 'date_of_birth', 'gender', 'religion', 'residence_country_id', 'residence_city_id', 'origin_country_id', 'origin_city_id', 'skin_color', 'password_hash', 'auth_key', 'created_at', 'updated_at'], 'required'],
            [['phone_number', 'second_phone', 'residence_country_id', 'residence_city_id', 'origin_country_id', 'origin_city_id', 'has_children', 'children_count', 'status', 'created_at', 'updated_at'], 'integer'],
            [['date_of_birth'], 'safe'],
            [['gender', 'hijab_status', 'religion', 'marriage_preference', 'marital_status', 'education_level', 'skin_color', 'religious_commitment', 'communication_preference'], 'string'],
            [['height', 'weight'], 'number'],
            [['full_name'], 'string', 'max' => 150],
            [['email', 'password_hash'], 'string', 'max' => 255],
            [['profession'], 'string', 'max' => 100],
            [['auth_key'], 'string', 'max' => 32],
            ['gender', 'in', 'range' => array_keys(self::optsGender())],
            ['hijab_status', 'in', 'range' => array_keys(self::optsHijabStatus())],
            ['religion', 'in', 'range' => array_keys(self::optsReligion())],
            ['marriage_preference', 'in', 'range' => array_keys(self::optsMarriagePreference())],
            ['marital_status', 'in', 'range' => array_keys(self::optsMaritalStatus())],
            ['education_level', 'in', 'range' => array_keys(self::optsEducationLevel())],
            ['skin_color', 'in', 'range' => array_keys(self::optsSkinColor())],
            ['religious_commitment', 'in', 'range' => array_keys(self::optsReligiousCommitment())],
            ['communication_preference', 'in', 'range' => array_keys(self::optsCommunicationPreference())],
            [['phone_number'], 'unique'],
            [['second_phone'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'full_name' => Yii::t('app', 'Full Name'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'email' => Yii::t('app', 'Email'),
            'second_phone' => Yii::t('app', 'Second Phone'),
            'date_of_birth' => Yii::t('app', 'Date Of Birth'),
            'gender' => Yii::t('app', 'Gender'),
            'height' => Yii::t('app', 'Height'),
            'weight' => Yii::t('app', 'Weight'),
            'hijab_status' => Yii::t('app', 'Hijab Status'),
            'religion' => Yii::t('app', 'Religion'),
            'residence_country_id' => Yii::t('app', 'Residence Country ID'),
            'residence_city_id' => Yii::t('app', 'Residence City ID'),
            'origin_country_id' => Yii::t('app', 'Origin Country ID'),
            'origin_city_id' => Yii::t('app', 'Origin City ID'),
            'marriage_preference' => Yii::t('app', 'Marriage Preference'),
            'marital_status' => Yii::t('app', 'Marital Status'),
            'has_children' => Yii::t('app', 'Has Children'),
            'children_count' => Yii::t('app', 'Children Count'),
            'education_level' => Yii::t('app', 'Education Level'),
            'profession' => Yii::t('app', 'Profession'),
            'skin_color' => Yii::t('app', 'Skin Color'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'status' => Yii::t('app', 'Status'),
            'religious_commitment' => Yii::t('app', 'Religious Commitment'),
            'communication_preference' => Yii::t('app', 'Communication Preference'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }


    /**
     * column gender ENUM value labels
     * @return string[]
     */
    public static function optsGender()
    {
        return [
            self::GENDER_MALE => Yii::t('app', 'MALE'),
            self::GENDER_FEMALE => Yii::t('app', 'FEMALE'),
        ];
    }

    /**
     * column hijab_status ENUM value labels
     * @return string[]
     */
    public static function optsHijabStatus()
    {
        return [
            self::HIJAB_STATUS_VEILED => Yii::t('app', 'VEILED'),
            self::HIJAB_STATUS_NOT_VEILED => Yii::t('app', 'NOT_VEILED'),
            self::HIJAB_STATUS_NONE => Yii::t('app', 'NONE'),
        ];
    }

    /**
     * column religion ENUM value labels
     * @return string[]
     */
    public static function optsReligion()
    {
        return [
            self::RELIGION_ISLAMIC => Yii::t('app', 'ISLAMIC'),
            self::RELIGION_CHRISTIAN => Yii::t('app', 'CHRISTIAN'),
        ];
    }

    /**
     * column marriage_preference ENUM value labels
     * @return string[]
     */
    public static function optsMarriagePreference()
    {
        return [
            self::MARRIAGE_PREFERENCE_NO => Yii::t('app', 'NO'),
            self::MARRIAGE_PREFERENCE_YES => Yii::t('app', 'YES'),
            self::MARRIAGE_PREFERENCE_MAYBE => Yii::t('app', 'MAYBE'),
        ];
    }

    /**
     * column marital_status ENUM value labels
     * @return string[]
     */
    public static function optsMaritalStatus()
    {
        return [
            self::MARITAL_STATUS_MARRIED => Yii::t('app', 'MARRIED'),
            self::MARITAL_STATUS_SINGLE => Yii::t('app', 'SINGLE'),
            self::MARITAL_STATUS_SEPARATED => Yii::t('app', 'SEPARATED'),
            self::MARITAL_STATUS_WIDOW => Yii::t('app', 'WIDOW'),
            self::MARITAL_STATUS_DIVORCED => Yii::t('app', 'DIVORCED'),
            self::MARITAL_STATUS_NONE => Yii::t('app', 'NONE'),
        ];
    }

    /**
     * column education_level ENUM value labels
     * @return string[]
     */
    public static function optsEducationLevel()
    {
        return [
            self::EDUCATION_LEVEL_MIDDLE_SCHOOL => Yii::t('app', 'MIDDLE_SCHOOL'),
            self::EDUCATION_LEVEL_HIGH_SCHOOL => Yii::t('app', 'HIGH_SCHOOL'),
            self::EDUCATION_LEVEL_UNIVERSITY => Yii::t('app', 'UNIVERSITY'),
            self::EDUCATION_LEVEL_MASTER => Yii::t('app', 'MASTER'),
            self::EDUCATION_LEVEL_DOCTORATE => Yii::t('app', 'DOCTORATE'),
            self::EDUCATION_LEVEL_NONE => Yii::t('app', 'NONE'),
        ];
    }

    /**
     * column skin_color ENUM value labels
     * @return string[]
     */
    public static function optsSkinColor()
    {
        return [
            self::SKIN_COLOR_BLACK => Yii::t('app', 'BLACK'),
            self::SKIN_COLOR_WHITE => Yii::t('app', 'WHITE'),
            self::SKIN_COLOR_BROWN => Yii::t('app', 'BROWN'),
        ];
    }

    /**
     * column religious_commitment ENUM value labels
     * @return string[]
     */
    public static function optsReligiousCommitment()
    {
        return [
            self::RELIGIOUS_COMMITMENT_COMMITTED => Yii::t('app', 'COMMITTED'),
            self::RELIGIOUS_COMMITMENT_NOT_COMMITTED => Yii::t('app', 'NOT_COMMITTED'),
            self::RELIGIOUS_COMMITMENT_ABANDONED => Yii::t('app', 'ABANDONED'),
            self::RELIGIOUS_COMMITMENT_NONE => Yii::t('app', 'NONE'),
        ];
    }

    /**
     * column communication_preference ENUM value labels
     * @return string[]
     */
    public static function optsCommunicationPreference()
    {
        return [
            self::COMMUNICATION_PREFERENCE_DIRECT => Yii::t('app', 'DIRECT'),
            self::COMMUNICATION_PREFERENCE_WITH_FAMILY => Yii::t('app', 'WITH_FAMILY'),
            self::COMMUNICATION_PREFERENCE_NONE => Yii::t('app', 'NONE'),
        ];
    }

    /**
     * @return string
     */
    public function displayGender()
    {
        return self::optsGender()[$this->gender];
    }

    /**
     * @return bool
     */
    public function isGenderMale()
    {
        return $this->gender === self::GENDER_MALE;
    }

    public function setGenderToMale()
    {
        $this->gender = self::GENDER_MALE;
    }

    /**
     * @return bool
     */
    public function isGenderFemale()
    {
        return $this->gender === self::GENDER_FEMALE;
    }

    public function setGenderToFemale()
    {
        $this->gender = self::GENDER_FEMALE;
    }

    /**
     * @return string
     */
    public function displayHijabStatus()
    {
        return self::optsHijabStatus()[$this->hijab_status];
    }

    /**
     * @return bool
     */
    public function isHijabStatusVeiled()
    {
        return $this->hijab_status === self::HIJAB_STATUS_VEILED;
    }

    public function setHijabStatusToVeiled()
    {
        $this->hijab_status = self::HIJAB_STATUS_VEILED;
    }

    /**
     * @return bool
     */
    public function isHijabStatusNotveiled()
    {
        return $this->hijab_status === self::HIJAB_STATUS_NOT_VEILED;
    }

    public function setHijabStatusToNotveiled()
    {
        $this->hijab_status = self::HIJAB_STATUS_NOT_VEILED;
    }

    /**
     * @return bool
     */
    public function isHijabStatusNone()
    {
        return $this->hijab_status === self::HIJAB_STATUS_NONE;
    }

    public function setHijabStatusToNone()
    {
        $this->hijab_status = self::HIJAB_STATUS_NONE;
    }

    /**
     * @return string
     */
    public function displayReligion()
    {
        return self::optsReligion()[$this->religion];
    }

    /**
     * @return bool
     */
    public function isReligionIslamic()
    {
        return $this->religion === self::RELIGION_ISLAMIC;
    }

    public function setReligionToIslamic()
    {
        $this->religion = self::RELIGION_ISLAMIC;
    }

    /**
     * @return bool
     */
    public function isReligionChristian()
    {
        return $this->religion === self::RELIGION_CHRISTIAN;
    }

    public function setReligionToChristian()
    {
        $this->religion = self::RELIGION_CHRISTIAN;
    }

    /**
     * @return string
     */
    public function displayMarriagePreference()
    {
        return self::optsMarriagePreference()[$this->marriage_preference];
    }

    /**
     * @return bool
     */
    public function isMarriagePreferenceNo()
    {
        return $this->marriage_preference === self::MARRIAGE_PREFERENCE_NO;
    }

    public function setMarriagePreferenceToNo()
    {
        $this->marriage_preference = self::MARRIAGE_PREFERENCE_NO;
    }

    /**
     * @return bool
     */
    public function isMarriagePreferenceYes()
    {
        return $this->marriage_preference === self::MARRIAGE_PREFERENCE_YES;
    }

    public function setMarriagePreferenceToYes()
    {
        $this->marriage_preference = self::MARRIAGE_PREFERENCE_YES;
    }

    /**
     * @return bool
     */
    public function isMarriagePreferenceMaybe()
    {
        return $this->marriage_preference === self::MARRIAGE_PREFERENCE_MAYBE;
    }

    public function setMarriagePreferenceToMaybe()
    {
        $this->marriage_preference = self::MARRIAGE_PREFERENCE_MAYBE;
    }

    /**
     * @return string
     */
    public function displayMaritalStatus()
    {
        return self::optsMaritalStatus()[$this->marital_status];
    }

    /**
     * @return bool
     */
    public function isMaritalStatusMarried()
    {
        return $this->marital_status === self::MARITAL_STATUS_MARRIED;
    }

    public function setMaritalStatusToMarried()
    {
        $this->marital_status = self::MARITAL_STATUS_MARRIED;
    }

    /**
     * @return bool
     */
    public function isMaritalStatusSingle()
    {
        return $this->marital_status === self::MARITAL_STATUS_SINGLE;
    }

    public function setMaritalStatusToSingle()
    {
        $this->marital_status = self::MARITAL_STATUS_SINGLE;
    }

    /**
     * @return bool
     */
    public function isMaritalStatusSeparated()
    {
        return $this->marital_status === self::MARITAL_STATUS_SEPARATED;
    }

    public function setMaritalStatusToSeparated()
    {
        $this->marital_status = self::MARITAL_STATUS_SEPARATED;
    }

    /**
     * @return bool
     */
    public function isMaritalStatusWidow()
    {
        return $this->marital_status === self::MARITAL_STATUS_WIDOW;
    }

    public function setMaritalStatusToWidow()
    {
        $this->marital_status = self::MARITAL_STATUS_WIDOW;
    }

    /**
     * @return bool
     */
    public function isMaritalStatusDivorced()
    {
        return $this->marital_status === self::MARITAL_STATUS_DIVORCED;
    }

    public function setMaritalStatusToDivorced()
    {
        $this->marital_status = self::MARITAL_STATUS_DIVORCED;
    }

    /**
     * @return bool
     */
    public function isMaritalStatusNone()
    {
        return $this->marital_status === self::MARITAL_STATUS_NONE;
    }

    public function setMaritalStatusToNone()
    {
        $this->marital_status = self::MARITAL_STATUS_NONE;
    }

    /**
     * @return string
     */
    public function displayEducationLevel()
    {
        return self::optsEducationLevel()[$this->education_level];
    }

    /**
     * @return bool
     */
    public function isEducationLevelMiddleschool()
    {
        return $this->education_level === self::EDUCATION_LEVEL_MIDDLE_SCHOOL;
    }

    public function setEducationLevelToMiddleschool()
    {
        $this->education_level = self::EDUCATION_LEVEL_MIDDLE_SCHOOL;
    }

    /**
     * @return bool
     */
    public function isEducationLevelHighschool()
    {
        return $this->education_level === self::EDUCATION_LEVEL_HIGH_SCHOOL;
    }

    public function setEducationLevelToHighschool()
    {
        $this->education_level = self::EDUCATION_LEVEL_HIGH_SCHOOL;
    }

    /**
     * @return bool
     */
    public function isEducationLevelUniversity()
    {
        return $this->education_level === self::EDUCATION_LEVEL_UNIVERSITY;
    }

    public function setEducationLevelToUniversity()
    {
        $this->education_level = self::EDUCATION_LEVEL_UNIVERSITY;
    }

    /**
     * @return bool
     */
    public function isEducationLevelMaster()
    {
        return $this->education_level === self::EDUCATION_LEVEL_MASTER;
    }

    public function setEducationLevelToMaster()
    {
        $this->education_level = self::EDUCATION_LEVEL_MASTER;
    }

    /**
     * @return bool
     */
    public function isEducationLevelDoctorate()
    {
        return $this->education_level === self::EDUCATION_LEVEL_DOCTORATE;
    }

    public function setEducationLevelToDoctorate()
    {
        $this->education_level = self::EDUCATION_LEVEL_DOCTORATE;
    }

    /**
     * @return bool
     */
    public function isEducationLevelNone()
    {
        return $this->education_level === self::EDUCATION_LEVEL_NONE;
    }

    public function setEducationLevelToNone()
    {
        $this->education_level = self::EDUCATION_LEVEL_NONE;
    }

    /**
     * @return string
     */
    public function displaySkinColor()
    {
        return self::optsSkinColor()[$this->skin_color];
    }

    /**
     * @return bool
     */
    public function isSkinColorBlack()
    {
        return $this->skin_color === self::SKIN_COLOR_BLACK;
    }

    public function setSkinColorToBlack()
    {
        $this->skin_color = self::SKIN_COLOR_BLACK;
    }

    /**
     * @return bool
     */
    public function isSkinColorWhite()
    {
        return $this->skin_color === self::SKIN_COLOR_WHITE;
    }

    public function setSkinColorToWhite()
    {
        $this->skin_color = self::SKIN_COLOR_WHITE;
    }

    /**
     * @return bool
     */
    public function isSkinColorBrown()
    {
        return $this->skin_color === self::SKIN_COLOR_BROWN;
    }

    public function setSkinColorToBrown()
    {
        $this->skin_color = self::SKIN_COLOR_BROWN;
    }

    /**
     * @return string
     */
    public function displayReligiousCommitment()
    {
        return self::optsReligiousCommitment()[$this->religious_commitment];
    }

    /**
     * @return bool
     */
    public function isReligiousCommitmentCommitted()
    {
        return $this->religious_commitment === self::RELIGIOUS_COMMITMENT_COMMITTED;
    }

    public function setReligiousCommitmentToCommitted()
    {
        $this->religious_commitment = self::RELIGIOUS_COMMITMENT_COMMITTED;
    }

    /**
     * @return bool
     */
    public function isReligiousCommitmentNotcommitted()
    {
        return $this->religious_commitment === self::RELIGIOUS_COMMITMENT_NOT_COMMITTED;
    }

    public function setReligiousCommitmentToNotcommitted()
    {
        $this->religious_commitment = self::RELIGIOUS_COMMITMENT_NOT_COMMITTED;
    }

    /**
     * @return bool
     */
    public function isReligiousCommitmentAbandoned()
    {
        return $this->religious_commitment === self::RELIGIOUS_COMMITMENT_ABANDONED;
    }

    public function setReligiousCommitmentToAbandoned()
    {
        $this->religious_commitment = self::RELIGIOUS_COMMITMENT_ABANDONED;
    }

    /**
     * @return bool
     */
    public function isReligiousCommitmentNone()
    {
        return $this->religious_commitment === self::RELIGIOUS_COMMITMENT_NONE;
    }

    public function setReligiousCommitmentToNone()
    {
        $this->religious_commitment = self::RELIGIOUS_COMMITMENT_NONE;
    }

    /**
     * @return string
     */
    public function displayCommunicationPreference()
    {
        return self::optsCommunicationPreference()[$this->communication_preference];
    }

    /**
     * @return bool
     */
    public function isCommunicationPreferenceDirect()
    {
        return $this->communication_preference === self::COMMUNICATION_PREFERENCE_DIRECT;
    }

    public function setCommunicationPreferenceToDirect()
    {
        $this->communication_preference = self::COMMUNICATION_PREFERENCE_DIRECT;
    }

    /**
     * @return bool
     */
    public function isCommunicationPreferenceWithfamily()
    {
        return $this->communication_preference === self::COMMUNICATION_PREFERENCE_WITH_FAMILY;
    }

    public function setCommunicationPreferenceToWithfamily()
    {
        $this->communication_preference = self::COMMUNICATION_PREFERENCE_WITH_FAMILY;
    }

    /**
     * @return bool
     */
    public function isCommunicationPreferenceNone()
    {
        return $this->communication_preference === self::COMMUNICATION_PREFERENCE_NONE;
    }

    public function setCommunicationPreferenceToNone()
    {
        $this->communication_preference = self::COMMUNICATION_PREFERENCE_NONE;
    }
}
