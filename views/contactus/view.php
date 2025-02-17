<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Contactus\Contactus $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contactuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="contactus-view">



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'email:email',
            'subject',
            'body:ntext',
            // 'readed',
            [
                'attribute' => 'readed',
                // 'format' => 'raw',
                'value' => function ($model) {
                        return $model->readed == 1 ? 'Readed' : 'not Readed';
                    },
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>