<?php
use yii\helpers\Html;

?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>
                            <?= $countProduct ?>
                        </h3>

                        <p>Count Product</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>
                            <?= $countCategories ?>
                        </h3>

                        <p>Count Categories</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>
                            <?= $countRequastUnreaded ?>
                        </h3>

                        <p>User Requast Connect Us
                            <?= Html::a('<i class="fas fa-arrow-circle-right"> see more </i>', ['contactus/index']) ?>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>



                </div>
            </div>
            <!-- ./col -->

        </div>
        <!-- /.row -->

    </div><!-- /.container-fluid -->
</section>