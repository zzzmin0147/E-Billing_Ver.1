<?php
require_once '../connection/connect.php';

$inv_so = $_POST['inv_so'];
date_default_timezone_set("Asia/Bangkok");
$datetime = date("d-m-y h:i:s a");

$sql = "SELECT * FROM dbo.sonicdb WHERE inv_so ='$inv_so'";
$query = $conn->prepare($sql);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);

@unlink("../file_sonic/".$result['FilesName']);

$date_so_in = $_POST['date_so_in'];
$date_so = $_POST['date_so'];
$inv_snc_so = $_POST['inv_snc_so'];
///////////////////////////////////////////
$advanceFee = $_POST['advanceFee'];
$advanceLiftOnOff = $_POST['advanceLiftOnOff'];
$customsClearanceCharge = $_POST['customsClearanceCharge'];
$customsClearance = $_POST['customsClearance'];
$customsFee = $_POST['customsFee'];
$dutN_auyTax = $_POST['dutN_auyTax'];
$detenTionCharges = $_POST['detenTionCharges'];
$THC = $_POST['THC'];
$deliveryOrderFees = $_POST['deliveryOrderFees'];
$demur_Q125 = $_POST['demur_Q125'];
$equipmentCharge = $_POST['equipmentCharge'];
$extraMoveCharge = $_POST['extraMoveCharge'];
$exterContaunerCharge = $_POST['exterContaunerCharge'];
$liftOnOff20 = $_POST['liftOnOff20'];
$liftOnOff40 = $_POST['liftOnOff40'];
$liftOnOff = $_POST['liftOnOff'];
$gateFee = $_POST['gateFee'];
$overTime = $_POST['overTime'];
$cleaningChanges = $_POST['cleaningChanges'];
$Repair = $_POST['Repair'];
$transport20PT = $_POST['transport20PT'];
$transport40PT = $_POST['transport40PT'];
$portCharges = $_POST['portCharges'];
$portChargePT = $_POST['portChargePT'];
$terminalHandingCharge = $_POST['terminalHandingCharge'];
$tranSportation = $_POST['tranSportation'];
$serviceACAH = $_POST['serviceACAH'];
$storageCharge = $_POST['storageCharge'];
$wareHouseCharges = $_POST['wareHouseCharges'];
$handlingCharges = $_POST['handlingCharges'];
$wharfHandlingImport = $_POST['wharfHandlingImport'];
$documentCertificationFee = $_POST['documentCertificationFee'];
$improtCustomsEntryReviceFee = $_POST['improtCustomsEntryReviceFee'];
$newRegistrationFee = $_POST['newRegistrationFee'];
$improtCustomsEntryContinuouslyFee = $_POST['improtCustomsEntryContinuouslyFee'];
$overtimeFee = $_POST['overtimeFee'];
$containerDropFee = $_POST['containerDropFee'];
$containerChroFee = $_POST['containerChroFee'];
$containerDepositGraduallyFee = $_POST['containerDepositGraduallyFee'];
$containerDepositFee = $_POST['containerDepositFee'];
$containerDepositOvertimeFee = $_POST['containerDepositOvertimeFee'];
$containerReceiveAdvanceFee = $_POST['containerReceiveAdvanceFee'];
$improtCustomsEntryCancelFee = $_POST['improtCustomsEntryCancelFee'];
$containerRepairFee = $_POST['containerRepairFee'];
$loseTimeFee = $_POST['loseTimeFee'];
$containerFixFee = $_POST['containerFixFee'];

