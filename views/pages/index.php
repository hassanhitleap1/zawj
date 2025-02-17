<?php

use app\models\Pages\Pages;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\Pages\PagesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'key',
            // 'title_ar',
            'title_en',
            // 'desc_ar:ntext',
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function ($model) {
                        return Html::img($model->getImageUrl(), ['width' => '100']);
                    },
            ],
            //'desc_en:ntext',
            //'meta_tag_ar',
            //'meta_tag_en',
            //'meta_desc_ar:ntext',
            //'meta_desc_en:ntext',
            //'created_at',
            //'updated_at',
    
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {view}',

            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>