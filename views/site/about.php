<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>


<section>
    <div class="container my-5">
        <div class="breadcrumbs mb-3">
            <span>
                <a href="<?= Url::to(['site/index']) ?>" title=" Go to Neutron sys web" class="home">Home</a>
            </span>
            <span><i class="fa fa-angle-right"></i></span>
            <span>
                <?= Html::encode($this->title) ?>
            </span>
        </div>
        <div class="mb-5">
            <h1 class="page_title">
                <?= Html::encode($this->title) ?>
            </h1>
        </div>
        <div class="row">
            <div class="col-4">
                <img src="<?= Yii::getAlias('@web') . "/$model->image" ?>" alt="" width="100%">
            </div>
            <div class="col-8">
                <div>
                    <?php print($model->desc_en) ?>
                </div>

            </div>

        </div>
    </div>
</section>