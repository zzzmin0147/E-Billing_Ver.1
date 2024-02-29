<?php
session_start();
@$company = $_SESSION['company'];
@$userId = $_REQUEST['useridSo'];
@$datePay = date("d/m/Y", strtotime(str_replace('/', '-', $_REQUEST['datePay'])));
@$vendorName = $_REQUEST['vendorName'];
if (isset($_POST['import1']) == 1) {
    // Require composer autoload
    require_once __DIR__ . '/vendor/autoload.php';

    $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
    $fontData = $defaultFontConfig['fontdata'];
    $mpdf = new \Mpdf\Mpdf([
        'format' => 'A4',
        'tempDir' => __DIR__ . '/tmp',
        'fontdata' => $fontData + [
            'sarabun' => [
                'R' => 'THSarabunNew.ttf',
                'I' => 'THSarabunNewItalic.ttf',
                'B' =>  'THSarabunNewBold.ttf',
                'BI' => "THSarabunNewBoldItalic.ttf",

            ]
        ],
    ]);

    ob_start(); // Start get HTML code
?>

    <?php
    require_once '../connection/connect.php';


    date_default_timezone_set("Asia/Bangkok");
    $tmpSO = date("d/m/Y");
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Export PDF</title>
        <link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../../../plugins/fontawesome-free/css/all.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="../../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="../../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <!-- Theme style -->
        <style>
            body {
                font-family: sarabun;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }


            td,
            th {
                border: 0.5px solid black;
                text-align: right;
                padding: 5px;
            }
        </style>
    </head>

    <body>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <p>สรุปค่าใช้จ่ายในการนำเข้า-ส่งออก <?php echo $vendorName; ?> งวดวันที่ : <?php echo $datePay; ?></p>
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr style="background-color:#87CEFA">
                                            <th style="text-align:center">No.</th>
                                            <th style="text-align:center">Date</th>
                                            <th style="text-align:center">INVOICE No.</th>
                                            <th style="text-align:center">ค่าบริการ</th>
                                            <th style="text-align:center">ค่าขนส่ง</th>
                                            <th style="text-align:center">Vat</th>
                                            <th style="text-align:center">สำรองจ่ายให้ SNC</th>
                                            <th style="text-align:center">Amount</th>
                                            <th style="text-align:center"><?php

                                                                            $sql_wt = "SELECT min(b.dateSo) as bill_date
                                                                            FROM [SNC_Webapp].[dbo].[pay_db_detail] p_d
                                                                            LEFT JOIN [SNC_Webapp].[dbo].[sonicdb] b
                                                                            ON p_d.pay_bill_id = b.invSo COLLATE Thai_CI_AS 
                                                                            WHERE p_d.pay_inv = ('$pay_id')";
                                                                            $query_wt = $conn->prepare($sql_wt);
                                                                            $query_wt->execute();
                                                                            $result_wt = $query_wt->fetch(PDO::FETCH_ASSOC);
                                                                            $bill_date = $result_wt['bill_date'];
                                                                            if ($bill_date > '2024-02-01') {
                                                                                echo "ค่าบริการ (หัก 1%)";
                                                                            } else {
                                                                                echo "ค่าบริการ (หัก 3%)";
                                                                            }

                                                                            ?>

                                            </th>
                                            <th style="text-align:center">ค่าขนส่ง (หัก 1%)</th>
                                            <th style="text-align:center">ยอดจ่ายสุทธิ</th>
                                            <th style="text-align:center">Approved by</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $selected_string = implode(",", $_POST['checkbox']);
                                        $sql = "SELECT * 
                                        FROM dbo.sonicdb
                                        WHERE invSo IN ($selected_string)";
                                        $query = $conn->prepare($sql);
                                        $query->execute();
                                        $numplus = 1;
                                        while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $numplus++; ?> </td>
                                                <td><?php

                                                    $dateSo = $result["dateSo"];
                                                    $orgDatein = $dateSo;
                                                    $datein = str_replace('/', '-', $orgDatein);
                                                    $newDatein = date("d/m/Y", strtotime($datein));
                                                    echo $newDatein;
                                                    ?></td>
                                                <td><?php echo $result["invSo"]; ?></td>

                                                <td><?php
                                                    $rowsumpc = "'" . $result["invSo"] . "'";
                                                    $sqlsumpc = "SELECT 
                                                         SUM(customsClearance
                                                         +nextEntry
                                                         +containerDrop
                                                         +gateFee
                                                         +chargeLiftOnLiftOff2040
                                                         +transportOvertime
                                                         +chargePrice
                                                         +oCeanFreight
                                                         +airFreight
                                                         +carrierDeliveryOrder
                                                         +thcPortOfDischarge
                                                         +equipMentContainerFee
                                                         +conTainerCleaningFee
                                                         +importHandingFee
                                                         +inSuRance
                                                         +exWorkCost
                                                         )[charge_p] 

                                        FROM dbo.sonicdb
                                        WHERE invSo IN ($rowsumpc)";
                                                    $querysumpc = $conn->prepare($sqlsumpc);
                                                    $querysumpc->execute();
                                                    $resultsumpc = $querysumpc->fetch(PDO::FETCH_ASSOC);
                                                    echo number_format($resultsumpc['charge_p'], 2);
                                                    ?></td>


                                                <td><?php echo number_format($result["tranSportation"], 2); ?></td>

                                                <td><?php echo number_format($result["vatAmt"], 2); ?></td>

                                                <td><?php
                                                    $rowsumpa = "'" . $result["invSo"] . "'";
                                                    $sqlsumpa = "SELECT 
                                                         SUM(cusTomFee
                                                         +dutTax
                                                         +deliveryOderFee
                                                         +terminalHandlingCharge
                                                         +advanceLiftOnLiftOff2040
                                                         +detentionCharges
                                                         +demurRageCharge
                                                         +rePair
                                                         +storageCharge
                                                         +portCharge
                                                         +customsOvertime
                                                         +advanePrice
                                                         )[advance_P] 
                                        FROM dbo.sonicdb
                                        WHERE invSo IN ($rowsumpa)";
                                                    $querysumpa = $conn->prepare($sqlsumpa);
                                                    $querysumpa->execute();
                                                    $resultsumpa = $querysumpa->fetch(PDO::FETCH_ASSOC);

                                                    echo number_format($resultsumpa['advance_P'], 2);
                                                    ?></td>

                                                <td><?php echo number_format($result["totalAmt"], 2); ?></td>
                                                <td><?php echo number_format($result["wt3"], 2); ?></td>
                                                <td><?php echo number_format($result["wt1"], 2); ?></td>
                                                <td><?php echo number_format($result["netAmt"], 2); ?></td>
                                                <td><?php echo $result["stSoApp"]; ?></td>
                                            </tr>
                                        <?php }; ?>

                                        <?php
                                        $selected_stringsum = implode(",", $_POST['checkbox']);
                                        $sqlsum = "SELECT SUM(totalAmt)[total]
                                                         ,SUM(wt3)[wt3]
                                                         ,SUM(wt1)[wt1] 
                                                         ,SUM(wt1_s)[wt1_s] 
                                                         ,SUM(netAmt)[net] 
                                                         ,SUM(vatAmt)[vat] 
                                                         ,SUM(tranSportation)[tran] 


                                                         ,SUM(cusTomFee
                                                         +dutTax
                                                         +deliveryOderFee
                                                         +terminalHandlingCharge
                                                         +advanceLiftOnLiftOff2040
                                                         +detentionCharges
                                                         +demurRageCharge
                                                         +rePair
                                                         +storageCharge
                                                         +portCharge
                                                         +customsOvertime
                                                         +advanePrice
                                                         )[advance] 

                                                         ,SUM(customsClearance
                                                         +nextEntry
                                                         +containerDrop
                                                         +gateFee
                                                         +chargeLiftOnLiftOff2040
                                                         +transportOvertime
                                                         +chargePrice
                                                         +oCeanFreight
                                                         +airFreight
                                                         +carrierDeliveryOrder
                                                         +thcPortOfDischarge
                                                         +equipMentContainerFee
                                                         +conTainerCleaningFee
                                                         +importHandingFee
                                                         +inSuRance
                                                         +exWorkCost
                                                         )[charge] 

                                        FROM dbo.sonicdb
                                        WHERE invSo IN ($selected_stringsum)";
                                        $querysum = $conn->prepare($sqlsum);
                                        $querysum->execute();
                                        $resultsum = $querysum->fetch(PDO::FETCH_ASSOC); ?>
                                        <tr style="background-color:#87CEFA">
                                            <td colspan="3" style="text-align:center">TOTAL</td>
                                            <td><?php echo  number_format($resultsum["charge"], 2); ?></td>
                                            <td><?php echo  number_format($resultsum["tran"], 2); ?></td>
                                            <td><?php echo  number_format($resultsum["vat"], 2); ?></td>
                                            <td><?php echo  number_format($resultsum["advance"], 2); ?></td>
                                            <td><?php echo  number_format($resultsum["total"], 2); ?></td>
                                            <td><?php
                                                if ($bill_date > '2024-02-01') {
                                                    echo  number_format($resultsum['wt1_s'], 2);
                                                } else {
                                                    echo  number_format($resultsum['wt3'], 2);
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo  number_format($resultsum["wt1"], 2); ?></td>
                                            <td><?php echo  number_format($resultsum["net"], 2); ?></td>
                                            <td></td>
                                        </tr>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>


        <!-- jQuery -->
        <script src="../../../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="../../../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="../../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="../../../plugins/jszip/jszip.min.js"></script>
        <script src="../../../plugins/pdfmake/pdfmake.min.js"></script>
        <script src="../../../plugins/pdfmake/vfs_fonts.js"></script>
        <script src="../../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="../../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="../../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../../../dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <!-- Page specific script -->
        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });
        </script>
    </body>

    </html>

    <?php
    $html = ob_get_contents();
    $mpdf->WriteHTML($html);
    $mpdf->Output("MyPDF.pdf");
    ob_end_flush();
    ?>
    ดาวโหลดรายงานในรูปแบบ PDF <a href="MyPDF.pdf">คลิกที่นี้</a>



    <form action="?checkbox_app=<?php echo $selected_string; ?>&datePay=<?= $datePay ?>&vendername=<?= $vendorName ?>" method="post">
        <button type="submit" class="btn btn-sm btn-primary" name="success" value="1">ยืนยันสั่งจ่าย</i></button>
    </form>

