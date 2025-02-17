<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Categories\Categories $model */

$this->title = Yii::t('app', 'Create Categories');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>