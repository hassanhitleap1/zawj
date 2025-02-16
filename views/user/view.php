<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\user\User $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'full_name',
            'phone_number',
            'email:email',
            'second_phone',
            'date_of_birth',
            'gender',
            'height',
            'weight',
            'hijab_status',
            'religion',
            'residence_country_id',
            'residence_city_id',
            'origin_country_id',
            'origin_city_id',
            'marriage_preference',
            'marital_status',
            'has_children',
            'children_count',
            'education_level',
            'profession',
            'skin_color',
            'password_hash',
            'auth_key',
            'status',
            'religious_commitment',
            'communication_preference',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
