<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\user\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_number')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'second_phone')->textInput() ?>

    <?= $form->field($model, 'date_of_birth')->textInput() ?>

    <?= $form->field($model, 'gender')->dropDownList([ 'MALE' => 'MALE', 'FEMALE' => 'FEMALE', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'height')->textInput() ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <?= $form->field($model, 'hijab_status')->dropDownList([ 'VEILED' => 'VEILED', 'NOT_VEILED' => 'NOT VEILED', 'NONE' => 'NONE', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'religion')->dropDownList([ 'ISLAMIC' => 'ISLAMIC', 'CHRISTIAN' => 'CHRISTIAN', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'residence_country_id')->textInput() ?>

    <?= $form->field($model, 'residence_city_id')->textInput() ?>

    <?= $form->field($model, 'origin_country_id')->textInput() ?>

    <?= $form->field($model, 'origin_city_id')->textInput() ?>

    <?= $form->field($model, 'marriage_preference')->dropDownList([ 'NO' => 'NO', 'YES' => 'YES', 'MAYBE' => 'MAYBE', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'marital_status')->dropDownList([ 'MARRIED' => 'MARRIED', 'SINGLE' => 'SINGLE', 'SEPARATED' => 'SEPARATED', 'WIDOW' => 'WIDOW', 'DIVORCED' => 'DIVORCED', 'NONE' => 'NONE', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'has_children')->textInput() ?>

    <?= $form->field($model, 'children_count')->textInput() ?>

    <?= $form->field($model, 'education_level')->dropDownList([ 'MIDDLE_SCHOOL' => 'MIDDLE SCHOOL', 'HIGH_SCHOOL' => 'HIGH SCHOOL', 'UNIVERSITY' => 'UNIVERSITY', 'MASTER' => 'MASTER', 'DOCTORATE' => 'DOCTORATE', 'NONE' => 'NONE', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'profession')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skin_color')->dropDownList([ 'BLACK' => 'BLACK', 'WHITE' => 'WHITE', 'BROWN' => 'BROWN', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'religious_commitment')->dropDownList([ 'COMMITTED' => 'COMMITTED', 'NOT_COMMITTED' => 'NOT COMMITTED', 'ABANDONED' => 'ABANDONED', 'NONE' => 'NONE', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'communication_preference')->dropDownList([ 'DIRECT' => 'DIRECT', 'WITH_FAMILY' => 'WITH FAMILY', 'NONE' => 'NONE', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
