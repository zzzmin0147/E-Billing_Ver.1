<?php
session_set_cookie_params(3600, "/");
session_start();

if (@$_SESSION['userlevel'] == null) {
    echo "<script type='text/javascript'>";
    echo "alert('Users Error !!');";
    echo "window.location = '../index.php?';";
    echo "</script>";;
    exit();
}
include 'pages/import/connection/connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OVERVIEW</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">


        <!-- Navbar -->
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
            <a href="index.php" class="brand-link bg-dark">
                <img src="dist/img/snc_logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">SNC GROUP</span>
            </a>

            <!-- Sidebar -->
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
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class=" nav-icon fa fa-light fa-file-circle-plus"></i>
                                    <p>
                                        ลงข้อมูลวางบิล VENDOR
                                        <i class="fas fa-angle-left right"></i>
                                        <span class="badge badge-info right"></span>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="pages/import/table/table_ven.php" class="nav-link ">
                                            <i class="far  nav-icon"></i>
                                            <p><small>IMPORT</i></small></p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="pages/export/table/table_ven.php" class="nav-link ">
                                            <i class="far  nav-icon"></i>
                                            <p><small>EXPORT</i></small></p>
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
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-light fa-file-pen"></i>
                                    <p>
                                        ตรวจสอบข้อมูล BOI
                                        <i class="fas fa-angle-left right"></i>
                                        <span class="badge badge-info right"></span>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="pages/import/table/table_boi.php" class="nav-link ">
                                            <i class="far  nav-icon"></i>
                                            <p><small>IMPORT</small></p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="pages/export/table/table_boi.php" class="nav-link ">
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
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-light fa-file-pen"></i>
                                    <p>
                                        ตรวจสอบข้อมูล BOI MNG
                                        <i class="fas fa-angle-left right"></i>
                                        <span class="badge badge-info right"></span>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="pages/import/table/table_boi_m.php" class="nav-link ">
                                            <i class="far  nav-icon"></i>
                                            <p><small>IMPORT</small></p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="pages/export/table/table_boi_m.php" class="nav-link ">
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
                                        <a href="pages/import/table/table_scm_m.php" class="nav-link ">
                                            <i class="far  nav-icon"></i>
                                            <p><small>IMPORT</small></p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="pages/export/table/table_scm_m.php" class="nav-link ">
                                            <i class="far  nav-icon"></i>
                                            <p><small>EXPORT</small></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php }



                        if ((@$_SESSION['userlevel'] == "md") || (@$_SESSION['userlevel'] == "admin")) {
                        ?>

                            <li class="nav-item">
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
                                        <a href="pages/import/table/table_md.php" class="nav-link ">
                                            <i class="far  nav-icon"></i>
                                            <p><small>IMPORT</small></p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="pages/export/table/table_md.php" class="nav-link ">
                                            <i class="far  nav-icon"></i>
                                            <p><small>EXPORT</small></p>
                                        </a>
                                    </li>
                                </ul>
                            <?php }
                        if ((@$_SESSION['userlevel'] == "acc") || (@$_SESSION['userlevel'] == "admin")) {
                            ?>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-light fa-file-pen"></i>
                                    <p>
                                        ตรวจสอบข้อมูล ACC
                                        <i class="fas fa-angle-left right"></i>
                                        <span class="badge badge-info right"></span>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="pages/import/table/table_acc.php" class="nav-link ">
                                            <i class="far  nav-icon"></i>
                                            <p><small>IMPORT</small></p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="pages/export/table/table_acc.php" class="nav-link ">
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
                                        <a href="pages/import/table/table_am.php" class="nav-link ">
                                            <i class="far  nav-icon"></i>
                                            <p><small>IMPORT</small></p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="pages/export/table/table_am.php" class="nav-link ">
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
                                <a href="pages/import/table_bill/table_bill.php" class="nav-link">
                                    <i class="nav-icon fa-solid fa-file-invoice-dollar"></i>
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
                            <li class="nav-item">
                                <a href="pages/import/table_pay/table_pay.php" class="nav-link">
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
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-duotone fa-file-invoice"></i>
                                    <p>
                                        ตรวจสอบสถานะ
                                        <i class="fas fa-angle-left right"></i>
                                        <span class="badge badge-info right"></span>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="pages/import/table_st/table_st.php" class="nav-link">
                                            <!-- ใส่  url-->
                                            <i class="far  nav-icon"></i>
                                            <p><small>IMPORT</small></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="pages/export/table_st/table_st.php" class="nav-link">
                                            <i class="far  nav-icon"></i>

                                            <p><small>EXPORT</small></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
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
                                        <a href="pages/import/table_wrong/table_wrong.php" class="nav-link">
                                            <!-- ใส่  url-->
                                            <i class="far  nav-icon"></i>

                                            <p><small>IMPORT</small>

                                            </p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="pages/export/table_wrong/table_wrong.php" class="nav-link">
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
                            || (@$_SESSION['userlevel'] == "scm")
                        ) {
                        ?>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class=" nav-icon fa fa-duotone fa-file-excel"></i>
                                    <p>
                                        ตรวจสอบข้อมูลยกเลิก
                                        <i class="fas fa-angle-left right"></i>
                                        <span class="badge badge-info right"></span>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="pages/import/table_cancel/table_cancel.php" class="nav-link">
                                            <!-- ใส่  url-->
                                            <i class="far  nav-icon"></i>

                                            <p><small>IMPORT</small>
                                            </p>

                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="pages/export/table_cancel/table_cancel.php" class="nav-link">
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
                            || (@$_SESSION['userlevel'] == "scm")
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
                                        <a href="pages/import/export/table_export.php" class="nav-link">
                                            <!-- ใส่  url-->
                                            <i class="far  nav-icon"></i>

                                            <p><small>IMPORT</small></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="pages/export/export/table_export.php" class="nav-link">
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
                                        <a href="pages/import/export/table_export_all.php" class="nav-link">
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
                                        <a href="pages/import/download_form/form_so_im.php" class="nav-link">
                                            <!-- ใส่  url-->
                                            <i class="far  nav-icon"></i>

                                            <p><small>IMPORT</small></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="pages/export/download_form/form_so_ex.php" class="nav-link">
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
                            <a href="logout.php" class="nav-link">
                                <i class="nav-icon fa-solid fa-arrow-right-from-bracket"></i>
                                <p>ออกจากระบบ</p>
                            </a>
                        </li>
                    </ul>
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
                            <h1 class="bg-dark color-palette">เว็บไซต์วางบิล SNC FORMER</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">

                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <?php
            if ($_SESSION['userlevel'] == "sonic") {
                include './count_bill_vendor/count_bill_vendor.php';
                include './count_bill_vendor/overview_bill_vendor.php';
            }
            if (($_SESSION['userlevel'] == "boi")
                || (@$_SESSION['userlevel'] == "boimng")
                || (@$_SESSION['userlevel'] == "acc")
                || (@$_SESSION['userlevel'] == "scm")
                || (@$_SESSION['userlevel'] == "md")
            ) {
                include './count_bill/count_bill.php';
                include './count_bill/overview_bill.php';
            }; ?>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">

            <div class="float-right d-none d-sm-inline-block">

            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
</body>

</html>