<?php

use app\models\Categories\Categories;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$categories = ArrayHelper::map(Categories::find()->orderBy(['name_en' => SORT_DESC])->all(), 'id', 'name_en');

/** @var yii\web\View $this */
/** @var app\models\Products\Products $model */
/** @var yii\widgets\ActiveForm $form */

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

$images_path_product = [];
$initialPreviewConfigs = [];


foreach ($model->images as $key => $value) {
    $images_path_product[] = Html::img(Yii::getAlias('@web/' . $value->image), ['class' => 'file-preview-image', 'alt' => 'Uploaded Image']);
    $initialPreviewConfigs[] = ['caption' => 'Image 1', 'url' => Url::to(['remove-image', 'id' => $value->id])];

    // Add more configuration for each image
}

$dataImages = [
    'showCaption' => false,
    'showRemove' => false,
    'showUpload' => false,
    'browseClass' => 'btn btn-dark btn-block mt-2 btn-file',
    'browseLabel' => 'Select Image',
    'allowedFileTypes' => ['image'],
    // 'initialPreviewAsData' => true,
    'initialPreview' => $images_path_product,
    'initialCaption' => $model->image ? basename($model->image) : '',
    'initialPreviewConfig' => $initialPreviewConfigs,
    // 'overwriteInitial' => true,

];

?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js" defer></script>


<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">

        <div class="col-6">
            <?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'desc_en')->textarea(['class' => 'summernote']) ?>

        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'price')->textInput() ?>
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

            <?= $form->field($model, 'meta_desc_en')->textarea(['rows' => 6]) ?>
        </div>
    </div>



    <div class="row">

        <div class="col-6">
            <?= $form->field($model, 'file')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => $dataImage
            ]);
            ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'files')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*', 'multiple' => true],
                'pluginOptions' => $dataImages
            ]);
            ?>

        </div>
    </div>











    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary px-4 mt-4']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    let SITE_URL = getCurrentSiteUrl();
    function getCurrentSiteUrl() {
        var port = window.location.port;
        var url = window.location.protocol + "//" + window.location.hostname;

        // Add port to the URL if it exists and is not the default for the protocol
        if (port && port !== "80" && port !== "443") {
            url += ":" + port;
        }

        if (url == 'http://localhost:8080') {
            return url;
        }

        return url + '/web';
    }



    $(document).ready(function () {
        $('.summernote').summernote({
            lang: 'fr-FR', // <= nobody is perfect :)
            height: 300,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['link', ['link']],
                ['picture', ['picture']]
            ],
            callbacks: {
                onImageUpload: function (image) {
                    var imagePath = uploadImage(image[0], this);
                }
            }
        });
    });






    function uploadImage(image, _this) {
        var data = new FormData();
        data.append("image", image);
        $.ajax({
            data: data,
            type: "POST",
            url: `${SITE_URL}/medialibrary/upload`,
            // returns a chain containing the path
            cache: false,
            contentType: false,
            processData: false,
            success: function (url) {

                var imagePath = document.location.origin + url;

                setTimeout(function () {
                    $(_this).summernote("insertImage", imagePath);
                }, 500);

            },
            error: function (data) {
                console.log(data);
            }
        });
    }


</script>