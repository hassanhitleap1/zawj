<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Products\Products $model */

$this->title = Yii::t('app', 'Update Products: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="products-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>