<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Settings\Settings $model */

$this->title = Yii::t('app', 'Create Settings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>