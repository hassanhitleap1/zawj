<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pages\Pages $model */

$this->title = Yii::t('app', 'Create Pages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>