<?php

require_once '../connection/connect.php';

if (is_uploaded_file($_FILES['FilesName']['tmp_name'])) {
	$invSo = $_POST['invSo'];
	date_default_timezone_set("Asia/Bangkok");
	$newDatein = date("d-m-Y h:i:s a");

	$sql = "SELECT * FROM dbo.sonicdb WHERE invSo ='$invSo'";
	$query = $conn->prepare($sql);
	$query->execute();
	$result = $query->fetch(PDO::FETCH_ASSOC);

	@unlink("../file_sonic/" . $result['FilesName']);

	$userId = $result['useridSo'];

	$conSigNee = $_POST['conSigNee'];

	$dateInSo = $_POST['dateInSo'];

	$dateSo = $_POST['dateSo'];
	$invSncCusSo = $_POST['invSncCusSo'];
	$blNo = $_POST['blNo'];
	$importEntryNo = $_POST['importEntryNo'];
	$exportEntryNo = $_POST['exportEntryNo'];
	$conTainer20 = $_POST['conTainer20'];
	$conTainer40 = $_POST['conTainer40'];
	///////////////////////////////////////////
	$cusTomFee = $_POST['cusTomFee'];
	$dutTax = $_POST['dutTax'];
	$deliveryOderFee = $_POST['deliveryOderFee'];
	$terminalHandlingCharge = $_POST['terminalHandlingCharge'];
	$advanceLiftOnLiftOff2040 = $_POST['advanceLiftOnLiftOff2040'];
	$detentionCharges = $_POST['detentionCharges'];
	$demurRageCharge = $_POST['demurRageCharge'];
	$rePair = $_POST['rePair'];
	$storageCharge = $_POST['storageCharge'];
	$customsOvertime = $_POST['customsOvertime'];
	$advanceOtherDescription = $_POST['advanceOtherDescription'];
	$advanePrice = $_POST['advanePrice'];
	$customsClearance = $_POST['customsClearance'];
	$nextEntry = $_POST['nextEntry'];
	$tranSportation = $_POST['tranSportation'];
	$containerDrop = $_POST['containerDrop'];
	$gateFee = $_POST['gateFee'];
	$chargeLiftOnLiftOff2040 = $_POST['chargeLiftOnLiftOff2040'];
	$transportOvertime = $_POST['transportOvertime'];
	$portCharge = $_POST['portCharge'];
	///////////////////////////////////////////
	$oCeanFreight = $_POST['oCeanFreight'];
	$airFreight = $_POST['airFreight'];
	$carrierDeliveryOrder = $_POST['carrierDeliveryOrder'];
	$thcPortOfDischarge = $_POST['thcPortOfDischarge'];
	$equipMentContainerFee = $_POST['equipMentContainerFee'];
	$conTainerCleaningFee = $_POST['conTainerCleaningFee'];
	$importHandingFee = $_POST['importHandingFee'];
	$inSuRance = $_POST['inSuRance'];
	$exWorkCost = $_POST['exWorkCost'];
	//////////////////////////////////////////////
	$chargeOtherDescription = $_POST['chargeOtherDescription'];
	$chargePrice = $_POST['chargePrice'];
	/////////////////////////////////////////
	$grossAmt = $_POST['grossAmt'];
	$vatAmt = $_POST['vatAmt'];
	$totalAmt = $_POST['totalAmt'];
	$wt1 = $_POST['wt1'];
	$wt1_s = $_POST['wt1_s'];
	$wt3 = $_POST['wt3'];
	$netAmt = $_POST['netAmt'];

	$path1 = "../file_sonic/";
	$target_file = $path1 . basename($_FILES["FilesName"]["name"]);
	$FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


	if ($FileType != "pdf") {
		echo "<script type='text/javascript'>";
		echo "alert(' ประเภทไฟล์ไม่ใช่ PDF');";
		echo "window.history.back() ";
		echo "</script>";
	}

 else {
		$path = "../file_sonic/";
		$date = $dateInSo;

		$remove_these = array(' ', '`', '"', '\'', '\\', '/', '_');
		$newname = str_replace($remove_these, '', $_FILES['FilesName']['name']);


		$newname = $userId . '_' . $invSo . '_' . $date;
		$path_copy = $path . $newname;
		$path_link = "../file_sonic/" . $newname;


		move_uploaded_file($_FILES['FilesName']['tmp_name'], $path_copy);

		$sql = " UPDATE dbo.sonicdb SET


		  conSigNee ='$conSigNee'
		, dateInSo ='$dateInSo'
		, invSo ='$invSo'
		, dateSo ='$dateSo'
		, invSncCusSo ='$invSncCusSo'
		, blNo ='$blNo'
		, importEntryNo ='$importEntryNo'
		, exportEntryNo ='$exportEntryNo'
		, conTainer20 ='$conTainer20'
		, conTainer40 ='$conTainer40'

	    , cusTomFee ='$cusTomFee'
		, dutTax ='$dutTax'
		, deliveryOderFee ='$deliveryOderFee'
		, terminalHandlingCharge ='$terminalHandlingCharge'
		, advanceLiftOnLiftOff2040 ='$advanceLiftOnLiftOff2040'
		, detentionCharges ='$detentionCharges'
		, demurRageCharge ='$demurRageCharge'
		, rePair ='$rePair'
		, storageCharge ='$storageCharge'
		, customsOvertime ='$customsOvertime'
		, advanceOtherDescription ='$advanceOtherDescription'
		, advanePrice ='$advanePrice'

		, customsClearance ='$customsClearance'
		, nextEntry ='$nextEntry'
		, tranSportation ='$tranSportation'
		, containerDrop ='$containerDrop'
		, gateFee ='$gateFee'
		, chargeLiftOnLiftOff2040 ='$chargeLiftOnLiftOff2040'
		, transportOvertime ='$transportOvertime'
		, portCharge ='$portCharge'

		, oCeanFreight ='$oCeanFreight'
		, airFreight ='$airFreight'
		, carrierDeliveryOrder ='$carrierDeliveryOrder'
		, thcPortOfDischarge ='$thcPortOfDischarge'
		, equipMentContainerFee ='$equipMentContainerFee'
		, conTainerCleaningFee ='$conTainerCleaningFee'
		, importHandingFee ='$importHandingFee'
		, inSuRance ='$inSuRance'
		, exWorkCost ='$exWorkCost'

		, chargeOtherDescription ='$chargeOtherDescription'
		, chargePrice ='$chargePrice'

		, grossAmt ='$grossAmt'
		, vatAmt ='$vatAmt'
		, totalAmt ='$totalAmt'
		, wt1 ='$wt1'
		, wt1_s ='$wt1_s'
		, wt3 ='$wt3'
		, netAmt ='$netAmt'

		, tmpSO ='$newDatein'
		
		,FilesName = '$newname'

        WHERE invSo = '$invSo' ";

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
} else {

	$invSo = $_POST['invSo'];
	date_default_timezone_set("Asia/Bangkok");
	$newDatein = date("d-m-Y h:i:s a");
	$conSigNee = $_POST['conSigNee'];
	$dateInSo = $_POST['dateInSo'];
	$dateSo = $_POST['dateSo'];
	$invSncCusSo = $_POST['invSncCusSo'];
	$blNo = $_POST['blNo'];
	$importEntryNo = $_POST['importEntryNo'];
	$exportEntryNo = $_POST['exportEntryNo'];
	$conTainer20 = $_POST['conTainer20'];
	$conTainer40 = $_POST['conTainer40'];
	///////////////////////////////////////////
	$cusTomFee = $_POST['cusTomFee'];
	$dutTax = $_POST['dutTax'];
	$deliveryOderFee = $_POST['deliveryOderFee'];
	$terminalHandlingCharge = $_POST['terminalHandlingCharge'];
	$advanceLiftOnLiftOff2040 = $_POST['advanceLiftOnLiftOff2040'];
	$detentionCharges = $_POST['detentionCharges'];
	$demurRageCharge = $_POST['demurRageCharge'];
	$rePair = $_POST['rePair'];
	$storageCharge = $_POST['storageCharge'];
	$customsOvertime = $_POST['customsOvertime'];
	$advanceOtherDescription = $_POST['advanceOtherDescription'];
	$advanePrice = $_POST['advanePrice'];
	$customsClearance = $_POST['customsClearance'];
	$nextEntry = $_POST['nextEntry'];
	$tranSportation = $_POST['tranSportation'];
	$containerDrop = $_POST['containerDrop'];
	$gateFee = $_POST['gateFee'];
	$chargeLiftOnLiftOff2040 = $_POST['chargeLiftOnLiftOff2040'];
	$transportOvertime = $_POST['transportOvertime'];
	$portCharge = $_POST['portCharge'];
	///////////////////////////////////////////////
	$oCeanFreight = $_POST['oCeanFreight'];
	$airFreight = $_POST['airFreight'];
	$carrierDeliveryOrder = $_POST['carrierDeliveryOrder'];
	$thcPortOfDischarge = $_POST['thcPortOfDischarge'];
	$equipMentContainerFee = $_POST['equipMentContainerFee'];
	$conTainerCleaningFee = $_POST['conTainerCleaningFee'];
	$importHandingFee = $_POST['importHandingFee'];
	$inSuRance = $_POST['inSuRance'];
	$exWorkCost = $_POST['exWorkCost'];
	/////////////////////////////////////////////////
	$chargeOtherDescription = $_POST['chargeOtherDescription'];
	$chargePrice = $_POST['chargePrice'];
	/////////////////////////////////////////
	$grossAmt = $_POST['grossAmt'];
	$vatAmt = $_POST['vatAmt'];
	$totalAmt = $_POST['totalAmt'];
	$wt1 = $_POST['wt1'];
	$wt1_s = $_POST['wt1_s'];
	$wt3 = $_POST['wt3'];
	$netAmt = $_POST['netAmt'];



	$sql = " UPDATE dbo.sonicdb SET


	conSigNee ='$conSigNee'
  , dateInSo ='$dateInSo'
  , invSo ='$invSo'
  , dateSo ='$dateSo'
  , invSncCusSo ='$invSncCusSo'
  , blNo ='$blNo'
  , importEntryNo ='$importEntryNo'
  , exportEntryNo ='$exportEntryNo'
  , conTainer20 ='$conTainer20'
  , conTainer40 ='$conTainer40'

  , cusTomFee ='$cusTomFee'
  , dutTax ='$dutTax'
  , deliveryOderFee ='$deliveryOderFee'
  , terminalHandlingCharge ='$terminalHandlingCharge'
  , advanceLiftOnLiftOff2040 ='$advanceLiftOnLiftOff2040'
  , detentionCharges ='$detentionCharges'
  , demurRageCharge ='$demurRageCharge'
  , rePair ='$rePair'
  , storageCharge ='$storageCharge'
  , customsOvertime ='$customsOvertime'
  , advanceOtherDescription ='$advanceOtherDescription'
  , advanePrice ='$advanePrice'

  , customsClearance ='$customsClearance'
  , nextEntry ='$nextEntry'
  , tranSportation ='$tranSportation'
  , containerDrop ='$containerDrop'
  , gateFee ='$gateFee'
  , chargeLiftOnLiftOff2040 ='$chargeLiftOnLiftOff2040'
  , transportOvertime ='$transportOvertime'
  , portCharge ='$portCharge'

  		, oCeanFreight ='$oCeanFreight'
		, airFreight ='$airFreight'
		, carrierDeliveryOrder ='$carrierDeliveryOrder'
		, thcPortOfDischarge ='$thcPortOfDischarge'
		, equipMentContainerFee ='$equipMentContainerFee'
		, conTainerCleaningFee ='$conTainerCleaningFee'
		, importHandingFee ='$importHandingFee'
		, inSuRance ='$inSuRance'
		, exWorkCost ='$exWorkCost'

  , chargeOtherDescription ='$chargeOtherDescription'
  , chargePrice ='$chargePrice'

  , grossAmt ='$grossAmt'
  , vatAmt ='$vatAmt'
  , totalAmt ='$totalAmt'
  , wt1 ='$wt1'
  , wt1_s ='$wt1_s'
  , wt3 ='$wt3'
  , netAmt ='$netAmt'

  , tmpSO ='$newDatein'
  

  WHERE invSo = '$invSo' ";

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
