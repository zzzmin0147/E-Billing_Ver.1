<?php

require_once '../connection/connect.php';
$invSo = $_GET['invSo'];


$sql = "SELECT * FROM dbo.sonicdb WHERE invSo ='$invSo' AND seaSo = 'EXPORT'";
$query = $conn->prepare($sql);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);
/*
$number_of_rows = $query->fetchColumn();

if ($number_of_rows == 0) {
    echo "Error !!";
    exit();
}
*/


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <div class="container-fluid">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">วันที่บันทึกเอกสาร : <td><?php

                                                                        $dateInSo = $result["dateInSo"];
                                                                        $orgDateinso = $dateInSo;
                                                                        $dateinsonew = str_replace('/', '-', $orgDateinso);
                                                                        $newDateinso = date("d/m/Y", strtotime($dateinsonew));
                                                                        echo $newDateinso;
                                                                        ?></td>
                        </h3>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="../app/apr_ok.php" method="GET" class="table table-striped table-bordered table-sm">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">INVOICE</label>
                                <div class="col-sm-6">
                                    <input type="text" name="invSo" class="form-control" id="inputEmail3" value="<?php echo $result['invSo']; ?>" readonly>
                                    <input name="stSO" type="hidden" id="stSO" value="6" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">INVOICE DATE</label>
                                <div class="col-sm-6">

                                    <input type="text" class="form-control" value="<?php

                                                                                    $dateSo = $result["dateSo"];
                                                                                    $orgDatein = $dateSo;
                                                                                    $datein = str_replace('/', '-', $orgDatein);
                                                                                    $newDatein = date("d/m/Y", strtotime($datein));
                                                                                    echo $newDatein;
                                                                                    ?>" readonly>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">CONSIGNEE</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="inputPassword3" value="<?php echo $result['conSigNee']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">INVOICE CUSTOMER</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="inputPassword3" value="<?php echo $result['invSncCusSo']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">B/L NO.</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="inputPassword3" value="<?php echo $result['blNo']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                            <label class="col-sm-3 col-form-label">IMPORT EMTRY NO.</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" value="<?php echo $result['importEntryNo']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">EXPORT EMTRY NO.</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" value="<?php echo $result['exportEntryNo'];?>" readonly>
                            </div>
                        </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">DETAILS</label>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label for="stDetail"></label>
                                        <textarea name="stDetail" id="stDetail" rows="3" cols="50"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-sm btn-primary ">Submit</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>

</body>

</html>