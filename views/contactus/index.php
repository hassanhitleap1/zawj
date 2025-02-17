<?php

use app\models\Contactus\Contactus;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\Contactus\ContactusPartsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'contact us');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contactus-index">




    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'email:email',
            'subject',
            'body:ntext',
            //'readed',
    
            [
                'attribute' => 'readed',
                // 'format' => 'raw',
                'value' => function ($model) {
                        return $model->readed == 1 ? 'Readed' : 'not Readed';
                    },
            ],
            //'created_at',
            //'updated_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                            return Html::a('View', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']);
                        },
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>