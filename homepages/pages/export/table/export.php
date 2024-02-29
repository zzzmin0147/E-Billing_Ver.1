<?php
session_start();

require_once '../connection/connect.php';

use SimpleExcel\SimpleExcel;

if (isset($_POST['export'])) {

    if ($_FILES['excel_file']['name'] != "EXBook4.csv") {

        echo "<script>";
        echo "alert('ชื่อไฟล์ไม่ใช่ EXBook4');";
        echo "window.history.back() ";
        echo "</script>";
    } elseif (move_uploaded_file($_FILES['excel_file']['tmp_name'], "" . $_FILES['excel_file']['name'])) {
        require_once('SimpleExcel/SimpleExcel.php');

        $excel = new SimpleExcel('csv');

        $excel->parser->loadFile($_FILES['excel_file']['name']);

        $foo = $excel->parser->getField();

        // error_reporting(0);
        // ini_set('display_errors', 0);

        $count = 1;
        $count_inv = 0;
        while (count($foo) > $count) {
            $invSo = $foo[$count][1];
            $check = " SELECT invSo
FROM dbo.sonicdb  WHERE invSo = ? ";
            $query = $conn->prepare($check);
            $query->bindParam(1, $invSo, PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            if ($result['invSo'] == $invSo) {
                $count_inv++;
                if ($invSo == null) {
                    echo "<script>";
                    echo "alert('ข้อมูล INVOICE ไม่มี!!');";
                    echo "window.history.back() ";
                    echo "</script>";
                }
            }

            $count++;
        }

        if ($count_inv > 0) {
            echo "<script>";
            echo "alert('มี INVOICE ซ้ำ!!');";
            echo "window.history.back() ";
            echo "</script>";
        } else {
            $count_s = 1;
            while (count($foo) > $count_s) {

                $dateInSo = date("Y-m-d");

                $conSigNee = $foo[$count_s][0];


                $invSo = $foo[$count_s][1];

                $dateSo = $foo[$count_s][2];
                $orgDate = $dateSo;
                $date = str_replace('/', '-', $orgDate);
                $newDate = date("Y-m-d", strtotime($date));

                $invSncCusSo = $foo[$count_s][3];
                $blNo = $foo[$count_s][4];

                $importEntryNo = $foo[$count_s][5];
                $exportEntryNo = $foo[$count_s][6];

                $conTainer20 = $foo[$count_s][7];
                $conTainer40 = $foo[$count_s][8];
                $cusTomFee = $foo[$count_s][9];
                $dutTax = $foo[$count_s][10];
                $deliveryOderFee = $foo[$count_s][11];
                $terminalHandlingCharge = $foo[$count_s][12];
                $advanceLiftOnLiftOff2040 = $foo[$count_s][13];
                $detentionCharges = $foo[$count_s][14];
                $demurRageCharge = $foo[$count_s][15];
                $rePair = $foo[$count_s][16];
                $storageCharge = $foo[$count_s][17];
                $portCharge = $foo[$count_s][18];
                $customsOvertime = $foo[$count_s][19];
                $advanceOtherDescription = iconv('', 'UTF-8', $foo[$count_s][20]);

                $advanePrice = $foo[$count_s][21];
                $customsClearance = $foo[$count_s][22];
                $nextEntry = $foo[$count_s][23];
                $tranSportation = $foo[$count_s][24];
                $containerDrop = $foo[$count_s][25];
                $gateFee = $foo[$count_s][26];
                $chargeLiftOnLiftOff2040 = $foo[$count_s][27];
                $transportOvertime = $foo[$count_s][28];


                $oCeanFreight = $foo[$count_s][29];
                $airFreight = $foo[$count_s][30];
                $carrierDeliveryOrder = $foo[$count_s][31];
                $thcPortOfDischarge = $foo[$count_s][32];
                $equipMentContainerFee = $foo[$count_s][33];
                $conTainerCleaningFee = $foo[$count_s][34];
                $importHandingFee = $foo[$count_s][35];
                $inSuRance = $foo[$count_s][36];
                $exWorkCost = $foo[$count_s][37];

                $chargeOtherDescription = iconv('', 'UTF-8', $foo[$count_s][38]);
                $chargePrice = $foo[$count_s][39];
                $grossAmt = $foo[$count_s][40];
                $vatAmt = $foo[$count_s][41];
                $totalAmt = $foo[$count_s][42];
                $wt1 = $foo[$count_s][43];
                $wt1_s = $foo[$count_s][44];
                $wt3 = $foo[$count_s][45];
                $netAmt = $foo[$count_s][46];


                $dePartMent = $_POST["dePartMent"];
                $tmpSO = date("d-m-Y h:i:s a");

                $userId = $_SESSION["username"];

                $sql = "INSERT INTO dbo.sonicdb 
           (seaSo
            ,conSigNee
            
            ,dePartMent

            ,dateInSo
            ,invSo
            ,dateSo
            ,invSncCusSo
            ,blNo
            ,conTainer20
            ,conTainer40
            ,cusTomFee
            ,dutTax
            ,deliveryOderFee
            ,terminalHandlingCharge
            ,advanceLiftOnLiftOff2040
            ,detentionCharges
            ,demurRageCharge
            ,rePair
            ,storageCharge
            ,customsOvertime
            ,advanceOtherDescription
            ,advanePrice
            ,customsClearance
            ,nextEntry
            ,tranSportation
            ,containerDrop
            ,gateFee
            ,chargeLiftOnLiftOff2040
            ,transportOvertime
            ,portCharge

            ,oCeanFreight
            ,airFreight
            ,carrierDeliveryOrder
            ,thcPortOfDischarge
            ,equipMentContainerFee
            ,conTainerCleaningFee
            ,importHandingFee
            ,inSuRance
            ,exWorkCost

            ,chargeOtherDescription
            ,chargePrice
            ,grossAmt
            ,vatAmt
            ,totalAmt
            ,wt1
            ,wt1_s
            ,wt3
            ,netAmt
            ,stSO
            ,stShow
            ,tmpSO
            ,useridSo
            ,importEntryNo
            ,exportEntryNo
             ) 
      VALUES 
            (
             'EXPORT'
             ,'$conSigNee'

            ,'$dePartMent'

            ,'$dateInSo'
            ,'$invSo'
            ,'$newDate'
            ,'$invSncCusSo'
            ,'$blNo'
            ,'$conTainer20'
            ,'$conTainer40'
            ,'$cusTomFee'
            ,'$dutTax'
            ,'$deliveryOderFee'
            ,'$terminalHandlingCharge'
            ,'$advanceLiftOnLiftOff2040'
            ,'$detentionCharges'
            ,'$demurRageCharge'
            ,'$rePair'
            ,'$storageCharge'
            ,'$customsOvertime'
            ,'$advanceOtherDescription'
            ,'$advanePrice'
            ,'$customsClearance'
            ,'$nextEntry'
            ,'$tranSportation'
            ,'$containerDrop'
            ,'$gateFee'
            ,'$chargeLiftOnLiftOff2040'
            ,'$transportOvertime'
            ,'$portCharge'

            ,'$oCeanFreight'
            ,'$airFreight'
            ,'$carrierDeliveryOrder'
            ,'$thcPortOfDischarge'
            ,'$equipMentContainerFee'
            ,'$conTainerCleaningFee'
            ,'$importHandingFee'
            ,'$inSuRance'
            ,'$exWorkCost'

            ,'$chargeOtherDescription'
            ,'$chargePrice'
            ,'$grossAmt'
            ,'$vatAmt'
            ,'$totalAmt'
            ,'$wt1'
            ,'$wt1_s'
            ,'$wt3'
            ,'$netAmt'
            ,'0'
            ,'Prepare Information'
            ,'$tmpSO'
            ,'$userId'
            ,'$importEntryNo'
            ,'$exportEntryNo'
      )";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $count_s++;
            }
        }

        if ($stmt) {

            echo "<script type='text/javascript'>";
            echo "alert('เพิ่มข้อมูลสำเร็จ');";
            echo "window.history.back() ";
            echo "</script>";
        } else {
        }
    }
}
