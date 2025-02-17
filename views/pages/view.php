<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Pages\Pages $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pages-view">



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'key',
            // 'title_ar',
            'title_en',
            // 'desc_ar:ntext',
            'desc_en:ntext',
            // 'meta_tag_ar',
            'meta_tag_en',
            // 'meta_desc_ar:ntext',
            'meta_desc_en:ntext',
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function ($model) {
                        return Html::img($model->getImageUrl(), ['width' => '100']);
                    },
            ],
            // 'created_at',
            // 'updated_at',
        ],
    ]) ?>

</div>