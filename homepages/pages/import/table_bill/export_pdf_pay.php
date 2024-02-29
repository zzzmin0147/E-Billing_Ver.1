<?php
$pay_id = $_REQUEST['pay_id'];
require_once '../connection/connect.php';
$sqlpay = "SELECT * FROM [SNC_Webapp].[dbo].[pay_db] where pay_id = '$pay_id' ";
$querypay = $conn->prepare($sqlpay);
$querypay->execute();
$resultpay = $querypay->fetch(PDO::FETCH_ASSOC);

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

                    <p>สรุปค่าใช้จ่ายในการนำเข้า-ส่งออก <?php echo $resultpay['pay_vendor'];; ?> งวดวันที่ : <?php echo $resultpay['pay_date']; ?></p>
                    <div class="card">
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
                                        <th style="text-align:center">ค่าบริการ (หัก 3%)</th>
                                        <th style="text-align:center">ค่าขนส่ง (หัก 1%)</th>
                                        <th style="text-align:center">ยอดจ่ายสุทธิ</th>
                                        <th style="text-align:center">Approved by</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sqlinv = "SELECT pay_bill_id
                                                    FROM [SNC_Webapp].[dbo].[pay_db_detail]
                                                    WHERE pay_inv = ('$pay_id')";
                                    $queryinv = $conn->prepare($sqlinv);
                                    $queryinv->execute();
                                    $numplus = 1;
                                    $sum = 0;
                                    while ($resultinv = $queryinv->fetch(PDO::FETCH_ASSOC)) {

                                        $inv = array($resultinv["pay_bill_id"]);
                                        foreach ($inv as $row) {

                                            $sql = "SELECT * 
                                                            FROM dbo.sonicdb
                                                            WHERE invSo IN ('$row')";
                                            $query = $conn->prepare($sql);
                                            $query->execute();
                                            $result = $query->fetch(PDO::FETCH_ASSOC);

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


                                    <?php

                                            $sqlsum = "SELECT SUM(totalAmt)[total]
                                                         ,SUM(wt3)[wt3]
                                                         ,SUM(wt1)[wt1] 
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
                                        WHERE invSo IN ('$row')";
                                            $querysum = $conn->prepare($sqlsum);
                                            $querysum->execute();
                                            $resultsum = $querysum->fetch(PDO::FETCH_ASSOC);

                                            @$charge += $resultsum["charge"];
                                            @$tran += $resultsum["tran"];
                                            @$vat += $resultsum["vat"];
                                            @$advance += $resultsum["advance"];
                                            @$total += $resultsum["total"];
                                            @$wt3 += $resultsum["wt3"];
                                            @$wt1 += $resultsum["wt1"];
                                            @$net += $resultsum["net"];
                                        }
                                    };

                                    ?>
                                    <tr style="background-color:#87CEFA">
                                        <td colspan="3" style="text-align:center">TOTAL</td>
                                        <td><?php echo  number_format($charge, 2); ?></td>
                                        <td><?php echo  number_format($tran, 2); ?></td>
                                        <td><?php echo  number_format($vat, 2); ?></td>
                                        <td><?php echo  number_format($advance, 2); ?></td>
                                        <td><?php echo  number_format($total, 2); ?></td>
                                        <td><?php echo  number_format($wt3, 2); ?></td>
                                        <td><?php echo  number_format($wt1, 2); ?></td>
                                        <td><?php echo  number_format($net, 2); ?></td>
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
</body>

</html>