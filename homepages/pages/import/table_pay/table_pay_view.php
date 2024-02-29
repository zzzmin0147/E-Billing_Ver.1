<?php
session_start();


if (@$_SESSION['userlevel'] == null) {
    echo "<script type='text/javascript'>";
    echo "alert('Users Error !!');";
    echo "window.location = '../../../../index.php?';";
    echo "</script>";;
    exit();
} else {
    if ((@$_SESSION['userlevel'] == "admin")
        ||  (@$_SESSION['userlevel'] == "sonic")
        ||  (@$_SESSION['userlevel'] == "boi")
        ||  (@$_SESSION['userlevel'] == "boimng")
        ||  (@$_SESSION['userlevel'] == "md")
        ||  (@$_SESSION['userlevel'] == "acc")
        ||  (@$_SESSION['userlevel'] == "scm")
    ) {
    } else {
        echo "<script>";
        echo "alert(\" ไม่สามารถเข้าถึง User นี้ได้ \");";
        echo "window.location = '../../../../index.php?';";
        echo "</script>";
    }
};


?>
<?php
require_once '../connection/connect.php';

$userId = $_SESSION["fristname"];
$pay_id = $_REQUEST["pay_id"];

$sqlpay = "SELECT * FROM [SNC_Webapp].[dbo].[pay_db] where pay_id = '$pay_id' ";
$querypay = $conn->prepare($sqlpay);
$querypay->execute();
$resultpay = $querypay->fetch(PDO::FETCH_ASSOC);



?>

<!doctype html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <title>ตรวจสอบข้อมูลสั่งจ่าย</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../../../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../../../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../../../plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>

