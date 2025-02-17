<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\user\User $model */
/** @var yii\widgets\ActiveForm $form */



$dataImage = [
    'showCaption' => false,
    'showRemove' => false,
    'showUpload' => false,
    'browseClass' => 'btn btn-dark btn-block mt-2 btn-file',
    'browseLabel' => 'Select Image',
    'allowedFileTypes' => ['image'],
    'initialPreview' => [
        $model->avatar ? Html::img(Yii::getAlias('@web/' . $model->avatar), ['class' => 'file-preview-image', 'alt' => 'Uploaded Image']) : null,
    ],
    'initialCaption' => $model->avatar ? basename($model->avatar) : '',


];

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row">

        <div class="col-6">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        </div>
    </div>

    <div class="row">

        <div class="col-6">
            <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        </div>
    </div>



    <?= $form->field($model, 'file')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => $dataImage
    ]);
    ?>




    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary px-4 mt-4']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>