$other_so = $_POST['other_so'];
$other_so_p = $_POST['other_so_p'];
///////////////////////////////////////////////////////////////////
$advanceFee_C = $_POST['advanceFee_C'];
$advanceLiftOnOff_C = $_POST['advanceLiftOnOff_C'];
$customsClearanceCharge_C = $_POST['customsClearanceCharge_C'];
$customsClearance_C = $_POST['customsClearance_C'];
$customsFee_C = $_POST['customsFee_C'];
$dutN_auyTax_C = $_POST['dutN_auyTax_C'];
$detenTionCharges_C = $_POST['detenTionCharges_C'];
$THC_C = $_POST['THC_C'];
$deliveryOrderFees_C = $_POST['deliveryOrderFees_C'];
$demur_Q125_C = $_POST['demur_Q125_C'];
$equipmentCharge_C = $_POST['equipmentCharge_C'];
$extraMoveCharge_C = $_POST['extraMoveCharge_C'];
$exterContaunerCharge_C = $_POST['exterContaunerCharge_C'];
$liftOnOff20_C = $_POST['liftOnOff20_C'];
$liftOnOff40_C = $_POST['liftOnOff40_C'];
$liftOnOff_C = $_POST['liftOnOff_C'];
$gateFee_C = $_POST['gateFee_C'];
$overTime_C = $_POST['overTime_C'];
$cleaningChanges_C = $_POST['cleaningChanges_C'];
$Repair_C = $_POST['Repair_C'];
$transport20PT_C = $_POST['transport20PT_C'];
$transport40PT_C = $_POST['transport40PT_C'];
$portCharges_C = $_POST['portCharges_C'];
$portChargePT_C = $_POST['portChargePT_C'];
$terminalHandingCharge_C = $_POST['terminalHandingCharge_C'];
$tranSportation_C = $_POST['tranSportation_C'];
$serviceACAH_C = $_POST['serviceACAH_C'];
$storageCharge_C = $_POST['storageCharge_C'];
$wareHouseCharges_C = $_POST['wareHouseCharges_C'];
$handlingCharges_C = $_POST['handlingCharges_C'];
$wharfHandlingImport_C = $_POST['wharfHandlingImport_C'];
$documentCertificationFee_C = $_POST['documentCertificationFee_C'];
$improtCustomsEntryReviceFee_C = $_POST['improtCustomsEntryReviceFee_C'];
$newRegistrationFee_C = $_POST['newRegistrationFee_C'];
$improtCustomsEntryContinuouslyFee_C = $_POST['improtCustomsEntryContinuouslyFee_C'];
$overtimeFee_C = $_POST['overtimeFee_C'];
$containerDropFee_C = $_POST['containerDropFee_C'];
$containerChroFee_C = $_POST['containerChroFee_C'];
$containerDepositGraduallyFee_C = $_POST['containerDepositGraduallyFee_C'];
$containerDepositFee_C = $_POST['containerDepositFee_C'];
$containerDepositOvertimeFee_C = $_POST['containerDepositOvertimeFee_C'];
$containerReceiveAdvanceFee_C = $_POST['containerReceiveAdvanceFee_C'];
$improtCustomsEntryCancelFee_C = $_POST['improtCustomsEntryCancelFee_C'];
$containerRepairFee_C = $_POST['containerRepairFee_C'];
$loseTimeFee_C = $_POST['loseTimeFee_C'];
$containerFixFee_C = $_POST['containerFixFee_C'];

$other_so_p_C = $_POST['other_so_p_C'];
////////////////////////////////////////////////////////////////////
$total_so = $_POST['total_so'];
$vat7 = $_POST['vat7'];
$total_so_C = $_POST['total_so_C'];
$vat7_C = $_POST['vat7_C'];

$total_so_amn = $_POST['total_so_amn'];
$conSigNee = $_POST['conSigNee'];


$path1 = "../file_sonic/";
$target_file = $path1 . basename($_FILES["FilesName"]["name"]);
$FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if ($FileType != "pdf") {
    echo "<script type='text/javascript'>";
    echo "alert(' ประเภทไฟล์ไม่ใช่ PDF');";
    echo "window.history.back() ";
    echo "</script>";
}
if($_FILES["FilesName"]["size"] >= 3545728) {

	echo "<script type='text/javascript'>";
	echo "alert(' ขนาดไฟล์มากกว่า 3MB');";
	echo "window.history.back() ";
	echo "</script>";
}

