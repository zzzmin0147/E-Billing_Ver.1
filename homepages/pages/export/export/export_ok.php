<?php
session_start();

if (@$_SESSION['userlevel'] == "acc") {

  $userId = $_GET['useridSo'];

  $Date = date("Ymd");
  $frompage = "EXPORT" . "_" . $userId . "_" . $Date;
  $strExcelFileName = $frompage . ".xls";
  header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
  header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
  header("Pragma:no-cache");

  require_once '../connection/connect.php';

  $d_s = $_GET['d_s'];
  $d_e = $_GET['d_e'];
  $company = $_GET['conSigNee'];

?>

  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Export</title>

  </head>

  <body>

    <table align="center" width="100%" border="1" cellspacing="1" cellpadding="1">
      <tr>
        <td align="center">SEA </td>
        <td align="center">CONSIGNEE</td>
        <td align="center">วันที่บันทึกเอกสาร</td>
        <td align="center">INVOICE </td>
        <td align="center">INVOICE DATE</td>
        <td align="center">INVOICE CUSTOMER</td>

        <td align="center">B/L NO.</td>
        <td align="center">IMPORT ENTRY NO.</td>
        <td align="center">EXPORT ENTRY NO.</td>
        <td align="center">CONTAINER 20'
        </td>
        <td align="center">CONTAINER 40'
        </td>
        <td align="center">CUSTOMS FEE
        </td>
        <td align="center">DUT&TAX
        </td>
        <td align="center">DELIVERY ORDER FEES
        </td>
        </td>
        <td align="center">TERMINAL HANDLING CHARGE
        </td>
        <td align="center">ADVANCE LIFT ON/LIFT OFF 20-40'
        </td>
        <td align="center">DETENTION CHARGES
        </td>
        <td align="center">DEMURRAGE CHARGE
        </td>
        <td align="center">REPAIR
        </td>
        <td align="center">STORAGE CHARGE
        </td>
        <td align="center">PORT CHARGE
        </td>
        <td align="center">CUSTOMS OVER TIME
        </td>
        <td align="center">ADVANCE OTHER DESCRIPTION
        </td>
        <td align="center">ADVANCE PRICE
        </td>
        <td align="center">CUSTOMS CLEARANCE
        </td>
        <td align="center">NEXT ENTRY
        </td>
        <td align="center">TRANSPORTATION
        </td>
        <td align="center">CONTAINER DROP
        </td>
        <td align="center">GATE FEE
        </td>
        <td align="center">CHARGE LIFT ON/LIFT OFF 20-40'
        </td>
        <td align="center">TRANSPORT OVER TIME
        </td>
        
        <!-- NEW LIST -->
        <td align="center">OCEAN FREIGHT
        </td>
        <td align="center">AIR FREIGHT
        </td>
        <td align="center">CARRIER DELIVERY ORDER
        </td>
        <td align="center">THC PORT OF DISCHARGE
        </td>
        <td align="center">CONTAINER CLEANING FEE
        </td>
        <td align="center">EQUIPMENT CONTAINER FEE
        </td>
        <td align="center">IMPORT HANDLING FEE
        </td>
        <td align="center">EX-WORK COST
        </td>
        <td align="center">INSURANCE
        </td>
        <!-- NEW LIST -->


        <td align="center">CHARGE OTHER DESCRIPTION
        </td>
        <td align="center">CHARGE PRICE
        </td>
        <td align="center">GROSS AMT
        </td>
        <td align="center">VAT AMT
        </td>
        <td align="center">TOTAL AMT
        </td>
        <td align="center">W/T 1%
        </td>
        <td align="center">W/T 1% (SERVICE)
        </td>
        <td align="center">W/T 3%
        </td>
        <td align="center">NET AMT
        </td>
        <td align="center">STATUS
        </td>
        <td align="center">COMMENT BOI
        </td>
        <td align="center">COMMENT MD
        </td>
        <td align="center">PAYMENT DATE
        </td>
        <td align="center">DATE TMP
        </td>
      </tr>

      <?php
      $sql = "SELECT * FROM dbo.sonicdb
                    where seaSo = 'EXPORT'
                    AND useridSo = '$userId'
                    AND conSigNee = '$company'
                    AND dateInSo BETWEEN '$d_s' 
                    AND '$d_e'
                    ORDER BY dateInSo ASC ";
      $query = $conn->prepare($sql);
      $query->execute();
      while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
      ?>
        <tr>
          <td align="center"><?php echo $result['seaSo']; ?></td>
          <td align="center"><?php echo $result['conSigNee']; ?></td>

          <td><?php

              $dateInSo = $result["dateInSo"];
              $orgDateinso = $dateInSo;
              $dateinsonew = str_replace('/', '-', $orgDateinso);
              $newDateinso = date("d/m/Y", strtotime($dateinsonew));
              echo $newDateinso;
              ?></td>

          <td align="center"><?php echo $result['invSo']; ?></td>

          <td><?php
              $dateSo = $result["dateSo"];
              $orgDatein = $dateSo;
              $datein = str_replace('/', '-', $orgDatein);
              $newDatein = date("d/m/Y", strtotime($datein));
              echo $newDatein;
              ?></td>
          <td align="center"><?php echo $result['invSncCusSo']; ?></td>
          <td align="center"><?php echo $result['blNo']; ?></td>

          <td align="center"><?php echo $result['importEntryNo']; ?></td>
          <td align="center"><?php echo $result['exportEntryNo']; ?></td>

          <td align="center"><?php echo $result['conTainer20']; ?></td>
          <td align="center"><?php echo $result['conTainer40']; ?></td>
          <td align="center"><?php echo number_format($result['cusTomFee'], 2); ?></td>
          <td align="center"><?php echo number_format($result['dutTax'], 2); ?></td>
          <td align="center"><?php echo number_format($result['deliveryOderFee'], 2); ?></td>
          <td align="center"><?php echo number_format($result['terminalHandlingCharge'], 2); ?></td>
          <td align="center"><?php echo number_format($result['advanceLiftOnLiftOff2040'], 2); ?></td>
          <td align="center"><?php echo number_format($result['detentionCharges'], 2); ?></td>
          <td align="center"><?php echo number_format($result['demurRageCharge'], 2); ?></td>
          <td align="center"><?php echo number_format($result['rePair'], 2); ?></td>
          <td align="center"><?php echo number_format($result['storageCharge'], 2); ?></td>
          <td align="center"><?php echo number_format($result['portCharge'], 2); ?></td>
          <td align="center"><?php echo number_format($result['customsOvertime'], 2); ?></td>
          <td align="center"><?php echo $result['advanceOtherDescription']; ?></td>
          <td align="center"><?php echo number_format($result['advanePrice'], 2); ?></td>
          <td align="center"><?php echo number_format($result['customsClearance'], 2); ?></td>
          <td align="center"><?php echo number_format($result['nextEntry'], 2); ?></td>
          <td align="center"><?php echo number_format($result['tranSportation'], 2); ?></td>
          <td align="center"><?php echo number_format($result['containerDrop'], 2); ?></td>
          <td align="center"><?php echo number_format($result['gateFee'], 2); ?></td>
          <td align="center"><?php echo number_format($result['chargeLiftOnLiftOff2040'], 2); ?></td>
          <td align="center"><?php echo number_format($result['transportOvertime'], 2); ?></td>
          

          <td align="center"><?php echo number_format($result['oCeanFreight'], 2); ?></td>
          <td align="center"><?php echo number_format($result['airFreight'], 2); ?></td>
          <td align="center"><?php echo number_format($result['carrierDeliveryOrder'], 2); ?></td>
          <td align="center"><?php echo number_format($result['thcPortOfDischarge'], 2); ?></td>
          <td align="center"><?php echo number_format($result['equipMentContainerFee'], 2); ?></td>
          <td align="center"><?php echo number_format($result['conTainerCleaningFee'], 2); ?></td>
          <td align="center"><?php echo number_format($result['importHandingFee'], 2); ?></td>
          <td align="center"><?php echo number_format($result['inSuRance'], 2); ?></td>
          <td align="center"><?php echo number_format($result['exWorkCost'], 2); ?></td>

          <td align="center"><?php echo $result['chargeOtherDescription']; ?></td>
          <td align="center"><?php echo number_format($result['chargePrice'], 2); ?></td>
          <td align="center"><?php echo number_format($result['grossAmt'], 2); ?></td>
          <td align="center"><?php echo number_format($result['vatAmt'], 2); ?></td>
          <td align="center"><?php echo number_format($result['totalAmt'], 2); ?></td>
          <td align="center"><?php echo number_format($result['wt1'], 2); ?></td>
          <td align="center"><?php echo number_format($result['wt1_s'], 2); ?></td>
          <td align="center"><?php echo number_format($result['wt3'], 2); ?></td>
          <td align="center"><?php echo number_format($result['netAmt'], 2); ?></td>
          <td align="center"><?php echo $result['stShow']; ?></td>
          <td align="center"><?php echo $result['stComment']; ?></td>
          <td align="center"><?php echo $result['md_comment']; ?></td>
          <td align="center"><?php echo $result['stAppPayment']; ?></td>
          <td align="center"><?php echo $result['tmpSO']; ?></td>
        </tr>
      <?php
      };
      ?>




    </table>
  </body>

  </html>



