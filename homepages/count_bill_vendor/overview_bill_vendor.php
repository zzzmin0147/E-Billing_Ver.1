<section class="col-lg-12">
    <!-- Map card -->
    <div class="card bg-gradient-dark">
        <div class="card-header border-0">
            <h3 class="card-title">
                VENDOR <?php
                        if (@$resultim['vendor_name'] != NULL) {
                            echo $resultim['vendor_name'];
                        } elseif (@$resultex['vendor_name'] != NULL) {
                            echo $resultex['vendor_name'];
                        } else {
                        }
                        ?>
            </h3>
            <!-- card tools -->
            <div class="card-tools">
                <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-body-->
        <div class="card-footer bg-transparent">
            <?php
            if (@$resultim['vendor_name'] != NULL) {
            ?>
                <section class="content">
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">VENDOR <?= $resultim['vendor_name'] ?> IMPORT
                                    <span class="text-danger">Remaining Bill :
                                        <?php
                                        echo $resultim['st_0'] + $resultim['st_1'] + $resultim['st_2'] + $resultim['st_3'] + $resultim['st_4'] + $resultim['st_6'];
                                        ?>
                                    </span>
                                </h3>
                            </div>
                            <label></label>
                            <div class="container-fluid">
                                <!-- Small boxes (Stat box) -->
                                <div class="row">
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box" style="background-color: #F4D03F;">
                                            <div class="inner">
                                                <h3><?php echo $resultim['st_0']; ?></h3>
                                                <p>NEW BILLDEING DOCUMENT</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-bag"></i>
                                            </div>
                                            <a href="#" class="small-box-footer"></a>
                                        </div>
                                    </div>

                                    <!-- ./col -->
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box" style="background-color: #E67E22;">
                                            <div class="inner">
                                                <h3><?php echo $resultim['st_1']; ?></h3>
                                                <p>SNC ADMIN</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-person-add"></i>
                                            </div>
                                            <a href="#" class="small-box-footer"></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box" style="background-color: #D68910 ;">
                                            <div class="inner">
                                                <h3><?php echo $resultim['st_2']; ?></h3>
                                                <p>MANAGER</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-person-add"></i>
                                            </div>
                                            <a href="#" class="small-box-footer"></a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box" style="background-color: #D4AC0D ;">
                                            <div class="inner">
                                                <h3><?php echo $resultim['st_3']; ?></h3>
                                                <p>MANAGEMENT DIRECTOR SCM</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-person-add"></i>
                                            </div>
                                            <a href="#" class="small-box-footer"></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box" style="background-color: #28B463 ;">
                                            <div class="inner">
                                                <h3><?php echo $resultim['st_4']; ?></h3>
                                                <p>ACCCOUNTING</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-bag"></i>
                                            </div>
                                            <a href="#" class="small-box-footer"></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box" style="background-color: #229954 ;">
                                            <div class="inner">
                                                <h3><?php echo $resultim['st_5']; ?></h3>
                                                <p>PREPARE TO PAY</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-bag"></i>
                                            </div>
                                            <a href="#" class="small-box-footer"></a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box bg-success">
                                            <div class="inner">
                                                <h3><?php echo $resultim['st_7']; ?></h3>
                                                <p>APPROVED PAYMENT</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                            <a href="#" class="small-box-footer"></a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box bg-danger">
                                            <div class="inner">
                                                <h3><?php echo $resultim['st_6']; ?></h3>
                                                <p>WRONG INFORMATION</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-pie-graph"></i>
                                            </div>
                                            <a href="#" class="small-box-footer"></a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                </div>
                                <!-- /.row -->
                                <!-- Main row -->
                            </div>
                        </div>
                        <!-- /.row (main row) -->
                    </div><!-- /.container-fluid -->
                </section>
            <?php
            }
            if (@$resultex['vendor_name'] != NULL) {

            ?>
                <section class="content">
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">VENDOR <?= $resultex['vendor_name'] ?> EXPORT
                                    <span class="text-danger">Remaining Bill :
                                        <?php
                                        echo $resultex['st_0'] + $resultex['st_1'] + $resultex['st_2'] + $resultex['st_3'] + $resultex['st_4'] + $resultex['st_6'];
                                        ?>
                                    </span>
                                </h3>
                            </div>
                            <label></label>
                            <div class="container-fluid">
                                <!-- Small boxes (Stat box) -->
                                <div class="row">
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box" style="background-color: #F4D03F;">
                                            <div class="inner">
                                                <h3><?php echo $resultex['st_0']; ?></h3>
                                                <p>NEW BILLDEING DOCUMENT</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-bag"></i>
                                            </div>
                                            <a href="#" class="small-box-footer"></a>
                                        </div>
                                    </div>

                                    <!-- ./col -->
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box" style="background-color: #E67E22;">
                                            <div class="inner">
                                                <h3><?php echo $resultex['st_1']; ?></h3>
                                                <p>SNC ADMIN</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-person-add"></i>
                                            </div>
                                            <a href="#" class="small-box-footer"></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box" style="background-color: #D68910 ;">
                                            <div class="inner">
                                                <h3><?php echo $resultex['st_2']; ?></h3>
                                                <p>MANAGER</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-person-add"></i>
                                            </div>
                                            <a href="#" class="small-box-footer"></a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box" style="background-color: #D4AC0D ;">
                                            <div class="inner">
                                                <h3><?php echo $resultex['st_3']; ?></h3>
                                                <p>MANAGEMENT DIRECTOR SCM</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-person-add"></i>
                                            </div>
                                            <a href="#" class="small-box-footer"></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box" style="background-color: #28B463 ;">
                                            <div class="inner">
                                                <h3><?php echo $resultex['st_4']; ?></h3>
                                                <p>ACCCOUNTING</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-bag"></i>
                                            </div>
                                            <a href="#" class="small-box-footer"></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box" style="background-color: #229954 ;">
                                            <div class="inner">
                                                <h3><?php echo $resultex['st_5']; ?></h3>
                                                <p>PREPARE TO PAY</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-bag"></i>
                                            </div>
                                            <a href="#" class="small-box-footer"></a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box bg-success">
                                            <div class="inner">
                                                <h3><?php echo $resultex['st_7']; ?></h3>
                                                <p>APPROVED PAYMENT</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                            <a href="#" class="small-box-footer"></a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box bg-danger">
                                            <div class="inner">
                                                <h3><?php echo $resultex['st_6']; ?></h3>
                                                <p>WRONG INFORMATION</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-pie-graph"></i>
                                            </div>
                                            <a href="#" class="small-box-footer"></a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                </div>
                                <!-- /.row -->
                                <!-- Main row -->
                            </div>
                        </div>
                        <!-- /.row (main row) -->
                    </div><!-- /.container-fluid -->
                </section>
            <?php } ?>
        </div>
    </div>
</section>