<?php
session_start();

require_once '../connection/connect.php';

use SimpleExcel\SimpleExcel;


if (isset($_POST['import'])) {

    if ($_FILES['excel_file']['name'] != "IMBook2.csv") {

        echo "<script>";
        echo "alert('ชื่อไฟล์ไม่ใช่ IMBook1');";
        echo "window.history.back() ";
        echo "</script>";
    }


    if (move_uploaded_file($_FILES['excel_file']['tmp_name'], "" . $_FILES['excel_file']['name'])) {
        require_once('SimpleExcel/SimpleExcel.php');

        $excel = new SimpleExcel('csv');

        $excel->parser->loadFile($_FILES['excel_file']['name']);

        $foo = $excel->parser->getField();


        /*
        echo "<pre>";
        print_r($foo);
        echo "</pre>";
        $count = 1;
        while (count($foo) > $count) {
            $inv_so_c = $foo[$count][2];
            $count++;
            echo "<pre>";
            print_r($inv_so_c);
            echo "</pre>";
        }
}} 
*/
        $count = 1;
        while (count($foo) > $count) {
            $invSo = "'" . $foo[$count][1] . "'";
            $check = " SELECT  COUNT(invSo) 
        FROM dbo.sonicdb  
        WHERE invSo IN ($invSo)
        ";
            $query = $conn->prepare($check);
            $query->execute();
            $result = $query->fetchColumn();
            $count++;
        }

        if ($result > 0) {
            echo "<script>";
            echo "alert('มี INVOICE ซ้ำ!!');";
            echo "window.history.back() ";
            echo "</script>";
        }
        elseif ($invSo== null) {
            echo "<script>";
            echo "alert('ข้อมูล INVOICE ไม่มี!!');";
            echo "window.history.back() ";
            echo "</script>";
        }

        elseif ($result == 0) {
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
                $customsOvertime = $foo[$count_s][18];
                $advanceOtherDescription = $foo[$count_s][19];
                $advanePrice = $foo[$count_s][20];
                $customsClearance = $foo[$count_s][21];
                $nextEntry = $foo[$count_s][22];
                $tranSportation = $foo[$count_s][23];
                $containerDrop = $foo[$count_s][24];
                $gateFee = $foo[$count_s][25];
                $chargeLiftOnLiftOff2040 = $foo[$count_s][26];
                $transportOvertime = $foo[$count_s][27];
                $portCharge = $foo[$count_s][28];
                $chargeOtherDescription = $foo[$count_s][29];
                $chargePrice = $foo[$count_s][30];
                $grossAmt = $foo[$count_s][31];
                $vatAmt = $foo[$count_s][32];
                $totalAmt = $foo[$count_s][33];
                $wt1 = $foo[$count_s][34];
                $wt3 = $foo[$count_s][35];
                $netAmt = $foo[$count_s][36];


                
                $tmpSO = date("d-m-Y h:i:s a");

                $userId = $_SESSION["username"];
           

                $sql = "INSERT INTO dbo.sonicdb 
            (seaSo
            ,conSigNee
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
            ,chargeOtherDescription
            ,chargePrice
            ,grossAmt
            ,vatAmt
            ,totalAmt
            ,wt1
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
             'IMPORT'
            ,'$conSigNee'
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
            ,'$chargeOtherDescription'
            ,'$chargePrice'
            ,'$grossAmt'
            ,'$vatAmt'
            ,'$totalAmt'
            ,'$wt1'
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
?>
