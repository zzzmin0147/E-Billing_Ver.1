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
$company = $_SESSION['company'];
?>

<!doctype html>
<html>

<head>
    <title>สั่งจ่ายเอกสารวางบิล IMPORT/EXPORT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="../../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <!-- Select2 -->
    <link rel="stylesheet" href="../../../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="../../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="../../../plugins/bs-stepper/css/bs-stepper.min.css">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="../../../plugins/dropzone/min/dropzone.min.css">



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
                                <li class="nav-item menu-open">
                                    <a href="../../import/table_bill/table_bill.php" class="nav-link active">
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
                                <li class="nav-item">
                                    <a href="../../import/table_pay/table_pay.php" class="nav-link">
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
                                            <a href="../../import/table_st/table_st.php" class="nav-link">
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
                            <h1 class="bg-gray-dark color-palette">สั่งจ่ายเอกสารวางบิล IMPORT/EXPORT</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">

                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <section class="content">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">PROVIDER</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="" method="get">
                            <div class="row">
                                <div class="col-sm-3">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>VENDOR</label>
                                        <?php $sqlven = " SELECT * FROM dbo.usersdb where member_vendor  = 'true' ";
                                        $queryven = $conn->prepare($sqlven);
                                        $queryven->execute();
                                        ?>
                                        <select name="vendor" class="form-control" required>
                                            <option value="">-Choose-</option>
                                            <?php foreach ($queryven as $results) { ?>
                                                <option value="<?php echo $results["member_username"]; ?>">
                                                    <?php echo $results["member_fristname"]; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                    <?php
                    @$vendorim = $_REQUEST['vendor'];
                    if (is_numeric(@$_REQUEST['vendor']) == true) {
                        if ($vendorim == true) {

                            $sqlnameven = " SELECT * FROM dbo.usersdb where member_username  = '$vendorim' ";
                            $querynameven = $conn->prepare($sqlnameven);
                            $querynameven->execute();
                            $resultnameven = $querynameven->fetch(PDO::FETCH_ASSOC);
                    ?>
                </div>
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="col-md-12">

                            <form action="export_pdf_excel.php?useridSo=<?php echo $vendorim; ?>&vendorName=<?php echo $resultnameven["member_fristname"]; ?>" method="post" target="_blank">
                                <div class="card-footer">
                                    <label></label>
                                    <button type="submit" class="btn btn-sm btn-primary" name="import1" value="1"><i class="fa-solid fa-file-pdf"></i></button>
                                    <button type="submit" class="btn btn-sm btn-primary" name="import2" value="2"><i class="fa-solid fa-file-excel"></i></button>
                                </div>
                                <label></label>
                                <div class="form-group row col-md-2">
                                        งวดวันที่ : <input type="date" name="datePay" class="form-control" placeholder="งวดวันที่ : "  required/>
    
                                </div>&nbsp;&nbsp;
                                &nbsp;<label for="chkbxAll" class="selctAll-option">
                                    <input type="checkbox" id="chkbxAll" />
                                    Select All
                                </label>
                                <font size="2">
                                    <table id="table_id" class="table table-striped table-hover table-border table-sm">
                                        <thead class="table-dark">

                                            <tr>
                                                <th></th>
                                                <th>INVOICE</th>
                                                <th>INVOICE DATE</th>
                                                <th>CONSIGNEE</th>
                                                <th>INVOICE CUSTOMER</th>
                                                <th>B/L NO.</th>
                                                <th>TOTAL AMT</th>
                                                <th>STATUS</th>
                                                <th>FUNCTION</th>
                                            </tr>
                                        </thead>

                                        <?php if ($_SESSION['userlevel'] == "acc") { ?>
                                            <tbody>
                                                <?php

                                                $sql = "SELECT * FROM dbo.sonicdb WHERE stSO = 5
                                    and conSigNee ='$company' 
                                    and useridSo = '$vendorim'
                                    ORDER BY tmpSo DESC ";
                                                $query = $conn->prepare($sql);
                                                $query->execute();

                                                while ($result = $query->fetch(PDO::FETCH_ASSOC)) {

                                                ?>
                                                    <tr>
                                                        <td>

                                                            <?php
                                                            $inv = array($result["invSo"]);
                                                            foreach ($inv as $row) {
                                                                $r = "'" . $row . "'";
                                                                echo  '<label for="chkbxJS"> <input class="select-option" type="checkbox" id="chkbxJS" name="checkbox[]" value="' . $r . '"> </label>';
                                                            }
                                                            ?>
                                                        </td>
                                                        <?php if ($result["seaSo"] == 'IMPORT') { ?>
                                                            <td class="d-inline"><a class="text-decoration-none text-dark " href="*" target="popup" onclick="window.open('../../import/select/select_so.php?invSo=<?php echo $result['invSo']; ?>','name','width=1200,height=600')"><?php echo $result["invSo"]; ?><p class="material-symbols-outlined">fact_check</p></a></td>
                                                        <?php }
                                                        if ($result["seaSo"] == 'EXPORT') { ?>
                                                            <td class="d-inline"><a class="text-decoration-none text-dark " href="*" target="popup" onclick="window.open('../../export/select/select_so.php?invSo=<?php echo $result['invSo']; ?>','name','width=1200,height=600')"><?php echo $result["invSo"]; ?><p class="material-symbols-outlined">fact_check</p></a></td>


                                                        <?php } ?>
                                                        <td>
                                                            <?php
                                                            $dateSo = $result["dateSo"];
                                                            $orgDatein = $dateSo;
                                                            $datein = str_replace('/', '-', $orgDatein);
                                                            $newDatein = date("d/m/Y", strtotime($datein));
                                                            echo $newDatein;
                                                            ?></td>

                                                        <td><?php echo $result["conSigNee"]; ?></td>
                                                        <td><?php echo $result["invSncCusSo"]; ?></td>
                                                        <td><?php echo $result["blNo"]; ?></td>
                                                        <td><?php echo number_format($result["totalAmt"], 2); ?></td>
                                                        <td>
                                                            <?php
                                                            if ($result["stSO"] == '1')
                                                                echo "<span class='badge rounded-pill text-dark bg-warning'>" . $result["stShow"] . "</bage>" . "</span>";
                                                            else if ($result["stSO"] == '2')
                                                                echo "<span class='badge rounded-pill text-dark bg-warning''>" . $result["stShow"] . "</badge>" . "</span>";
                                                            else if ($result["stSO"] == '3')
                                                                echo "<span class='badge rounded-pill text-dark bg-info'>" . $result["stShow"] . "</badge>" . "</span>";
                                                            else if ($result["stSO"] == '4')
                                                                echo "<span class='badge rounded-pill bg-primary'>" . $result["stShow"] . "</badge>" . "</span>";
                                                            else if ($result["stSO"] == '5')
                                                                echo "<span class='badge rounded-pill bg-primary'>" . $result["stShow"] . "</badge>" . "</span>";
                                                            else if ($result["stSO"] == '6')
                                                                echo "<span class='text-dark bg-danger'>" . $result["stShow"] . "</badge>" . "</span>";
                                                            else echo "<span class='badge rounded-pill text-dark'>" . $result["stShow"] . "</badge>" . "</span>";
                                                            ?>

                                                        </td>
                                                        <td>
                                                            <a class="material-symbols-outlined text-decoration-none text-danger" href="*" target="popup" onclick="window.open('../select/select_so_wrong.php?invSo=<?php echo $result['invSo']; ?>','name','width=700,height=500')">close</a>
                                                            <a class="material-symbols-outlined text-decoration-none text-warning" href="*" target="popup" onclick="window.open('../edit/update.php?invSo=<?php echo $result['invSo']; ?>','name','width=1200,height=600')">edit</a>
                                                            <a target="_blank" class="material-symbols-outlined text-decoration-none text-primary" href="../file_sonic/<?php echo $result['FilesName']; ?>"><?php echo "Download"; ?></a>
                                                            <a class="material-symbols-outlined text-decoration-none text-danger" href='../delete/del.php?invSo=<?php echo $result['invSo']; ?>&FilesName=<?php echo $result['FilesName'] ?>' onclick="return confirm('Do you want to delete this record? !!!')">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php };
                                                ?>
                                            </tbody>
                                        <?php } else { ?>

                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM dbo.sonicdb WHERE stSO = 5 and useridSo = '$vendorim' 
                                    ORDER BY tmpSo DESC ";
                                                $query = $conn->prepare($sql);
                                                $query->execute();

                                                while ($result = $query->fetch(PDO::FETCH_ASSOC)) {

                                                ?>
                                                    <tr>
                                                        <td>

                                                            <?php
                                                            $inv = array($result["invSo"]);
                                                            foreach ($inv as $row) {
                                                                $r = "'" . $row . "'";
                                                                echo  '<label for="chkbxJS"> <input class="select-option" type="checkbox" id="chkbxJS" name="checkbox[]" value="' . $r . '"> </label>';
                                                            }
                                                            ?>
                                                        </td>

                                                        <?php if ($result["seaSo"] == 'IMPORT') { ?>
                                                            <td class="d-inline"><a class="text-decoration-none text-dark " href="*" target="popup" onclick="window.open('../../import/select/select_so.php?invSo=<?php echo $result['invSo']; ?>','name','width=1200,height=600')"><?php echo $result["invSo"]; ?><p class="material-symbols-outlined">fact_check</p></a></td>
                                                        <?php }
                                                        if ($result["seaSo"] == 'EXPORT') { ?>
                                                            <td class="d-inline"><a class="text-decoration-none text-dark " href="*" target="popup" onclick="window.open('../../export/select/select_so.php?invSo=<?php echo $result['invSo']; ?>','name','width=1200,height=600')"><?php echo $result["invSo"]; ?><p class="material-symbols-outlined">fact_check</p></a></td>

                                                        <?php } ?>
                                                        <td>
                                                            <?php

                                                            $dateSo = $result["dateSo"];
                                                            $orgDatein = $dateSo;
                                                            $datein = str_replace('/', '-', $orgDatein);
                                                            $newDatein = date("d/m/Y", strtotime($datein));
                                                            echo $newDatein;
                                                            ?></td>
                                                        <td><?php echo $result["conSigNee"]; ?></td>
                                                        <td><?php echo $result["invSncCusSo"]; ?></td>
                                                        <td><?php echo $result["blNo"]; ?></td>
                                                        <td><?php echo number_format($result["totalAmt"], 2); ?></td>
                                                        <td>
                                                            <?php
                                                            if ($result["stSO"] == '1')
                                                                echo "<span class='badge rounded-pill text-dark bg-warning'>" . $result["stShow"] . "</bage>" . "</span>";
                                                            else if ($result["stSO"] == '2')
                                                                echo "<span class='badge rounded-pill text-dark bg-warning''>" . $result["stShow"] . "</badge>" . "</span>";
                                                            else if ($result["stSO"] == '3')
                                                                echo "<span class='badge rounded-pill text-dark bg-info'>" . $result["stShow"] . "</badge>" . "</span>";
                                                            else if ($result["stSO"] == '4')
                                                                echo "<span class='badge rounded-pill bg-primary'>" . $result["stShow"] . "</badge>" . "</span>";
                                                            else if ($result["stSO"] == '5')
                                                                echo "<span class='badge rounded-pill bg-primary'>" . $result["stShow"] . "</badge>" . "</span>";
                                                            else if ($result["stSO"] == '6')
                                                                echo "<span class='text-dark bg-danger'>" . $result["stShow"] . "</badge>" . "</span>";
                                                            else echo "<span class='badge rounded-pill text-dark'>" . $result["stShow"] . "</badge>" . "</span>";
                                                            ?>

                                                        </td>
                                                        <td>
                                                           
                                                            <a class="material-symbols-outlined text-decoration-none text-danger" href="*" target="popup" onclick="window.open('../select/select_so_wrong.php?invSo=<?php echo $result['invSo']; ?>','name','width=700,height=500')">close</a>
                                                            <a class="material-symbols-outlined text-decoration-none text-warning" href="*" target="popup" onclick="window.open('../edit/update.php?invSo=<?php echo $result['invSo']; ?>','name','width=1200,height=600')">edit</a>
                                                            <a target="_blank" class="material-symbols-outlined text-decoration-none text-primary" href="../file_sonic/<?php echo $result['FilesName']; ?>"><?php echo "Download"; ?></a>
                                                            <a class="material-symbols-outlined text-decoration-none text-danger" href='../delete/del.php?invSo=<?php echo $result['invSo']; ?>&FilesName=<?php echo $result['FilesName'] ?>' onclick="return confirm('Do you want to delete this record? !!!')">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php };
                                                ?>
                                            </tbody>
                                <?php }
                                    }
                                } ?>


                                    </table>
                                </font>
                            </form>
                        </div>
                    </div>
                </div>
        </div>

        </section>
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
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <!-- Select2 -->
    <script src="../../../plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="../../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <script src="../../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- BS-Stepper -->
    <script src="../../../plugins/bs-stepper/js/bs-stepper.min.js"></script>
    <!-- dropzonejs -->
    <script src="../../../plugins/dropzone/min/dropzone.min.js"></script>
    <!-- AdminLTE App -->


    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
        $('#table_id').dataTable({
            aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "All"]
            ],
            iDisplayLength: -1
        });
    </script>

    <script src="../../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'L'
            });

        })
    </script>
    <script src="app.js"></script>
</body>

</html>