<?php

} elseif ((@$_SESSION['userlevel'] == "scm")
  || (@$_SESSION['userlevel'] == "boi")
  || (@$_SESSION['userlevel'] == "boimng")
) {

  $userId = $_GET['useridSo'];

  $Date = date("Ymd");
  $frompage = "EXPORT" . "_" . $userId . "_" . $Date;
  $strExcelFileName = $frompage . ".xls";
  header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
  header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
  header("Pragma:no-cache");

  require_once '../connection/connect.php';

  $d_s = $_GET['d_s'];
  $d_e = $_GET['d_e'];
  $department = $_GET['department'];

?>

  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Export</title>

  </head>

  <body>

    <table align="center" width="100%" border="1" cellspacing="1" cellpadding="1">
      <tr>
        <td align="center">SEA </td>
        <td align="center">CONSIGNEE</td>
        <td align="center">วันที่บันทึกเอกสาร</td>
        <td align="center">INVOICE </td>
        <td align="center">INVOICE DATE</td>
        <td align="center">INVOICE CUSTOMER</td>

        <td align="center">B/L NO.</td>
        <td align="center">IMPORT ENTRY NO.</td>
        <td align="center">EXPORT ENTRY NO.</td>
        <td align="center">CONTAINER 20'
        </td>
        <td align="center">CONTAINER 40'
        </td>
        <td align="center">CUSTOMS FEE
        </td>
        <td align="center">DUT&TAX
        </td>
        <td align="center">DELIVERY ORDER FEES
        </td>
        </td>
        <td align="center">TERMINAL HANDLING CHARGE
        </td>
        <td align="center">ADVANCE LIFT ON/LIFT OFF 20-40'
        </td>
        <td align="center">DETENTION CHARGES
        </td>
        <td align="center">DEMURRAGE CHARGE
        </td>
        <td align="center">REPAIR
        </td>
        <td align="center">STORAGE CHARGE
        </td>
        <td align="center">PORT CHARGE
        </td>
        <td align="center">CUSTOMS OVER TIME
        </td>
        <td align="center">ADVANCE OTHER DESCRIPTION
        </td>
        <td align="center">ADVANCE PRICE
        </td>
        <td align="center">CUSTOMS CLEARANCE
        </td>
        <td align="center">NEXT ENTRY
        </td>
        <td align="center">TRANSPORTATION
        </td>
        <td align="center">CONTAINER DROP
        </td>
        <td align="center">GATE FEE
        </td>
        <td align="center">CHARGE LIFT ON/LIFT OFF 20-40'
        </td>
        <td align="center">TRANSPORT OVER TIME
        </td>
        
        <!-- NEW LIST -->
        <td align="center">OCEAN FREIGHT
        </td>
        <td align="center">AIR FREIGHT
        </td>
        <td align="center">CARRIER DELIVERY ORDER
        </td>
        <td align="center">THC PORT OF DISCHARGE
        </td>
        <td align="center">CONTAINER CLEANING FEE
        </td>
        <td align="center">EQUIPMENT CONTAINER FEE
        </td>
        <td align="center">IMPORT HANDLING FEE
        </td>
        <td align="center">EX-WORK COST
        </td>
        <td align="center">INSURANCE
        </td>
        <!-- NEW LIST -->
        <td align="center">CHARGE OTHER DESCRIPTION
        </td>
        <td align="center">CHARGE PRICE
        </td>
        <td align="center">GROSS AMT
        </td>
        <td align="center">VAT AMT
        </td>
        <td align="center">TOTAL AMT
        </td>
        <td align="center">W/T 1%
        </td>
        <td align="center">W/T 1% (SERVICE)
        </td>
        <td align="center">W/T 3%
        </td>
        <td align="center">NET AMT
        </td>
        <td align="center">STATUS
        </td>
        <td align="center">COMMENT BOI
        </td>
        <td align="center">COMMENT MD
        </td>
        <td align="center">PAYMENT DATE
        </td>
        <td align="center">DATE TMP
        </td>
      </tr>

      <?php
      $sql = "SELECT * FROM dbo.sonicdb
                    where seaSo = 'EXPORT'
                    AND useridSo = '$userId'
                    AND dePartMent = '$department'
                    AND dateInSo BETWEEN '$d_s' 
                    AND '$d_e'
                    ORDER BY dateInSo ASC ";
      $query = $conn->prepare($sql);
      $query->execute();
      while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
      ?>
        <tr>
          <td align="center"><?php echo $result['seaSo']; ?></td>
          <td align="center"><?php echo $result['conSigNee']; ?></td>

          <td><?php

              $dateInSo = $result["dateInSo"];
              $orgDateinso = $dateInSo;
              $dateinsonew = str_replace('/', '-', $orgDateinso);
              $newDateinso = date("d/m/Y", strtotime($dateinsonew));
              echo $newDateinso;
              ?></td>

          <td align="center"><?php echo $result['invSo']; ?></td>

          <td><?php
              $dateSo = $result["dateSo"];
              $orgDatein = $dateSo;
              $datein = str_replace('/', '-', $orgDatein);
              $newDatein = date("d/m/Y", strtotime($datein));
              echo $newDatein;
              ?></td>
          <td align="center"><?php echo $result['invSncCusSo']; ?></td>
          <td align="center"><?php echo $result['blNo']; ?></td>

          <td align="center"><?php echo $result['importEntryNo']; ?></td>
          <td align="center"><?php echo $result['exportEntryNo']; ?></td>

          <td align="center"><?php echo $result['conTainer20']; ?></td>
          <td align="center"><?php echo $result['conTainer40']; ?></td>
          <td align="center"><?php echo number_format($result['cusTomFee'], 2); ?></td>
          <td align="center"><?php echo number_format($result['dutTax'], 2); ?></td>
          <td align="center"><?php echo number_format($result['deliveryOderFee'], 2); ?></td>
          <td align="center"><?php echo number_format($result['terminalHandlingCharge'], 2); ?></td>
          <td align="center"><?php echo number_format($result['advanceLiftOnLiftOff2040'], 2); ?></td>
          <td align="center"><?php echo number_format($result['detentionCharges'], 2); ?></td>
          <td align="center"><?php echo number_format($result['demurRageCharge'], 2); ?></td>
          <td align="center"><?php echo number_format($result['rePair'], 2); ?></td>
          <td align="center"><?php echo number_format($result['storageCharge'], 2); ?></td>
          <td align="center"><?php echo number_format($result['portCharge'], 2); ?></td>
          <td align="center"><?php echo number_format($result['customsOvertime'], 2); ?></td>
          <td align="center"><?php echo $result['advanceOtherDescription']; ?></td>
          <td align="center"><?php echo number_format($result['advanePrice'], 2); ?></td>
          <td align="center"><?php echo number_format($result['customsClearance'], 2); ?></td>
          <td align="center"><?php echo number_format($result['nextEntry'], 2); ?></td>
          <td align="center"><?php echo number_format($result['tranSportation'], 2); ?></td>
          <td align="center"><?php echo number_format($result['containerDrop'], 2); ?></td>
          <td align="center"><?php echo number_format($result['gateFee'], 2); ?></td>
          <td align="center"><?php echo number_format($result['chargeLiftOnLiftOff2040'], 2); ?></td>
          <td align="center"><?php echo number_format($result['transportOvertime'], 2); ?></td>
          

          <td align="center"><?php echo number_format($result['oCeanFreight'], 2); ?></td>
          <td align="center"><?php echo number_format($result['airFreight'], 2); ?></td>
          <td align="center"><?php echo number_format($result['carrierDeliveryOrder'], 2); ?></td>
          <td align="center"><?php echo number_format($result['thcPortOfDischarge'], 2); ?></td>
          <td align="center"><?php echo number_format($result['equipMentContainerFee'], 2); ?></td>
          <td align="center"><?php echo number_format($result['conTainerCleaningFee'], 2); ?></td>
          <td align="center"><?php echo number_format($result['importHandingFee'], 2); ?></td>
          <td align="center"><?php echo number_format($result['inSuRance'], 2); ?></td>
          <td align="center"><?php echo number_format($result['exWorkCost'], 2); ?></td>

          <td align="center"><?php echo $result['chargeOtherDescription']; ?></td>
          <td align="center"><?php echo number_format($result['chargePrice'], 2); ?></td>
          <td align="center"><?php echo number_format($result['grossAmt'], 2); ?></td>
          <td align="center"><?php echo number_format($result['vatAmt'], 2); ?></td>
          <td align="center"><?php echo number_format($result['totalAmt'], 2); ?></td>
          <td align="center"><?php echo number_format($result['wt1'], 2); ?></td>
          <td align="center"><?php echo number_format($result['wt1_s'], 2); ?></td>
          <td align="center"><?php echo number_format($result['wt3'], 2); ?></td>
          <td align="center"><?php echo number_format($result['netAmt'], 2); ?></td>
          <td align="center"><?php echo $result['stShow']; ?></td>
          <td align="center"><?php echo $result['stComment']; ?></td>
          <td align="center"><?php echo $result['md_comment']; ?></td>
          <td align="center"><?php echo $result['stAppPayment']; ?></td>
          <td align="center"><?php echo $result['tmpSO']; ?></td>
        </tr>
      <?php
      };
      ?>
    </table>
  </body>

  </html>