<body>



    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar elevation-4 sidebar-light-dark">
            <!-- Brand Logo -->
            <a href="../../../index.php" class="brand-link bg-dark">
                <img src="../../../dist/img/snc_logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">SNC GROUP</span>
            </a>

            <!-- Sidebar -->
            <?php if ((@$_SESSION['userlevel'] == "admin")
                ||  (@$_SESSION['userlevel'] == "sonic")
                ||  (@$_SESSION['userlevel'] == "boi")
                ||  (@$_SESSION['userlevel'] == "boimng")
                ||  (@$_SESSION['userlevel'] == "md")
                ||  (@$_SESSION['userlevel'] == "acc")
                ||  (@$_SESSION['userlevel'] == "scm")


            ) { ?>
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="info">
                            <a class="d-block">USER : <?php echo $_SESSION["fristname"] ?> <?php echo $_SESSION["lastname"] ?></a>
                            <a class="d-block">COMPANY : <?php echo $_SESSION["company"]; ?></a>
                        </div>
                    </div>

                    <!-- SidebarSearch Form -->

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                            <?php if ((@$_SESSION['userlevel'] == "sonic")
                                ||    (@$_SESSION['userlevel'] == "admin")
                            ) { ?>
                                <li class="nav-item ">
                                    <a href="#" class="nav-link  ">
                                        <i class=" nav-icon fa fa-light fa-file-circle-plus"></i>
                                        <p>
                                            ลงข้อมูลวางบิล VENDOR
                                            <i class="fas fa-angle-left right"></i>
                                            <span class="badge badge-info right"></span>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../import/table/table_ven.php" class="nav-link ">
                                                <i class="far  nav-icon"></i>
                                                <p><small>IMPORT</small></p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../export/table/table_ven.php" class="nav-link ">
                                                <i class="far  nav-icon"></i>
                                                <p><small>EXPORT</small></p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                            <?php }
                            if ((@$_SESSION['userlevel'] == "boi")
                                || (@$_SESSION['userlevel'] == "admin")
                            ) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link ">
                                        <i class="nav-icon fa fa-light fa-file-pen"></i>
                                        <p>
                                            ตรวจสอบข้อมูล BOI
                                            <i class="fas fa-angle-left right"></i>
                                            <span class="badge badge-info right"></span>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../import/table/table_boi.php" class="nav-link">
                                                <i class="far  nav-icon"></i>
                                                <p><small>IMPORT</small></p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../export/table/table_boi.php" class="nav-link ">
                                                <i class="far  nav-icon"></i>
                                                <p><small>EXPORT</small></p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                            <?php }
                            if ((@$_SESSION['userlevel'] == "boimng")
                                || (@$_SESSION['userlevel'] == "admin")
                            ) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link ">
                                        <i class="nav-icon fa fa-light fa-file-pen"></i>
                                        <p>
                                            ตรวจสอบข้อมูล BOI MNG
                                            <i class="fas fa-angle-left right"></i>
                                            <span class="badge badge-info right"></span>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../import/table/table_boi_m.php" class="nav-link">
                                                <i class="far  nav-icon"></i>
                                                <p><small>IMPORT</small></p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../export/table/table_boi_m.php" class="nav-link ">
                                                <i class="far  nav-icon"></i>
                                                <p><small>EXPORT</small></p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php }
                            if ((@$_SESSION['userlevel'] == "scm")
                                || (@$_SESSION['userlevel'] == "admin")
                            ) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-light fa-file-pen"></i>
                                        <p>
                                            ตรวจสอบข้อมูล SCM MNG
                                            <i class="fas fa-angle-left right"></i>
                                            <span class="badge badge-info right"></span>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../import/table/table_scm_m.php" class="nav-link">
                                                <i class="far  nav-icon"></i>
                                                <p><small>IMPORT</small></p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../export/table/table_scm_m.php" class="nav-link ">
                                                <i class="far  nav-icon"></i>
                                                <p><small>EXPORT</small></p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php }
                            if ((@$_SESSION['userlevel'] == "md")
                                || (@$_SESSION['userlevel'] == "admin")
                            ) {
                            ?>
                                <li class="nav-item ">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-light fa-file-pen"></i>
                                        <p>
                                            ตรวจสอบข้อมูล MD
                                            <i class="fas fa-angle-left right"></i>
                                            <span class="badge badge-info right"></span>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../import/table/table_md.php" class="nav-link">
                                                <i class="far  nav-icon"></i>
                                                <p><small>IMPORT</small></p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../export/table/table_md.php" class="nav-link ">
                                                <i class="far  nav-icon"></i>
                                                <p><small>EXPORT</small></p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php }
                            if ((@$_SESSION['userlevel'] == "acc")
                                || (@$_SESSION['userlevel'] == "admin")
                            ) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link ">
                                        <i class="nav-icon fa fa-light fa-file-pen"></i>
                                        <p>
                                            ตรวจสอบข้อมูล ACC
                                            <i class="fas fa-angle-left right"></i>
                                            <span class="badge badge-info right"></span>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../import/table/table_acc.php" class="nav-link"> <!-- ใส่  url-->
                                                <i class="far  nav-icon"></i>
                                                <p><small>IMPORT</small></p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../export/table/table_acc.php" class="nav-link">
                                                <i class="far  nav-icon"></i>
                                                <p><small>EXPORT</small></p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                            <?php }
                            if (@$_SESSION['userlevel'] == "admin") {
                            ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-light fa-file-pen"></i>
                                        <p>
                                            ตรวจสอบข้อมูล AM
                                            <i class="fas fa-angle-left right"></i>
                                            <span class="badge badge-info right"></span>
                                        </p>
                                    </a>

                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../import/table/table_am.php" class="nav-link">
                                                <!-- ใส่  url-->
                                                <i class="far  nav-icon"></i>

                                                <p><small>IMPORT</small></p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../export/table/table_am.php" class="nav-link">
                                                <i class="far  nav-icon"></i>

                                                <p><small>EXPORT</small></p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php }
                            if ((@$_SESSION['userlevel'] == "acc") || (@$_SESSION['userlevel'] == "admin")) {
                            ?>
                                <li class="nav-item">
                                    <a href="../../import/table_bill/table_bill.php" class="nav-link">
                                        <i class="nav-icon fa fa-duotone fa-file-invoice"></i>
                                        <p>
                                            สั่งจ่ายเอกสารวางบิล
                                        </p>
                                    </a>
                                </li>
                            <?php }
                            if ((@$_SESSION['userlevel'] == "admin")
                                || (@$_SESSION['userlevel'] == "sonic")
                                || (@$_SESSION['userlevel'] == "boi")
                                || (@$_SESSION['userlevel'] == "boimng")
                                || (@$_SESSION['userlevel'] == "md")
                                || (@$_SESSION['userlevel'] == "acc")
                            ) {
                            ?>
                                <li class="nav-item active">
                                    <a href="../../import/table_pay/table_pay.php" class="nav-link active">
                                        <i class="nav-icon fa fa-duotone fa-file-invoice"></i>
                                        <p>
                                            ตรวจสอบข้อมูลสั่งจ่าย
                                        </p>
                                    </a>
                                </li>
                            <?php }
                            if ((@$_SESSION['userlevel'] == "admin")
                                || (@$_SESSION['userlevel'] == "sonic")
                                || (@$_SESSION['userlevel'] == "boi")
                                || (@$_SESSION['userlevel'] == "boimng")
                                || (@$_SESSION['userlevel'] == "md")
                                || (@$_SESSION['userlevel'] == "acc")
                                || (@$_SESSION['userlevel'] == "scm")
                            ) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link ">
                                        <i class="nav-icon fa fa-duotone fa-file-invoice"></i>
                                        <p>
                                            ตรวจสอบสถานะ
                                            <i class="fas fa-angle-left right"></i>
                                            <span class="badge badge-info right"></span>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../import/table_st/table_st.php" class="nav-link ">
                                                <!-- ใส่  url-->
                                                <i class="far  nav-icon"></i>

                                                <p><small>IMPORT</small></p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../export/table_st/table_st.php" class="nav-link">
                                                <i class="far  nav-icon"></i>

                                                <p><small>EXPORT</small></p>
                                            </a>
                                        </li>
                                    </ul>

                                </li>
                            <?php }
                            if ((@$_SESSION['userlevel'] == "admin")
                                || (@$_SESSION['userlevel'] == "sonic")
                                || (@$_SESSION['userlevel'] == "boi")
                                || (@$_SESSION['userlevel'] == "boimng")
                                || (@$_SESSION['userlevel'] == "md")
                                || (@$_SESSION['userlevel'] == "acc")
                            ) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class=" nav-icon fa fa-duotone fa-file-excel"></i>
                                        <p>
                                            ตรวจสอบข้อมูลผิดพลาด
                                            <i class="fas fa-angle-left right"></i>
                                            <span class="badge badge-info right"></span>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../import/table_wrong/table_wrong.php" class="nav-link">
                                                <!-- ใส่  url-->
                                                <i class="far  nav-icon"></i>

                                                <p><small>IMPORT</small></p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../export/table_wrong/table_wrong.php" class="nav-link">
                                                <i class="far  nav-icon"></i>

                                                <p><small>EXPORT</small></p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php }
                            if ((@$_SESSION['userlevel'] == "admin")
                                || (@$_SESSION['userlevel'] == "sonic")
                                || (@$_SESSION['userlevel'] == "boi")
                                || (@$_SESSION['userlevel'] == "boimng")
                                || (@$_SESSION['userlevel'] == "md")
                                || (@$_SESSION['userlevel'] == "acc")
                            ) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class=" nav-icon fa fa-duotone fa-file-excel"></i>
                                        <p>
                                            ตรวจสอบข้อมูลยกเลิก
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../import/table_cancel/table_cancel.php" class="nav-link">
                                                <!-- ใส่  url-->
                                                <i class="far  nav-icon"></i>

                                                <p><small>IMPORT</small></p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../export/table_cancel/table_cancel.php" class="nav-link">
                                                <i class="far  nav-icon"></i>

                                                <p><small>EXPORT</small></p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php }
                            if ((@$_SESSION['userlevel'] == "admin")
                                || (@$_SESSION['userlevel'] == "sonic")
                                || (@$_SESSION['userlevel'] == "boi")
                                || (@$_SESSION['userlevel'] == "boimng")
                                || (@$_SESSION['userlevel'] == "md")
                                || (@$_SESSION['userlevel'] == "acc")
                            ) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-thin fa-file-export"></i>
                                        <p>
                                            Export Excel
                                            <i class="fas fa-angle-left right"></i>
                                            <span class="badge badge-info right"></span>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../import/export/table_export.php" class="nav-link">
                                                <!-- ใส่  url-->
                                                <i class="far  nav-icon"></i>

                                                <p><small>IMPORT</small></p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../export/export/table_export.php" class="nav-link">

                                                <i class="far  nav-icon"></i>
                                                <p><small>EXPORT</small></p>
                                            </a>
                                        </li>
                                    </ul>
                                <?php }
                            if ((@$_SESSION['userlevel'] == "admin")
                                || (@$_SESSION['userlevel'] == "md")
                            ) {
                                ?>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../import/export/table_export_all.php" class="nav-link">
                                                <i class="far  nav-icon"></i>
                                                <p><small>ALL</small></p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php }
                            if ((@$_SESSION['userlevel'] == "admin")
                                || (@$_SESSION['userlevel'] == "sonic")
                            ) {
                            ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa-solid fa-file-arrow-down"></i>
                                        <p>
                                            DOWNLOAD FORM
                                            <i class="fas fa-angle-left right"></i>
                                            <span class="badge badge-info right"></span>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../import/download_form/form_so_im.php" class="nav-link">
                                                <!-- ใส่  url-->
                                                <i class="far  nav-icon"></i>

                                                <p><small>IMPORT</small></p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="../../export/download_form/form_so_ex.php" class="nav-link">
                                                <i class="far  nav-icon"></i>

                                                <p><small>EXPORT</small></p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php } else {
                            }
                            ?>
                            <li class="nav-item">
                                <a href="../../../logout.php" class="nav-link">
                                    <i class="nav-icon fa-solid fa-arrow-right-from-bracket"></i>
                                    <p>ออกจากระบบ</p>
                                </a>
                            </li>
                        </ul>
                    <?php }; ?>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->



        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="bg-gray-dark color-palette">ตรวจสอบข้อมูลสั่งจ่าย</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">

                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="col-md-12">
                            <label></label>
                            <font size="2">
                                <p>สรุปค่าใช้จ่ายในการนำเข้า-ส่งออก <?php echo $resultpay['pay_vendor']; ?> งวดวันที่ : <?php echo $resultpay['pay_date']; ?></p>
                                <div class="card">
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr style="background-color:#87CEFA">
                                                    <th style="text-align:center">No.</th>
                                                    <th style="text-align:center">Date</th>
                                                    <th style="text-align:center">INVOICE No.</th>
                                                    <th style="text-align:center">ค่าบริการ</th>
                                                    <th style="text-align:center">ค่าขนส่ง</th>
                                                    <th style="text-align:center">Vat</th>
                                                    <th style="text-align:center">สำรองจ่ายให้ SNC</th>
                                                    <th style="text-align:center">Amount</th>
                                                    <th style="text-align:center"><?php

                                                                                    $sql_wt = "SELECT min(b.dateSo) as bill_date
                                                                                        FROM [SNC_Webapp].[dbo].[pay_db_detail] p_d
                                                                                        LEFT JOIN [SNC_Webapp].[dbo].[sonicdb] b
                                                                                        ON p_d.pay_bill_id = b.invSo COLLATE Thai_CI_AS 
                                                                                        WHERE p_d.pay_inv = ('$pay_id')";
                                                                                    $query_wt = $conn->prepare($sql_wt);
                                                                                    $query_wt->execute();
                                                                                    $result_wt = $query_wt->fetch(PDO::FETCH_ASSOC);
                                                                                    $bill_date = $result_wt['bill_date'];
                                                                                    if ($bill_date > '2024-02-01') {
                                                                                        echo "ค่าบริการ (หัก 1%)";
                                                                                    } else {
                                                                                        echo "ค่าบริการ (หัก 3%)";
                                                                                    }

                                                                                    ?>

                                                    </th>
                                                    <th style="text-align:center">ค่าขนส่ง (หัก 1%)</th>
                                                    <th style="text-align:center">ยอดจ่ายสุทธิ</th>
                                                    <th style="text-align:center">Approved by</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sqlinv = "SELECT pay_bill_id
                                                    FROM [SNC_Webapp].[dbo].[pay_db_detail]
                                                    WHERE pay_inv = ('$pay_id')";
                                                $queryinv = $conn->prepare($sqlinv);
                                                $queryinv->execute();
                                                $numplus = 1;
                                                $sum = 0;

                                                while ($resultinv = $queryinv->fetch(PDO::FETCH_ASSOC)) {

                                                    $inv = array($resultinv["pay_bill_id"]);
                                                    foreach ($inv as $row) {

                                                        $sql = "SELECT * 
                                                            FROM dbo.sonicdb
                                                            WHERE invSo = '$row'";
                                                        $query = $conn->prepare($sql);
                                                        $query->execute();
                                                        $result = $query->fetch(PDO::FETCH_ASSOC);

                                                ?>
                                                        <tr>
                                                            <td><?php echo $numplus++; ?> </td>
                                                            <td><?php
                                                                $dateSo = $result["dateSo"];
                                                                $orgDatein = $dateSo;
                                                                $datein = str_replace('/', '-', $orgDatein);
                                                                $newDatein = date("d/m/Y", strtotime($datein));
                                                                echo $newDatein;
                                                                ?></td>
                                                            <td><?php echo $result["invSo"]; ?></td>

                                                            <td><?php
                                                                $rowsumpc = "'" . $result["invSo"] . "'";
                                                                $sqlsumpc = "SELECT 
                                                         SUM(customsClearance
                                                         +nextEntry
                                                         +containerDrop
                                                         +gateFee
                                                         +chargeLiftOnLiftOff2040
                                                         +transportOvertime
                                                         +chargePrice
                                                         +oCeanFreight
                                                         +airFreight
                                                         +carrierDeliveryOrder
                                                         +thcPortOfDischarge
                                                         +equipMentContainerFee
                                                         +conTainerCleaningFee
                                                         +importHandingFee
                                                         +inSuRance
                                                         +exWorkCost
                                                         ) charge_p 

                                        FROM dbo.sonicdb
                                        WHERE invSo IN ($rowsumpc)";
                                                                $querysumpc = $conn->prepare($sqlsumpc);
                                                                $querysumpc->execute();
                                                                $resultsumpc = $querysumpc->fetch(PDO::FETCH_ASSOC);
                                                                echo number_format($resultsumpc['charge_p'], 2);
                                                                ?></td>


                                                            <td><?php echo number_format($result["tranSportation"], 2); ?></td>

                                                            <td><?php echo number_format($result["vatAmt"], 2); ?></td>

                                                            <td><?php
                                                                $rowsumpa = "'" . $result["invSo"] . "'";
                                                                $sqlsumpa = "SELECT 
                                                         SUM(cusTomFee
                                                         +dutTax
                                                         +deliveryOderFee
                                                         +terminalHandlingCharge
                                                         +advanceLiftOnLiftOff2040
                                                         +detentionCharges
                                                         +demurRageCharge
                                                         +rePair
                                                         +storageCharge
                                                         +portCharge
                                                         +customsOvertime
                                                         +advanePrice
                                                         ) advance_P
                                        FROM dbo.sonicdb
                                        WHERE invSo IN ($rowsumpa)";
                                                                $querysumpa = $conn->prepare($sqlsumpa);
                                                                $querysumpa->execute();
                                                                $resultsumpa = $querysumpa->fetch(PDO::FETCH_ASSOC);

                                                                echo number_format($resultsumpa['advance_P'], 2);
                                                                ?></td>

                                                            <td><?php echo number_format($result["totalAmt"], 2); ?></td>
                                                            <td><?php echo number_format($result["wt3"], 2); ?></td>
                                                            <td><?php echo number_format($result["wt1"], 2); ?></td>
                                                            <td><?php echo number_format($result["netAmt"], 2); ?></td>
                                                            <td><?php echo $result["stSoApp"]; ?></td>
                                                        </tr>


                                                <?php

                                                        $sqlsum = "SELECT SUM(totalAmt)[total]
                                                         ,SUM(wt3)[wt3]
                                                         ,SUM(wt1)[wt1] 
                                                         ,SUM(wt1_s)[wt1_s] 
                                                         ,SUM(netAmt)[net] 
                                                         ,SUM(vatAmt)[vat] 
                                                         ,SUM(tranSportation)[tran] 


                                                         ,SUM(cusTomFee
                                                         +dutTax
                                                         +deliveryOderFee
                                                         +terminalHandlingCharge
                                                         +advanceLiftOnLiftOff2040
                                                         +detentionCharges
                                                         +demurRageCharge
                                                         +rePair
                                                         +storageCharge
                                                         +portCharge
                                                         +customsOvertime
                                                         +advanePrice
                                                         )[advance] 

                                                         ,SUM(customsClearance
                                                         +nextEntry
                                                         +containerDrop
                                                         +gateFee
                                                         +chargeLiftOnLiftOff2040
                                                         +transportOvertime
                                                         +chargePrice
                                                         +oCeanFreight
                                                         +airFreight
                                                         +carrierDeliveryOrder
                                                         +thcPortOfDischarge
                                                         +equipMentContainerFee
                                                         +conTainerCleaningFee
                                                         +importHandingFee
                                                         +inSuRance
                                                         +exWorkCost
                                                         )[charge] 

                                        FROM dbo.sonicdb
                                        WHERE invSo IN ('$row')";
                                                        $querysum = $conn->prepare($sqlsum);
                                                        $querysum->execute();
                                                        $resultsum = $querysum->fetch(PDO::FETCH_ASSOC);

                                                        @$charge += $resultsum["charge"];
                                                        @$tran += $resultsum["tran"];
                                                        @$vat += $resultsum["vat"];
                                                        @$advance += $resultsum["advance"];
                                                        @$total += $resultsum["total"];
                                                        @$wt3 += $resultsum["wt3"];
                                                        @$wt1 += $resultsum["wt1"];
                                                        @$wt1_s += $resultsum["wt1_s"];
                                                        @$net += $resultsum["net"];
                                                    }
                                                };

                                                ?>
                                                <tr style="background-color:#87CEFA">
                                                    <td colspan="3" style="text-align:center">TOTAL</td>
                                                    <td><?php echo  number_format($charge, 2); ?></td>
                                                    <td><?php echo  number_format($tran, 2); ?></td>
                                                    <td><?php echo  number_format($vat, 2); ?></td>
                                                    <td><?php echo  number_format($advance, 2); ?></td>
                                                    <td><?php echo  number_format($total, 2); ?></td>
                                                    <td><?php
                                                        if ($bill_date > '2024-02-01') {
                                                            echo  number_format($wt1_s, 2);
                                                        } else {
                                                            echo  number_format($wt3, 2);
                                                        }
                                                        ?>
                                                        </td>
                                                    <td><?php echo  number_format($wt1, 2); ?></td>
                                                    <td><?php echo  number_format($net, 2); ?></td>
                                                    <td></td>
                                                </tr>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </font>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- /.content-wrapper -->
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>


    <script src="../../../plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../../../plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../../../plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../../../plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="../../../plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../../../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../../../plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../../../plugins/moment/moment.min.js"></script>
    <script src="../../../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../../../plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../../dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../../../dist/js/pages/dashboard.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>
</body>

</html>