<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\subscriptions\Subscriptions $model */

$this->title = Yii::t('app', 'Create Subscriptions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Subscriptions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscriptions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
