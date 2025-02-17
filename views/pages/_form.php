<?php

use kartik\file\FileInput;
use yii\helpers\Html;
// use kartik\editors\Summernote;
use kartik\form\ActiveForm;
use yii\helpers\Url;


$disabled = false;

if (!$model->isNewRecord) {
    $disabled = true;
}

$dataImage = [
    'showCaption' => false,
    'showRemove' => false,
    'showUpload' => false,
    'browseClass' => 'btn btn-dark btn-block mt-2 btn-file',
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

/** @var yii\web\View $this */
/** @var app\models\Pages\Pages $model */
/** @var yii\widgets\ActiveForm $form */
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js" defer></script>


<div class="pages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => true, 'disabled' => $disabled]) ?>

    <?php if ($disabled): ?>
        <?= $form->field($model, 'key')->hiddenInput(['value' => $model->key])->label(false); ?>
    <?php endif ?>

    <div class="row">

        <div class="col-6">
            <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'desc_en')->textarea(['class' => 'summernote']) ?>

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


<script>

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
                    uploadImage(image[0]);
                }
            }
        });
    });




    function uploadImage(image) {
        var data = new FormData();
        data.append("image", image);

        $.ajax({
            data: data,
            type: "POST",
            url: `${SITE_URL}/index.php?r=file/upload`,
            // returns a chain containing the path
            cache: false,
            contentType: false,
            processData: false,
            success: function (url) {
                alert('sss');
                var image = document.location.origin + url;
                setTimeout(function () {
                    $("").summernote("insertImage", image);
                }, 500);

            },
            error: function (data) {
                console.log(data);
            }
        });
    }


</script>