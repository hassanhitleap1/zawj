<?php

use app\models\Categories\Categories;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Categories\Categories $model */
/** @var yii\widgets\ActiveForm $form */

$categories = ArrayHelper::map(Categories::find()->orderBy(['name_en' => SORT_DESC])->all(), 'id', 'name_en');


$dataImage = [
    'showCaption' => false,
    'showRemove' => false,
    'showUpload' => false,
    'browseClass' => 'btn btn-primary btn-block',
    'browseLabel' => 'Select Image',
    'allowedFileTypes' => ['image'],
    'initialPreview' => [
        $model->image ? Html::img(Yii::getAlias('@web/' . $model->image), ['class' => 'file-preview-image', 'alt' => 'Uploaded Image']) : null,
    ],
    'initialPreviewConfig' => [
        $model->image ? ['caption' => 'Image 1', 'url' => Url::to(['remove-main-image', 'id' => $model->id])] : []
    ],
    'initialCaption' => $model->image ? basename($model->image) : '',
    'overwriteInitial' => true,

];

?>

<div class="categories-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">

        <div class="col-6">
            <?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-6">
            <?= $form->field($model, 'category_id')->widget(Select2::classname(), [
                'data' => $categories,
                'language' => 'en',
                'options' => ['placeholder' => 'Select a state ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
    </div>


    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'meta_tag_en')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-6">
            <?= $form->field($model, 'file')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => $dataImage
            ]);
            ?>

        </div>
    </div>


    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'meta_desc_en')->textarea(['rows' => 6]) ?>

        </div>
    </div>






    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary px-4 mt-4']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>