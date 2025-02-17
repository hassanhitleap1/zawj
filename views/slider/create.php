<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Slider\Slider $model */

$this->title = Yii::t('app', 'Create Slider');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sliders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>