<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\medialibrary\Medialibrary $model */

$this->title = Yii::t('app', 'Create Medialibrary');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Medialibraries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medialibrary-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
