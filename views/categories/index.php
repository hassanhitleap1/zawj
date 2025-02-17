<?php

use app\models\Categories\Categories;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\Categories\CategoriesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */



$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-index">



    <p>
        <?= Html::a(Yii::t('app', 'Create Categories'), ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'name_ar',
            'name_en',
            'slug',

            [
                'attribute' => 'category_id',
                // Replace with your attribute
    
                'value' => function ($model) {
                        return $model->category->name_en ?? "";
                    },
            ],


            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function ($model) {
                        return Html::img($model->getImageUrl(), ['width' => '100']);
                    },
            ],
            //'meta_tag_ar',
            //'meta_tag_en',
            //'meta_desc_ar:ntext',
            //'meta_desc_en:ntext',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Categories $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>