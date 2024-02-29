<?php

require_once '../connection/connect.php';
$invSo = $_GET['invSo'];


$sql = "SELECT * FROM dbo.sonicdb WHERE invSo ='$invSo'";
$query = $conn->prepare($sql);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);


$check = " SELECT  COUNT(invSo) 
FROM dbo.sonicdb  
WHERE invSo IN ('$invSo')
";
$querycheck = $conn->prepare($check);
$querycheck->execute();
$resultcheck = $querycheck->fetchColumn();


if ($resultcheck == 0) {
    echo "<script>";
    echo "alert('ไม่มีข้อมูลไฟล์);";
    echo "window.history.back() ";
    echo "</script>";
}
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
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card card-dark">

                    <div class="card-header">
                        <h3 class="card-title">วันที่บันทึกเอกสาร : <?php echo  $result['dateInSo']; ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="update_ok.php" class="table table-striped table-bordered table-sm" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">INVOICE</label>
                                <div class="col-sm-3">
                                    <input type="text" name="invSo" class="form-control" value="<?php echo $result['invSo']; ?>" readonly>
                                    <input name="dateInSo" type="hidden" id="dateInSo" value="<?php echo $result['dateInSo']; ?>" />
                                </div>
                                <label class="col-sm-3 col-form-label text-right">INVOICE DATE</label>
                                <div class="col-sm-3">
                                    <input type="date" name="dateSo" class="form-control" value="<?php echo $result['dateSo']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">INVOICE CUSTOMER</label>
                                <div class="col-sm-3">
                                    <input type="text" name="invSncCusSo" class="form-control" value="<?php echo $result['invSncCusSo']; ?>">
                                </div>
                                <label class="col-sm-2 col-form-label text-right">CONSIGNEE</label>
                                <div class="col-sm-2">
                                    <input type="text" name="conSigNee" class="form-control" value="<?php echo $result['conSigNee']; ?>">
                                </div>
                                <label class="col-sm-1 col-form-label text-right">SEA</label>
                                <div class="col-sm-1">
                                    <input type="text" name="seaSo" class="form-control" value="<?php echo $result['seaSo']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">B/L NO.</label>
                                <div class="col-sm-3">
                                    <input type="text" name="blNo" class="form-control" value="<?php echo $result['blNo']; ?>">
                                </div>
                                <label class="col-sm-2 col-form-label text-right">CONTAINER 20'</label>
                                <div class="col-sm-1">
                                    <input type="text" name="conTainer20" class="form-control" value="<?php echo $result['conTainer20']; ?>">
                                </div>
                                <label class="col-sm-2 col-form-label text-right">CONTAINER 40'</label>
                                <div class="col-sm-1">
                                    <input type="text" name="conTainer40" class="form-control" value="<?php echo $result['conTainer40']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">IMPORT EMTRY NO.</label>
                                <div class="col-sm-3">
                                    <input type="text" name="importEntryNo" class="form-control" value="<?php echo $result['importEntryNo']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">EXPORT EMTRY NO.</label>
                                <div class="col-sm-3">
                                    <input type="text" name="exportEntryNo" class="form-control" value="<?php echo $result['exportEntryNo']; ?>">
                                </div>
                            </div>

                            <div class="form-group row text-center">
                                <label class="col-sm-6 col-form-label bg-dark">ADVANCE</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">CUSTOMS FEE</label>
                                <div class="col-sm-3">
                                    <input type="text" name="cusTomFee" class="form-control" value="<?php echo $result['cusTomFee']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">DUT&TAX</label>
                                <div class="col-sm-3">
                                    <input type="text" name="dutTax" class="form-control" value="<?php echo $result['dutTax']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">DELIVERY ORDER FEES</label>
                                <div class="col-sm-3">
                                    <input type="text" name="deliveryOderFee" class="form-control" value="<?php echo $result['deliveryOderFee']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">TERMINAL HANDLING CHARGE.</label>
                                <div class="col-sm-3">
                                    <input type="text" name="terminalHandlingCharge" class="form-control" value="<?php echo $result['terminalHandlingCharge']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ADVANCE LIFT ON/LIFT OFF 20-40'</label>
                                <div class="col-sm-3">
                                    <input type="text" name="advanceLiftOnLiftOff2040" class="form-control" value="<?php echo $result['advanceLiftOnLiftOff2040']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">DETENTION CHARGES</label>
                                <div class="col-sm-3">
                                    <input type="text" name="detentionCharges" class="form-control" value="<?php echo $result['detentionCharges']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">DEMURRAGE CHARGE</label>
                                <div class="col-sm-3">
                                    <input type="text" name="demurRageCharge" class="form-control" value="<?php echo $result['demurRageCharge']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">REPAIR</label>
                                <div class="col-sm-3">
                                    <input type="text" name="rePair" class="form-control" value="<?php echo $result['rePair']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">STORAGE CHARGE</label>
                                <div class="col-sm-3">
                                    <input type="text" name="storageCharge" class="form-control" value="<?php echo $result['storageCharge']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">PORT CHARGE</label>
                                <div class="col-sm-3">
                                    <input type="text" name="portCharge" class="form-control" value="<?php echo $result['portCharge']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">CUSTOMS OVER TIME</label>
                                <div class="col-sm-3">
                                    <input type="text" name="customsOvertime" class="form-control" value="<?php echo $result['customsOvertime']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ADVANCE OTHER DESCRIPTION</label>
                                <div class="col-sm-3">
                                    <input type="text" name="advanceOtherDescription" class="form-control" value="<?php echo $result['advanceOtherDescription']; ?>">
                                </div>
                                <label class="col-sm-2 col-form-label text-right">ADVANE PRICE</label>
                                <div class="col-sm-3">
                                    <input type="text" name="advanePrice" class="form-control" value="<?php echo $result['advanePrice']; ?>">
                                </div>
                            </div>


                            <div class="form-group row text-center">

                                <label class="col-sm-6 col-form-label bg-dark">CHARGE</label>
                                <div class="col-sm-3">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">CUSTOMS CLEARANCE</label>
                                <div class="col-sm-3">
                                    <input type="text" name="customsClearance" class="form-control" value="<?php echo $result['customsClearance']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">NEXT ENTRY</label>
                                <div class="col-sm-3">
                                    <input type="text" name="nextEntry" class="form-control" value="<?php echo $result['nextEntry']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">TRANSPORTATION</label>
                                <div class="col-sm-3">
                                    <input type="text" name="tranSportation" class="form-control" value="<?php echo $result['tranSportation']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">CONTAINER DROP</label>
                                <div class="col-sm-3">
                                    <input type="text" name="containerDrop" class="form-control" value="<?php echo $result['containerDrop']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">GATE FEE.</label>
                                <div class="col-sm-3">
                                    <input type="text" name="gateFee" class="form-control" value="<?php echo $result['gateFee']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">CHARGE LIFT ON/LIFT OFF 20-40'</label>
                                <div class="col-sm-3">
                                    <input type="text" name="chargeLiftOnLiftOff2040" class="form-control" value="<?php echo $result['chargeLiftOnLiftOff2040']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">TRANSPORT OVER TIME</label>
                                <div class="col-sm-3">
                                    <input type="text" name="transportOvertime" class="form-control" value="<?php echo $result['transportOvertime']; ?>">
                                </div>
                            </div>
      
                            <!-- new -->
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">OCEAN FREIGHT</label>
                                <div class="col-sm-3">
                                    <input type="text" name="oCeanFreight" class="form-control" value="<?php echo $result['oCeanFreight']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">AIR FREIGHT</label>
                                <div class="col-sm-3">
                                    <input type="text" name="airFreight" class="form-control" value="<?php echo $result['airFreight']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">CARRIER DELIVERY ORDER</label>
                                <div class="col-sm-3">
                                    <input type="text" name="carrierDeliveryOrder" class="form-control" value="<?php echo $result['carrierDeliveryOrder']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">THC PORT OF DISCHARG</label>
                                <div class="col-sm-3">
                                    <input type="text" name="thcPortOfDischarge" class="form-control" value="<?php echo $result['thcPortOfDischarge']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">CONTAINER CLEANING FEE</label>
                                <div class="col-sm-3">
                                    <input type="text" name="equipMentContainerFee" class="form-control" value="<?php echo $result['equipMentContainerFee']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">EQUIPMENT CONTAINER FEE</label>
                                <div class="col-sm-3">
                                    <input type="text" name="conTainerCleaningFee" class="form-control" value="<?php echo $result['conTainerCleaningFee']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">IMPORT HANDLING FEE</label>
                                <div class="col-sm-3">
                                    <input type="text" name="importHandingFee" class="form-control" value="<?php echo $result['importHandingFee']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">EX-WORK COST</label>
                                <div class="col-sm-3">
                                    <input type="text" name="inSuRance" class="form-control" value="<?php echo $result['inSuRance']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">INSURANCE</label>
                                <div class="col-sm-3">
                                    <input type="text" name="exWorkCost" class="form-control" value="<?php echo $result['exWorkCost']; ?>">
                                </div>
                            </div>
                            <!-- new -->


                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">CHARGE OTHER DESCRIPTION</label>
                                <div class="col-sm-3">
                                    <input type="text" name="chargeOtherDescription" class="form-control" value="<?php echo $result['chargeOtherDescription']; ?>">
                                </div>
                                <label class="col-sm-2 col-form-label text-right">CHARGE PRICE</label>
                                <div class="col-sm-3">
                                    <input type="text" name="chargePrice" class="form-control" value="<?php echo $result['chargePrice']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label bg-dark text-center">TOTAL</label>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">GROSS AMOUNT</label>
                                <div class="col-sm-3">
                                    <input type="text" name="grossAmt" class="form-control" value="<?php echo $result['grossAmt']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">VAT AMOUNT</label>
                                <div class="col-sm-3">
                                    <input type="text" name="vatAmt" class="form-control" value="<?php echo $result['vatAmt']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">TOTAL AMOUNT</label>
                                <div class="col-sm-3">
                                    <input type="text" name="totalAmt" class="form-control" value="<?php echo $result['totalAmt']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">W/T 1%</label>
                                <div class="col-sm-3">
                                    <input type="text" name="wt1" class="form-control" value="<?php echo $result['wt1']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">W/T 1% (SERVICE)</label>
                                <div class="col-sm-3">
                                    <input type="text" name="wt1_s" class="form-control" value="<?php echo $result['wt1_s']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">W/T 3%</label>
                                <div class="col-sm-3">
                                    <input type="text" name="wt3" class="form-control" value="<?php echo $result['wt3']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">AMOUNT NET</label>
                                <div class="col-sm-3">
                                    <input type="text" name="netAmt" class="form-control" value="<?php echo $result['netAmt']; ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card card-primary">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputFile">File input</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="FilesName">
                                                    <label class="custom-file-label" for="exampleInputFile">PDF File</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-sm btn-primary" name="import" value="Submit">Submit</button>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
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
<script src="../../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>

</html>