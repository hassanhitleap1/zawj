<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Categories\Categories $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="categories-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            // 'name_ar',
            'name_en',
            'category_id',
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function ($model) {
                return Html::img($model->getImageUrl(), ['width' => '100']);
            },
            ],
            // 'meta_tag_ar',
            'meta_tag_en',
            // 'meta_desc_ar:ntext',
            'meta_desc_en:ntext',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>