<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Settings\Settings $model */

$this->title = Yii::t('app', 'Update Settings: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="settings-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>