else {
    $path = "../file_sonic/";
    $date = $date_so_in;
    $upload = $_FILES['FilesName'];


    if ($upload <> '') {


        $remove_these = array(' ', '`', '"', '\'', '\\', '/', '_');
        $newname = str_replace($remove_these, '', $_FILES['FilesName']['name']);


        $newname = "sonic" . '_' . $inv_so . '_' . $date;
        $path_copy = $path . $newname;
        $path_link = "../file_sonic/" . $newname;


        move_uploaded_file($_FILES['FilesName']['tmp_name'], $path_copy);

    }
    

$sql = " UPDATE dbo.sonicdb SET

inv_snc_so = '$inv_snc_so',
	    date_so ='$date_so',
	    inv_so ='$inv_so',
	    advanceFee ='$advanceFee',
	    advanceFee_C ='$advanceFee_C',
	    advanceLiftOnOff ='$advanceLiftOnOff',
	    advanceLiftOnOff_C ='$advanceLiftOnOff_C',
	    customsClearanceCharge ='$customsClearanceCharge',
	    customsClearanceCharge_C ='$customsClearanceCharge_C',
	    customsClearance ='$customsClearance',
	    customsClearance_C ='$customsClearance_C',
	    customsFee ='$customsFee',
	    customsFee_C ='$customsFee_C',
	    dutN_auyTax ='$dutN_auyTax',
	    dutN_auyTax_C ='$dutN_auyTax_C',
	    detenTionCharges ='$detenTionCharges',
	    detenTionCharges_C ='$detenTionCharges_C',
	    THC ='$THC',
	    THC_C ='$THC_C',
	    deliveryOrderFees ='$deliveryOrderFees',
	    deliveryOrderFees_C ='$deliveryOrderFees_C',
	    demur_Q125 ='$demur_Q125',
	    demur_Q125_C ='$demur_Q125_C',
	    equipmentCharge ='$equipmentCharge',
	    equipmentCharge_C ='$equipmentCharge_C',
	    extraMoveCharge ='$extraMoveCharge',
	    extraMoveCharge_C ='$extraMoveCharge_C',
	    exterContaunerCharge ='$exterContaunerCharge',
	    exterContaunerCharge_C ='$exterContaunerCharge_C',
	    liftOnOff20 ='$liftOnOff20',
	    liftOnOff20_C ='$liftOnOff20_C',
	    liftOnOff40 ='$liftOnOff40',
	    liftOnOff40_C ='$liftOnOff40_C',
	    liftOnOff ='$liftOnOff',
	    liftOnOff_C ='$liftOnOff_C',
	    gateFee ='$gateFee',
	    gateFee_C ='$gateFee_C',
	    overTime ='$overTime',
	    overTime_C ='$overTime_C',
	    cleaningChanges ='$cleaningChanges',
	    cleaningChanges_C ='$cleaningChanges_C',
	    Repair ='$Repair',
	    Repair_C ='$Repair_C',
	    transport20PT ='$transport20PT',
	    transport20PT_C ='$transport20PT_C',
	    transport40PT ='$transport40PT',
	    transport40PT_C ='$transport40PT_C',
	    portCharges ='$portCharges',
	    portCharges_C ='$portCharges_C',
	    portChargePT ='$portChargePT',
	    portChargePT_C ='$portChargePT_C',
	    terminalHandingCharge ='$terminalHandingCharge',
	    terminalHandingCharge_C ='$terminalHandingCharge_C',
	    tranSportation ='$tranSportation',
	    tranSportation_C ='$tranSportation_C',
	    serviceACAH ='$serviceACAH',
	    serviceACAH_C ='$serviceACAH_C',
	    storageCharge ='$storageCharge',
	    storageCharge_C ='$storageCharge_C',
	    wareHouseCharges ='$wareHouseCharges',
	    wareHouseCharges_C ='$wareHouseCharges_C',
	    handlingCharges ='$handlingCharges',
	    handlingCharges_C ='$handlingCharges_C',
	    wharfHandlingImport ='$wharfHandlingImport',
	    wharfHandlingImport_C ='$wharfHandlingImport_C',
	    documentCertificationFee ='$documentCertificationFee',
	    documentCertificationFee_C ='$documentCertificationFee_C',
	    improtCustomsEntryReviceFee ='$improtCustomsEntryReviceFee',
	    improtCustomsEntryReviceFee_C ='$improtCustomsEntryReviceFee_C',
	    newRegistrationFee ='$newRegistrationFee',
	    newRegistrationFee_C ='$newRegistrationFee_C',
	    improtCustomsEntryContinuouslyFee ='$improtCustomsEntryContinuouslyFee',
	    improtCustomsEntryContinuouslyFee_C ='$improtCustomsEntryContinuouslyFee_C',
	    overtimeFee ='$overtimeFee',
	    overtimeFee_C ='$overtimeFee_C',
	    containerDropFee ='$containerDropFee',
	    containerDropFee_C ='$containerDropFee_C',
	    containerChroFee ='$containerChroFee',
	    containerChroFee_C ='$containerChroFee_C',
	    containerDepositGraduallyFee ='$containerDepositGraduallyFee',
	    containerDepositGraduallyFee_C ='$containerDepositGraduallyFee_C',
	    containerDepositFee ='$containerDepositFee',
	    containerDepositFee_C ='$containerDepositFee_C',
	    containerDepositOvertimeFee ='$containerDepositOvertimeFee',
	    containerDepositOvertimeFee_C ='$containerDepositOvertimeFee_C',
	    containerReceiveAdvanceFee ='$containerReceiveAdvanceFee',
	    containerReceiveAdvanceFee_C ='$containerReceiveAdvanceFee_C',
	    improtCustomsEntryCancelFee ='$improtCustomsEntryCancelFee',
	    improtCustomsEntryCancelFee_C ='$improtCustomsEntryCancelFee_C',
	    containerRepairFee ='$containerRepairFee',
	    containerRepairFee_C ='$containerRepairFee_C',
	    loseTimeFee ='$loseTimeFee',
	    loseTimeFee_C ='$loseTimeFee_C',
	    containerFixFee ='$containerFixFee',
	    containerFixFee_C ='$containerFixFee_C',

	    other_so ='$other_so',
	    other_so_p ='$other_so_p',
	    other_so_p_C ='$other_so_p_C',

	    total_so ='$total_so',
	    total_so_C ='$total_so_C',
	    vat7 ='$vat7',
	    vat7_C ='$vat7_C',
	    total_so_amn ='$total_so_amn',
	    tmpSO ='$datetime',
	    conSigNee ='$conSigNee',
		
		FilesName = '$newname'

        WHERE inv_so = '$inv_so' ";

$stmt = $conn->prepare($sql);
$stmt->execute();

if ($stmt) {
	echo "<script type='text/javascript'>";
	echo "alert('แก้ไขสำเร็จ');";
    echo "window.close();";
	echo "</script>";
} else {

	echo "<script type='text/javascript'>";
	echo "alert('error!');";
	echo "window.location = 'show.php?'; ";
	echo "</script>";
}

}


?>