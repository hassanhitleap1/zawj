<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\user\UserSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'full_name') ?>

    <?= $form->field($model, 'phone_number') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'second_phone') ?>

    <?php // echo $form->field($model, 'date_of_birth') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'height') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'hijab_status') ?>

    <?php // echo $form->field($model, 'religion') ?>

    <?php // echo $form->field($model, 'residence_country_id') ?>

    <?php // echo $form->field($model, 'residence_city_id') ?>

    <?php // echo $form->field($model, 'origin_country_id') ?>

    <?php // echo $form->field($model, 'origin_city_id') ?>

    <?php // echo $form->field($model, 'marriage_preference') ?>

    <?php // echo $form->field($model, 'marital_status') ?>

    <?php // echo $form->field($model, 'has_children') ?>

    <?php // echo $form->field($model, 'children_count') ?>

    <?php // echo $form->field($model, 'education_level') ?>

    <?php // echo $form->field($model, 'profession') ?>

    <?php // echo $form->field($model, 'skin_color') ?>

    <?php // echo $form->field($model, 'password_hash') ?>

    <?php // echo $form->field($model, 'auth_key') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'religious_commitment') ?>

    <?php // echo $form->field($model, 'communication_preference') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