<?php } elseif (isset($_REQUEST['success']) == 1) {

    require_once '../connection/connect.php';
    $tmpSO = date("d/m/Y  h:i:s a");
    $selected_string = $_REQUEST['checkbox_app'];
    $datePay = $_REQUEST['datePay'];
    $vendername = $_REQUEST['vendername'];
    $sql = " UPDATE dbo.sonicdb SET

    		stSO = 7,
    		stShow = 'Approve payment',
    		stAppPayment = '$datePay',
    		tmpSO = '$tmpSO'
    		WHERE invSo IN ($selected_string)";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $sql4    = "INSERT INTO [SNC_Webapp].[dbo].[pay_db]
	(pay_date,pay_vendor,pay_company) values ('$datePay','$vendername','$company')";
    $stmt4 = $conn->prepare($sql4);
    $stmt4->execute();




    $sql2 = "SELECT max(pay_id) as pay_id from [SNC_Webapp].[dbo].[pay_db] ";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute();
    $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    $pay_id = $result2["pay_id"];

    $sql3 = "SELECT invSo FROM dbo.sonicdb WHERE invSo in ($selected_string)";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->execute();

    while ($result3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
        $inv = array($result3["invSo"]);
        foreach ($inv as $row) {
            $sql5    = "INSERT INTO [SNC_Webapp].[dbo].[pay_db_detail]
            (pay_inv
            ,pay_bill_id
            ) 
            values 
            ('$pay_id'
            ,'$row')";
            $stmt5 = $conn->prepare($sql5);
            $stmt5->execute();
        };
    };


    if ($stmt) {
        echo "<script type='text/javascript'>";
        echo "alert('Approve');";
        echo "window.history.back()";
        echo "</script>";
    } else {

        echo "<script type='text/javascript'>";
        echo "alert('error!');";
        echo "window.history.back()";
        echo "</script>";
    }
} else {

    $Date = date("Ymd");
    $frompage = $userId . "_" . $Date;
    $strExcelFileName = $frompage . ".xls";
    header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
    header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
    header("Pragma:no-cache");

    require_once '../connection/connect.php';
    date_default_timezone_set("Asia/Bangkok");
    $tmpSO = date("d/m/Y");

?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Export</title>
    </head>

    <body>
        <p>สรุปค่าใช้จ่ายในการนำเข้า-ส่งออก <?php echo $vendorName; ?> งวดวันที่ : <?php echo $datePay; ?></p>
        <table align="center" width="100%" border="1" cellspacing="1" cellpadding="1">
            <tr>
                <th>No.</th>
                <th>Date</th>
                <th>INVOICE No.</th>
                <th>ค่าบริการ</th>
                <th>ค่าขนส่ง</th>
                <th>Vat</th>
                <th>สำรองจ่ายให้ SNC</th>
                <th>Amount</th>
                <th><?php

                    $sql_wt = "SELECT min(b.dateSo) as bill_date
    FROM [SNC_Webapp].[dbo].[pay_db_detail] p_d
    LEFT JOIN [SNC_Webapp].[dbo].[sonicdb] b
    ON p_d.pay_bill_id = b.invSo COLLATE Thai_CI_AS 
    WHERE p_d.pay_inv = ('$pay_id')";
                    $query_wt = $conn->prepare($sql_wt);
                    $query_wt->execute();
                    $result_wt = $query_wt->fetch(PDO::FETCH_ASSOC);
                    $bill_date = $result_wt['bill_date'];
                    if ($bill_date > '2024-02-01') {
                        echo "ค่าบริการ (หัก 1%)";
                    } else {
                        echo "ค่าบริการ (หัก 3%)";
                    }

                    ?>

                </th>
                <th>ค่าขนส่ง (หัก 1%)</th>
                <th>ยอดจ่ายสุทธิ</th>
                <th>Approved by</th>

            </tr>

            <?php
            $selected_string = implode(",", $_POST['checkbox']);
            $sql = "SELECT *
        FROM dbo.sonicdb
        WHERE invSo IN ($selected_string)";
            $query = $conn->prepare($sql);
            $query->execute();
            $num = 1;



            while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
            ?>

                <tr>
                    <td><?php echo $num++; ?> </td>
                    <td><?php

                        $dateSo = $result["dateSo"];
                        $orgDatein = $dateSo;
                        $datein = str_replace('/', '-', $orgDatein);
                        $newDatein = date("d/m/Y", strtotime($datein));
                        echo $newDatein;
                        ?></td>
                    <td><?php echo $result["invSo"]; ?></td>
                    <td><?php
                        $rowsumpc = "'" . $result["invSo"] . "'";
                        $sqlsumpc = "SELECT 
                                                         SUM(customsClearance
                                                         +nextEntry
                                                         +containerDrop
                                                         +gateFee
                                                         +chargeLiftOnLiftOff2040
                                                         +transportOvertime
                                                         +chargePrice
                                                         +oCeanFreight
                                                         +airFreight
                                                         +carrierDeliveryOrder
                                                         +thcPortOfDischarge
                                                         +equipMentContainerFee
                                                         +conTainerCleaningFee
                                                         +importHandingFee
                                                         +inSuRance
                                                         +exWorkCost
                                                         )[charge_p] 

                                        FROM dbo.sonicdb
                                        WHERE invSo IN ($rowsumpc)";
                        $querysumpc = $conn->prepare($sqlsumpc);
                        $querysumpc->execute();
                        $resultsumpc = $querysumpc->fetch(PDO::FETCH_ASSOC);

                        echo number_format($resultsumpc['charge_p'], 2);
                        ?></td>

                    <td><?php echo number_format($result["tranSportation"], 2); ?></td>

                    <td><?php echo number_format($result["vatAmt"], 2); ?></td>

                    <td><?php
                        $rowsumpa = "'" . $result["invSo"] . "'";
                        $sqlsumpa = "SELECT 
                                                         SUM(cusTomFee
                                                         +dutTax
                                                         +deliveryOderFee
                                                         +terminalHandlingCharge
                                                         +advanceLiftOnLiftOff2040
                                                         +detentionCharges
                                                         +demurRageCharge
                                                         +rePair
                                                         +storageCharge
                                                         +portCharge
                                                         +customsOvertime
                                                         +advanePrice
                                                         )[advance_P] 
                                        FROM dbo.sonicdb
                                        WHERE invSo IN ($rowsumpa)";
                        $querysumpa = $conn->prepare($sqlsumpa);
                        $querysumpa->execute();
                        $resultsumpa = $querysumpa->fetch(PDO::FETCH_ASSOC);

                        echo number_format($resultsumpa['advance_P'], 2);
                        ?></td>

                    <td><?php echo number_format($result["totalAmt"], 2); ?></td>
                    <td><?php echo number_format($result["wt3"], 2); ?></td>
                    <td><?php echo number_format($result["wt1"], 2); ?></td>
                    <td><?php echo number_format($result["netAmt"], 2); ?></td>
                    <td><?php echo $result["stSoApp"]; ?></td>
                <?php
            };
                ?>
                </tr>
                <?php
                $selected_stringsum = implode(",", $_POST['checkbox']);
                $sqlsum = "SELECT SUM(totalAmt)[total]
                                                         ,SUM(wt3)[wt3]
                                                         ,SUM(wt1)[wt1] 
                                                         ,SUM(wt1_s)[wt1_s] 
                                                         ,SUM(netAmt)[net] 
                                                         ,SUM(vatAmt)[vat] 
                                                         ,SUM(tranSportation)[tran] 


                                                         ,SUM(cusTomFee
                                                         +dutTax
                                                         +deliveryOderFee
                                                         +terminalHandlingCharge
                                                         +advanceLiftOnLiftOff2040
                                                         +detentionCharges
                                                         +demurRageCharge
                                                         +rePair
                                                         +storageCharge
                                                         +portCharge
                                                         +customsOvertime
                                                         +advanePrice
                                                         )[advance] 

                                                         ,SUM(customsClearance
                                                         +nextEntry
                                                         +containerDrop
                                                         +gateFee
                                                         +chargeLiftOnLiftOff2040
                                                         +transportOvertime
                                                         +chargePrice
                                                         +oCeanFreight
                                                         +airFreight
                                                         +carrierDeliveryOrder
                                                         +thcPortOfDischarge
                                                         +equipMentContainerFee
                                                         +conTainerCleaningFee
                                                         +importHandingFee
                                                         +inSuRance
                                                         +exWorkCost
                                                         )[charge] 
                                        FROM dbo.sonicdb
                                        WHERE invSo IN ($selected_stringsum)";
                $querysum = $conn->prepare($sqlsum);
                $querysum->execute();
                $resultsum = $querysum->fetch(PDO::FETCH_ASSOC); ?>
                <tr>
                    <td colspan="3">TOTAL</td>
                    <td><?php echo  number_format($resultsum["charge"], 2); ?></td>
                    <td><?php echo  number_format($resultsum["tran"], 2); ?></td>
                    <td><?php echo  number_format($resultsum["vat"], 2); ?></td>
                    <td><?php echo  number_format($resultsum["advance"], 2); ?></td>
                    <td><?php echo  number_format($resultsum["total"], 2); ?></td>
                    <td><?php
                        if ($bill_date > '2024-02-01') {
                            echo  number_format($resultsum['wt1_s'], 2);
                        } else {
                            echo  number_format($resultsum['wt3'], 2);
                        }
                        ?>
                    </td>
                    <td><?php echo  number_format($resultsum["wt1"], 2); ?></td>
                    <td><?php echo  number_format($resultsum["net"], 2); ?></td>
                    <td></td>
                </tr>
        </table>
    </body>

    </html>

<?php
}

?>