<?php

require_once '../connection/connect.php';
$invSo = $_GET['invSo'];


$sql = "SELECT * FROM dbo.sonicdb WHERE invSo ='$invSo' AND seaSo = 'IMPORT'";
$query = $conn->prepare($sql);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);

$countfiles = $result["FilesName"];

$countcheck = " SELECT  COUNT(FilesName) 
                        FROM dbo.sonicdb  
                        WHERE FilesName IN ('$countfiles')
                        ";
$querycount = $conn->prepare($countcheck);
$querycount->execute();
$count = $querycount->fetchColumn();

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
    <title>รายละเอียด INVOICE</title>
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>

<body>

    <div class="container-fluid">
        <div class="col-md-12">
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
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="../app/apr_ok.php" method="GET">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">INVOICE</label>
                                <?php if ($count == 1) { ?>
                                    <div class="col-sm-3">
                                        <a target="_blank" class="form-control" href="../file_export/<?php echo $result['FilesName']; ?>" readonly><?php echo $result['invSo']; ?></a>
                                    </div>
                                <?php }
                                if ($count == 0) { ?>
                                    <div class="col-sm-3">
                                        <input type="text" name="invSo" class="form-control" value="<?php echo $result['invSo']; ?>" readonly>
                                    </div>
                                <?php } ?>
                                <label class="col-sm-3 col-form-label text-right">INVOICE DATE</label>
                                <div class="col-sm-3">

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
                                <label class="col-sm-3 col-form-label">INVOICE CUSTOMER</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo $result['invSncCusSo']; ?>" readonly>
                                </div>
                                <label class="col-sm-2 col-form-label text-right">CONSIGNEE</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" value="<?php echo  $result['conSigNee'] ?>" readonly>
                                </div>
                                <label class="col-sm-1 col-form-label text-right">SEA</label>
                                <div class="col-sm-1">
                                    <input type="text" class="form-control" value="<?php echo $result['seaSo']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">B/L NO.</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo $result['blNo']; ?>" readonly>
                                </div>
                                <label class="col-sm-2 col-form-label text-right">CONTAINER 20'</label>
                                <div class="col-sm-1">
                                    <input type="text" class="form-control" value="<?php echo $result['conTainer20']; ?>" readonly>
                                </div>
                                <label class="col-sm-2 col-form-label text-right">CONTAINER 40'</label>
                                <div class="col-sm-1">
                                    <input type="text" class="form-control" value="<?php echo $result['conTainer40']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">IMPORT EMTRY NO.</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php


                                                                                    $entryim = $result['importEntryNo'];
                                                                                    $entryim_as_string = (string) $entryim;
                                                                                    $entryim_array[] = substr($entryim_as_string, 0, 4);
                                                                                    $entryim_array2[] = substr($entryim_as_string, 4, 1);
                                                                                    $entryim_array3[] = substr($entryim_as_string, 5, 4);
                                                                                    $entryim_array4[] = substr($entryim_as_string, 9, 6);


                                                                                    $entryim_with_underscores = implode("", $entryim_array);
                                                                                    $entryim_with_underscores2 = implode("", $entryim_array2);
                                                                                    $entryim_with_underscores3 = implode("", $entryim_array3);
                                                                                    $entryim_with_underscores4 = implode("", $entryim_array4);

                                                                                    echo $entryim_with_underscores . "-" .
                                                                                        $entryim_with_underscores2 . "-" .
                                                                                        $entryim_with_underscores3 . "-" .
                                                                                        $entryim_with_underscores4;

                                                                                    ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">EXPORT EMTRY NO.</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php


                                                                                    $entryex = $result['exportEntryNo'];
                                                                                    $entryex_as_string = (string) $entryex;
                                                                                    $entryex_array[] = substr($entryex_as_string, 0, 4);
                                                                                    $entryex_array2[] = substr($entryex_as_string, 4, 1);
                                                                                    $entryex_array3[] = substr($entryex_as_string, 5, 4);
                                                                                    $entryex_array4[] = substr($entryex_as_string, 9, 6);


                                                                                    $entryex_with_underscores = implode("", $entryex_array);
                                                                                    $entryex_with_underscores2 = implode("", $entryex_array2);
                                                                                    $entryex_with_underscores3 = implode("", $entryex_array3);
                                                                                    $entryex_with_underscores4 = implode("", $entryex_array4);

                                                                                    echo $entryex_with_underscores . "-" .
                                                                                        $entryex_with_underscores2 . "-" .
                                                                                        $entryex_with_underscores3 . "-" .
                                                                                        $entryex_with_underscores4;

                                                                                    ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row text-center">
                                <label class="col-sm-6 col-form-label bg-dark">ADVANCE</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">CUSTOMS FEE</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['cusTomFee'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">DUT&TAX</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['dutTax'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">DELIVERY ORDER FEES</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['deliveryOderFee'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">TERMINAL HANDLING CHARGE.</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['terminalHandlingCharge'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ADVANCE LIFT ON/LIFT OFF 20-40'</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['advanceLiftOnLiftOff2040'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">DETENTION CHARGES</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['detentionCharges'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">DEMURRAGE CHARGE</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['demurRageCharge'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">REPAIR</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['rePair'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">STORAGE CHARGE</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['storageCharge'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">PORT CHARGE</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['portCharge'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">CUSTOMS OVER TIME</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['customsOvertime'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ADVANCE OTHER DESCRIPTION</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo $result['advanceOtherDescription']; ?>" readonly>
                                </div>
                                <label class="col-sm-2 col-form-label text-right">ADVANE PRICE</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['advanePrice'], 2); ?>" readonly>
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
                                    <input type="text" class="form-control" value="<?php echo number_format($result['customsClearance'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">NEXT ENTRY</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['nextEntry'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">TRANSPORTATION</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['tranSportation'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">CONTAINER DROP</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['containerDrop'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">GATE FEE.</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['gateFee'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">CHARGE LIFT ON/LIFT OFF 20-40'</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['chargeLiftOnLiftOff2040'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">TRANSPORT OVER TIME</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['transportOvertime'], 2); ?>" readonly>
                                </div>
                            </div>


                            <!-- NEW LIST -->

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">OCEAN FREIGHT</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['oCeanFreight'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">AIR FREIGHT</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['airFreight'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">CARRIER DELIVERY ORDER</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['carrierDeliveryOrder'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">THC PORT OF DISCHARGE</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['thcPortOfDischarge'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">CONTAINER CLEANING FEE</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['equipMentContainerFee'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">EQUIPMENT CONTAINER FEE</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['conTainerCleaningFee'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">IMPORT HANDLING FEE</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['importHandingFee'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">EX-WORK COST</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['inSuRance'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">INSURANCE</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['exWorkCost'], 2); ?>" readonly>
                                </div>
                            </div>
                            <!-- NEW LIST -->

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">CHARGE OTHER DESCRIPTION</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo $result['chargeOtherDescription']; ?>" readonly>
                                </div>
                                <label class="col-sm-2 col-form-label text-right">CHARGE PRICE</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['chargePrice'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label bg-dark text-center">TOTAL</label>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">GROSS AMOUNT</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['grossAmt'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">VAT AMOUNT</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['vatAmt'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">TOTAL AMOUNT</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['totalAmt'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">W/T 1%</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['wt1'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">W/T 3%</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['wt3'], 2); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">AMOUNT NET</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?php echo number_format($result['netAmt'], 2); ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer col-sm-12">

                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label bg-dark text-center">COMMENT</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-end">DETAILS</label>
                                <div class="col-sm-3">
                                    <div class="form-group row">
                                        <textarea name="stComment" id="stComment" rows="4" cols="50" readonly><?php echo $result['stComment'] ?></textarea>
                                    </div>
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

</html>