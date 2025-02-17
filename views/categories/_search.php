<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Categories\CategoriesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="categories-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name_ar') ?>

    <?= $form->field($model, 'name_en') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'meta_tag_ar') ?>

    <?php // echo $form->field($model, 'meta_tag_en') ?>

    <?php // echo $form->field($model, 'meta_desc_ar') ?>

    <?php // echo $form->field($model, 'meta_desc_en') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