<?php



} else {




  $userId = $_GET['useridSo'];

  $Date = date("Ymd");
  $frompage = "EXPORT" . "_" . $userId . "_" . $Date;
  $strExcelFileName = $frompage . ".xls";
  header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
  header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
  header("Pragma:no-cache");
?>

  <?php

  require_once '../connection/connect.php';

  $d_s = $_GET['d_s'];
  $d_e = $_GET['d_e'];
  ?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Export</title>

  </head>

  <body>

    <table align="center" width="100%" border="1" cellspacing="1" cellpadding="1">
      <tr>
        <td align="center">SEA </td>
        <td align="center">CONSIGNEE</td>
        <td align="center">วันที่บันทึกเอกสาร</td>
        <td align="center">INVOICE </td>
        <td align="center">INVOICE DATE</td>
        <td align="center">INVOICE CUSTOMER</td>

        <td align="center">B/L NO.</td>
        <td align="center">IMPORT ENTRY NO.</td>
        <td align="center">EXPORT ENTRY NO.</td>
        <td align="center">CONTAINER 20'
        </td>
        <td align="center">CONTAINER 40'
        </td>
        <td align="center">CUSTOMS FEE
        </td>
        <td align="center">DUT&TAX
        </td>
        <td align="center">DELIVERY ORDER FEES
        </td>
        </td>
        <td align="center">TERMINAL HANDLING CHARGE
        </td>
        <td align="center">ADVANCE LIFT ON/LIFT OFF 20-40'
        </td>
        <td align="center">DETENTION CHARGES
        </td>
        <td align="center">DEMURRAGE CHARGE
        </td>
        <td align="center">REPAIR
        </td>
        <td align="center">STORAGE CHARGE
        </td>
        <td align="center">PORT CHARGE
        </td>
        <td align="center">CUSTOMS OVER TIME
        </td>
        <td align="center">ADVANCE OTHER DESCRIPTION
        </td>
        <td align="center">ADVANCE PRICE
        </td>
        <td align="center">CUSTOMS CLEARANCE
        </td>
        <td align="center">NEXT ENTRY
        </td>
        <td align="center">TRANSPORTATION
        </td>
        <td align="center">CONTAINER DROP
        </td>
        <td align="center">GATE FEE
        </td>
        <td align="center">CHARGE LIFT ON/LIFT OFF 20-40'
        </td>
        <td align="center">TRANSPORT OVER TIME
        </td>
        
        <!-- NEW LIST -->
        <td align="center">OCEAN FREIGHT
        </td>
        <td align="center">AIR FREIGHT
        </td>
        <td align="center">CARRIER DELIVERY ORDER
        </td>
        <td align="center">THC PORT OF DISCHARGE
        </td>
        <td align="center">CONTAINER CLEANING FEE
        </td>
        <td align="center">EQUIPMENT CONTAINER FEE
        </td>
        <td align="center">IMPORT HANDLING FEE
        </td>
        <td align="center">EX-WORK COST
        </td>
        <td align="center">INSURANCE
        </td>
        <!-- NEW LIST -->
        <td align="center">CHARGE OTHER DESCRIPTION
        </td>
        <td align="center">CHARGE PRICE
        </td>
        <td align="center">GROSS AMT
        </td>
        <td align="center">VAT AMT
        </td>
        <td align="center">TOTAL AMT
        </td>
        <td align="center">W/T 1%
        </td>
        <td align="center">W/T 1% (SERVICE)
        </td>
        <td align="center">W/T 3%
        </td>
        <td align="center">NET AMT
        </td>
        <td align="center">STATUS
        </td>
        <td align="center">COMMENT BOI
        </td>
        <td align="center">COMMENT MD
        </td>
        <td align="center">PAYMENT DATE
        </td>
        <td align="center">DATE TMP
        </td>
      </tr>

      <?php
      $sql = "SELECT * FROM dbo.sonicdb
                    where seaSo = 'EXPORT'
                    AND useridSo = '$userId'
                    AND dateInSo BETWEEN '$d_s' 
                    AND '$d_e'
                    ORDER BY dateInSo ASC ";
      $query = $conn->prepare($sql);
      $query->execute();
      while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
      ?>
        <tr>
          <td align="center"><?php echo $result['seaSo']; ?></td>
          <td align="center"><?php echo $result['conSigNee']; ?></td>

          <td><?php

              $dateInSo = $result["dateInSo"];
              $orgDateinso = $dateInSo;
              $dateinsonew = str_replace('/', '-', $orgDateinso);
              $newDateinso = date("d/m/Y", strtotime($dateinsonew));
              echo $newDateinso;
              ?></td>

          <td align="center"><?php echo $result['invSo']; ?></td>

          <td><?php
              $dateSo = $result["dateSo"];
              $orgDatein = $dateSo;
              $datein = str_replace('/', '-', $orgDatein);
              $newDatein = date("d/m/Y", strtotime($datein));
              echo $newDatein;
              ?></td>
          <td align="center"><?php echo $result['invSncCusSo']; ?></td>
          <td align="center"><?php echo $result['blNo']; ?></td>

          <td align="center"><?php echo $result['importEntryNo']; ?></td>
          <td align="center"><?php echo $result['exportEntryNo']; ?></td>

          <td align="center"><?php echo $result['conTainer20']; ?></td>
          <td align="center"><?php echo $result['conTainer40']; ?></td>
          <td align="center"><?php echo number_format($result['cusTomFee'], 2); ?></td>
          <td align="center"><?php echo number_format($result['dutTax'], 2); ?></td>
          <td align="center"><?php echo number_format($result['deliveryOderFee'], 2); ?></td>
          <td align="center"><?php echo number_format($result['terminalHandlingCharge'], 2); ?></td>
          <td align="center"><?php echo number_format($result['advanceLiftOnLiftOff2040'], 2); ?></td>
          <td align="center"><?php echo number_format($result['detentionCharges'], 2); ?></td>
          <td align="center"><?php echo number_format($result['demurRageCharge'], 2); ?></td>
          <td align="center"><?php echo number_format($result['rePair'], 2); ?></td>
          <td align="center"><?php echo number_format($result['storageCharge'], 2); ?></td>
          <td align="center"><?php echo number_format($result['portCharge'], 2); ?></td>
          <td align="center"><?php echo number_format($result['customsOvertime'], 2); ?></td>
          <td align="center"><?php echo $result['advanceOtherDescription']; ?></td>
          <td align="center"><?php echo number_format($result['advanePrice'], 2); ?></td>
          <td align="center"><?php echo number_format($result['customsClearance'], 2); ?></td>
          <td align="center"><?php echo number_format($result['nextEntry'], 2); ?></td>
          <td align="center"><?php echo number_format($result['tranSportation'], 2); ?></td>
          <td align="center"><?php echo number_format($result['containerDrop'], 2); ?></td>
          <td align="center"><?php echo number_format($result['gateFee'], 2); ?></td>
          <td align="center"><?php echo number_format($result['chargeLiftOnLiftOff2040'], 2); ?></td>
          <td align="center"><?php echo number_format($result['transportOvertime'], 2); ?></td>
          

          <td align="center"><?php echo number_format($result['oCeanFreight'], 2); ?></td>
          <td align="center"><?php echo number_format($result['airFreight'], 2); ?></td>
          <td align="center"><?php echo number_format($result['carrierDeliveryOrder'], 2); ?></td>
          <td align="center"><?php echo number_format($result['thcPortOfDischarge'], 2); ?></td>
          <td align="center"><?php echo number_format($result['equipMentContainerFee'], 2); ?></td>
          <td align="center"><?php echo number_format($result['conTainerCleaningFee'], 2); ?></td>
          <td align="center"><?php echo number_format($result['importHandingFee'], 2); ?></td>
          <td align="center"><?php echo number_format($result['inSuRance'], 2); ?></td>
          <td align="center"><?php echo number_format($result['exWorkCost'], 2); ?></td>

          <td align="center"><?php echo $result['chargeOtherDescription']; ?></td>
          <td align="center"><?php echo number_format($result['chargePrice'], 2); ?></td>
          <td align="center"><?php echo number_format($result['grossAmt'], 2); ?></td>
          <td align="center"><?php echo number_format($result['vatAmt'], 2); ?></td>
          <td align="center"><?php echo number_format($result['totalAmt'], 2); ?></td>
          <td align="center"><?php echo number_format($result['wt1'], 2); ?></td>
          <td align="center"><?php echo number_format($result['wt1_s'], 2); ?></td>
          <td align="center"><?php echo number_format($result['wt3'], 2); ?></td>
          <td align="center"><?php echo number_format($result['netAmt'], 2); ?></td>
          <td align="center"><?php echo $result['stShow']; ?></td>
          <td align="center"><?php echo $result['stComment']; ?></td>
          <td align="center"><?php echo $result['md_comment']; ?></td>
          <td align="center"><?php echo $result['stAppPayment']; ?></td>
          <td align="center"><?php echo $result['tmpSO']; ?></td>
        </tr>
      <?php
      };
      ?>




    </table>
  </body>

  </html>
<?php } ?>