<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pages\Pages $model */

$this->title = Yii::t('app', 'Update Pages: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pages-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>