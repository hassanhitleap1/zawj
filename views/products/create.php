<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Products\Products $model */

$this->title = Yii::t('app', 'Create Products');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>