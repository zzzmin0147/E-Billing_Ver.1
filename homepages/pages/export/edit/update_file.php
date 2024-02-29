<?php

require_once '../connection/connect.php';
$inv_so = $_GET['inv_so'];


$sql = "SELECT * FROM dbo.sonicdb WHERE inv_so ='$inv_so'";
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

    <center>
        <form action="update_file_ok.php" method="POST" enctype="multipart/form-data" class="table table-striped table-bordered table-sm">
            <table>
            <tr>
                    <td>CONSIGNEE</td>
                    <td colspan="2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="conSigNee" value="SPEC" <?php if ($result["conSigNee"] == 'SPEC')

                                                                                                            echo "checked "; ?>>
                            <label class="form-check-label">SPEC</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="conSigNee" value="IPC" <?php if ($result["conSigNee"] == 'IPC')

                                                                                                            echo "checked "; ?>>
                            <label class="form-check-label">IPC</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="conSigNee" value="SCAN" <?php if ($result["conSigNee"] == 'SCAN')

                                                                                                            echo "checked "; ?>>
                            <label class="form-check-label">SCAN</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="conSigNee" value="MER Q" <?php if ($result["conSigNee"] == 'MER Q')

                                                                                                            echo "checked "; ?>>
                            <label class="form-check-label">MER Q</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="conSigNee" value="SAHP" <?php if ($result["conSigNee"] == 'SAHP')

                                                                                                            echo "checked "; ?>>
                            <label class="form-check-label">SAHP</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>INVOICE</td>
                    <td colspan="2">
                        <input type="text" name="inv_so" value="<?php echo $result['inv_so']; ?>" readonly>
                    </td colspan="2">
                </tr>
                <tr>
                    <td>วันที่บันทึกเอกสาร</td>
                    <td colspan="2">
                        <input type="date" name="date_so_in" value="<?php echo $result['date_so_in']; ?>" readonly>
                    </td>
                </tr>

                <tr>
                    <td>INVOICE DATE</td>
                    <td colspan="2">
                        <input type="date" name="date_so" value="<?php echo $result['date_so']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>INVOICE SNC</td>
                    <td colspan="2">
                        <input type="text" name="inv_snc_so" value="<?php echo $result['inv_snc_so']; ?>"readonly>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>ADVANCE</td>
                    <td>CHARGE</td>
                </tr>
                <tr>
                    <td>ADVANCE FEE</td>
                    <td>
                        <input type="text" name="advanceFee" value="<?php echo $result['advanceFee']; ?>">
                    </td>
                    <td>
                        <input type="text" name="advanceFee_C" value="<?php echo $result['advanceFee_C']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>ADVANCE LIFT ON/LIFT OFF</td>
                    <td>
                        <input type="text" name="advanceLiftOnOff" value="<?php echo $result['advanceLiftOnOff']; ?>">
                    </td>
                    <td>
                        <input type="text" name="advanceLiftOnOff_C" value="<?php echo $result['advanceLiftOnOff_C']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>CUSTOMS CLEARANCE CHARGE</td>
                    <td>
                        <input type="text" name="customsClearanceCharge" value="<?php echo $result['customsClearanceCharge']; ?>">
                    </td>
                    <td>
                        <input type="text" name="customsClearanceCharge_C" value="<?php echo $result['customsClearanceCharge_C']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>CUSTOMS CLEARANCE</td>
                    <td>
                        <input type="text" name="customsClearance" value="<?php echo $result['customsClearance']; ?>">
                    </td>
                    <td>
                        <input type="text" name="customsClearance_C" value="<?php echo $result['customsClearance_C']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>CUSTOMS FEE</td>
                    <td>
                        <input type="text" name="customsFee" value="<?php echo $result['customsFee']; ?>">
                    </td>
                    <td>
                        <input type="text" name="customsFee_C" value="<?php echo $result['customsFee_C']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>DUT+N:AUY TAX</td>
                    <td>
                        <input type="text" name="dutN_auyTax" value="<?php echo $result['dutN_auyTax']; ?>">
                    </td>
                    <td>
                        <input type="text" name="dutN_auyTax_C" value="<?php echo $result['dutN_auyTax_C']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>DETENTION CHARGES</td>
                    <td>
                        <input type="text" name="detenTionCharges" value="<?php echo $result['detenTionCharges']; ?>">
                    </td>
                    <td>
                        <input type="text" name="detenTionCharges_C" value="<?php echo $result['detenTionCharges_C']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>THC</td>
                    <td>
                        <input type="text" name="THC" value="<?php echo $result['THC']; ?>">
                    </td>
                    <td>
                        <input type="text" name="THC_C" value="<?php echo $result['THC_C']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>DELIVERY ORDER FEES</td>
                    <td>
                        <input type="text" name="deliveryOrderFees" value="<?php echo $result['deliveryOrderFees']; ?>">
                    </td>
                    <td>
                        <input type="text" name="deliveryOrderFees_C" value="<?php echo $result['deliveryOrderFees_C']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>DEMUR+Q125+R:AQ</td>
                    <td>
                        <input type="text" name="demur_Q125" value="<?php echo $result['demur_Q125']; ?>">
                    </td>
                    <td>
                        <input type="text" name="demur_Q125_C" value="<?php echo $result['demur_Q125_C']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>EQUIPMENT CHARGE</td>
                    <td>
                        <input type="text" name="equipmentCharge" value="<?php echo $result['equipmentCharge']; ?>">
                    </td>
                    <td>
                        <input type="text" name="equipmentCharge_C" value="<?php echo $result['equipmentCharge_C']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>EXTRA MOVE CHARGE</td>
                    <td>
                        <input type="text" name="extraMoveCharge" value="<?php echo $result['extraMoveCharge']; ?>">
                    </td>
                    <td>
                        <input type="text" name="extraMoveCharge_C" value="<?php echo $result['extraMoveCharge_C']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>EXTER CONTAUNER CHARGE</td>
                    <td>
                        <input type="text" name="exterContaunerCharge" value="<?php echo $result['exterContaunerCharge']; ?>">
                    </td>
                    <td>
                        <input type="text" name="exterContaunerCharge_C" value="<?php echo $result['exterContaunerCharge_C']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>LIFT ON/LIFT OFF -20'</td>
                    <td>
                        <input type="text" name="liftOnOff20" value="<?php echo $result['liftOnOff20']; ?>">
                    </td>
                    <td>
                        <input type="text" name="liftOnOff20_C" value="<?php echo $result['liftOnOff20_C']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>LIFT ON/LIFT OFF -40'</td>
                    <td>
                        <input type="text" name="liftOnOff40" value="<?php echo $result['liftOnOff40']; ?>">
                    </td>
                    <td>
                        <input type="text" name="liftOnOff40_C" value="<?php echo $result['liftOnOff40_C']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>LIFT ON/LIFT OFF</td>
                    <td>
                        <input type="text" name="liftOnOff" value="<?php echo $result['liftOnOff']; ?>">
                    </td>
                    <td>
                        <input type="text" name="liftOnOff_C" value="<?php echo $result['liftOnOff_C']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>GATE FEE</td>
                    <td>
                        <input type="text" name="gateFee" value="<?php echo $result['gateFee']; ?>">
                    </td>
                    <td>
                        <input type="text" name="gateFee_C" value="<?php echo $result['gateFee_C']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>OVER TIME</td>
                    <td>
                        <input type="text" name="overTime" value="<?php echo $result['overTime']; ?>">
                    </td>
                    <td>
                        <input type="text" name="overTime_C" value="<?php echo $result['overTime_C']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>CLEANING CHANGES</td>
                    <td>
                        <input type="text" name="cleaningChanges" value="<?php echo $result['cleaningChanges']; ?>">
                    </td>
                    <td>
                        <input type="text" name="cleaningChanges_C" value="<?php echo $result['cleaningChanges_C']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>REPAIR</td>
                    <td>
                        <input type="text" name="Repair" value="<?php echo $result['Repair']; ?>">
                    </td>
                    <td>
                        <input type="text" name="Repair_C" value="<?php echo $result['Repair_C']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>TRANSPORT 20'-PT</td>
                    <td>
                        <input type="text" name="transport20PT" value="<?php echo $result['transport20PT']; ?>">
                    </td>
                    <td>
                        <input type="text" name="transport20PT_C" value="<?php echo $result['transport20PT_C']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>TRANSPORT 40'-PT</td>
                    <td>
                        <input type="text" name="transport40PT" value="<?php echo $result['transport40PT']; ?>">
                    </td>
                    <td>
                        <input type="text" name="transport40PT_C" value="<?php echo $result['transport40PT_C']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>PORT CHARGES</td>
                    <td>
                        <input type="text" name="portCharges" value="<?php echo $result['portCharges']; ?>">
                    </td>
                    <td>
                        <input type="text" name="portCharges_C" value="<?php echo $result['portCharges_C']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>PORT CHARGE-PT</td>
                    <td>
                        <input type="text" name="portChargePT" value="<?php echo $result['portChargePT']; ?>">
                    </td>
                    <td>
                        <input type="text" name="portChargePT_C" value="<?php echo $result['portChargePT_C']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>TERMINAL HANDLING CHARGE</td>
                    <td>
                        <input type="text" name="terminalHandingCharge" value="<?php echo $result['terminalHandingCharge']; ?>">
                    </td>
                    <td>
                        <input type="text" name="terminalHandingCharge_C" value="<?php echo $result['terminalHandingCharge_C']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>TRANSPORTATION</td>
                    <td>
                        <input type="text" name="tranSportation" value="<?php echo $result['tranSportation']; ?>">
                    </td>
                    <td>
                        <input type="text" name="tranSportation_C" value="<?php echo $result['tranSportation_C']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>SERVICE+AC:AH CHARGE</td>
                    <td>
                        <input type="text" name="serviceACAH" value="<?php echo $result['serviceACAH']; ?>">
                    </td>
                    <td>
                        <input type="text" name="serviceACAH_C" value="<?php echo $result['serviceACAH_C']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>STORAGE CHARGE</td>
                    <td>
                        <input type="text" name="storageCharge" value="<?php echo $result['storageCharge']; ?>">
                    </td>
                    <td>
                        <input type="text" name="storageCharge_C" value="<?php echo $result['storageCharge_C']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>WARE HOUSE CHARGES</td>
                    <td>
                        <input type="text" name="wareHouseCharges" value="<?php echo $result['wareHouseCharges']; ?>">
                    </td>
                    <td>
                        <input type="text" name="wareHouseCharges_C" value="<?php echo $result['wareHouseCharges_C']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>HANDLING CHARGES</td>
                    <td>
                        <input type="text" name="handlingCharges" value="<?php echo $result['handlingCharges']; ?>">
                    </td>
                    <td>
                        <input type="text" name="handlingCharges_C" value="<?php echo $result['handlingCharges_C']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>WHARF HANDLING IMPORT </td>
                    <td>
                        <input type="text" name="wharfHandlingImport" value="<?php echo $result['wharfHandlingImport']; ?>">
                    </td>
                    <td>
                        <input type="text" name="wharfHandlingImport_C" value="<?php echo $result['wharfHandlingImport_C']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>ค่าธรรมเนียมรับรองเอกสาร</td>
                    <td>
                        <input type="text" name="documentCertificationFee" value="<?php echo $result['documentCertificationFee']; ?>">
                    </td>
                    <td>
                        <input type="text" name="documentCertificationFee_C" value="<?php echo $result['documentCertificationFee_C']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>ค่าแก้ไขใบขน</td>
                    <td>
                        <input type="text" name="improtCustomsEntryReviceFee" value="<?php echo $result['improtCustomsEntryReviceFee']; ?>">
                    </td>
                    <td>
                        <input type="text" name="improtCustomsEntryReviceFee_C" value="<?php echo $result['improtCustomsEntryReviceFee_C']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>ค่าลงทะเบียนใหม่</td>
                    <td>
                        <input type="text" name="newRegistrationFee" value="<?php echo $result['newRegistrationFee']; ?>">
                    </td>
                    <td>
                        <input type="text" name="newRegistrationFee_C" value="<?php echo $result['newRegistrationFee_C']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>ใบขนต่อเนื่อง</td>
                    <td>
                        <input type="text" name="improtCustomsEntryContinuouslyFee" value="<?php echo $result['improtCustomsEntryContinuouslyFee']; ?>">
                    </td>
                    <td>
                        <input type="text" name="improtCustomsEntryContinuouslyFee_C" value="<?php echo $result['improtCustomsEntryContinuouslyFee_C']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>ค่าล่วงเวลา</td>
                    <td>
                        <input type="text" name="overtimeFee" value="<?php echo $result['overtimeFee']; ?>">
                    </td>
                    <td>
                        <input type="text" name="overtimeFee_C" value="<?php echo $result['overtimeFee_C']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>ค่าดรอป</td>
                    <td>
                        <input type="text" name="containerDropFee" value="<?php echo $result['containerDropFee']; ?>">
                    </td>
                    <td>
                        <input type="text" name="containerDropFee_C" value="<?php echo $result['containerDropFee_C']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>ค่าชอร์ตู้หนัก</td>
                    <td>
                        <input type="text" name="containerChroFee" value="<?php echo $result['containerChroFee']; ?>">
                    </td>
                    <td>
                        <input type="text" name="containerChroFee_C" value="<?php echo $result['containerChroFee_C']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>ค่าขนส่งทยอยตู้ดรอป</td>
                    <td>
                        <input type="text" name="containerDepositGraduallyFee" value="<?php echo $result['containerDepositGraduallyFee']; ?>">
                    </td>
                    <td>
                        <input type="text" name="containerDepositGraduallyFee_C" value="<?php echo $result['containerDepositGraduallyFee_C']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>ค่าฝากตู้</td>
                    <td>
                        <input type="text" name="containerDepositFee" value="<?php echo $result['containerDepositFee']; ?>">
                    </td>
                    <td>
                        <input type="text" name="containerDepositFee_C" value="<?php echo $result['containerDepositFee_C']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>ค่าฝากตู้ (เกิน FREE TIME)</td>
                    <td>
                        <input type="text" name="containerDepositOvertimeFee" value="<?php echo $result['containerDepositOvertimeFee']; ?>">
                    </td>
                    <td>
                        <input type="text" name="containerDepositOvertimeFee_C" value="<?php echo $result['containerDepositOvertimeFee_C']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>ค่ารับตู้ล่วงหน้า</td>
                    <td>
                        <input type="text" name="containerReceiveAdvanceFee" value="<?php echo $result['containerReceiveAdvanceFee']; ?>">
                    </td>
                    <td>
                        <input type="text" name="containerReceiveAdvanceFee_C" value="<?php echo $result['containerReceiveAdvanceFee_C']; ?>">
                    </td>
                </tr>

                <td>ค่ายกเลิกใบขน</td>
                <td>
                    <input type="text" name="improtCustomsEntryCancelFee" value="<?php echo $result['improtCustomsEntryCancelFee']; ?>">
                </td>
                <td>
                    <input type="text" name="improtCustomsEntryCancelFee_C" value="<?php echo $result['improtCustomsEntryCancelFee_C']; ?>">
                </td>
                </tr>
                <tr>
                    <td>ค่าซ่อมตู้</td>
                    <td>
                        <input type="text" name="containerRepairFee" value="<?php echo $result['containerRepairFee']; ?>">
                    </td>
                    <td>
                        <input type="text" name="containerRepairFee_C" value="<?php echo $result['containerRepairFee_C']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>ค่าเสียเวลา</td>
                    <td>
                        <input type="text" name="loseTimeFee" value="<?php echo $result['loseTimeFee']; ?>">
                    </td>
                    <td>
                        <input type="text" name="loseTimeFee_C" value="<?php echo $result['loseTimeFee_C']; ?>">
                    </td>
                </tr>

                <td>ค่าฟิก</td>
                <td>
                    <input type="text" name="containerFixFee" value="<?php echo $result['containerFixFee']; ?>">
                </td>
                <td>
                    <input type="text" name="containerFixFee_C" value="<?php echo $result['containerFixFee_C']; ?>">
                </td>
                </tr>
                <tr>
                    <td>อื่น ๆ&nbsp;
                        <input type="text" name="other_so" value="<?php echo $result['other_so']; ?>"> <br><br>
                    </td>
                    <td>
                        <input type="text" name="other_so_p" value="<?php echo $result['other_so_p']; ?>"><br><br>
                    </td>
                    <td>
                        <input type="text" name="other_so_p_C" value="<?php echo $result['other_so_p_C']; ?>"><br><br>
                    </td>


                </tr>
                <td>TOTAL VAT 7 %</td>
                <td>
                    <input type="text" name="vat7" value="<?php echo $result['vat7']; ?>">
                </td>
                <td>
                    <input type="text" name="vat7_C" value="<?php echo $result['vat7_C']; ?>">
                </td>
                </tr>
                <td>AMOUNT</td>
                <td>
                    <input type="text" name="total_so" value="<?php echo $result['total_so']; ?>">
                </td>
                <td>
                    <input type="text" name="total_so_C" value="<?php echo $result['total_so_C']; ?>">
                </td>
                </tr>


                <tr></tr>
                <tr>
                <td>AMOUNT NET</td>
                <td colspan="2">
                    <input type="text" name="total_so_amn" value="<?php echo $result['total_so_amn']; ?>">
                </td>

                </tr>
                <tr>
                <td>File PDF</td>
                <td><label>
                        <input type="file" name="FilesName" id="FilesName" required="required" />
                    </label></td>
            </tr>
                <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="button" id="Savebtn" value="SAVE" class="btn btn-dark"></td>
            </tr>
            </table>
        </form>
    </center>
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

    <script type="text/javascript">
$(document).ready(function () {
    $('#Savebtn').click(function() {
      checked = $("input[type=radio]:checked").length;

      if(!checked) {
        alert("You must check at least one consignee.");
        return false;
      }

    });
});

</script>

</body>

</html>