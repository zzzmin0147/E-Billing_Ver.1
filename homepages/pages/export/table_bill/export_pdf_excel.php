<?php
$userId = $_GET['useridSo'];
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
                                            <th style="text-align:center">ค่าบริการ (หัก 3%)</th>
                                            <th style="text-align:center">ค่าบริการ (หัก 1%)</th>
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
                                                         +tranSportation
                                                         +containerDrop
                                                         +gateFee
                                                         +chargeLiftOnLiftOff2040
                                                         +transportOvertime
                                                         +portCharge
                                                         +chargePrice
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
                                                         +customsOvertime
                                                         +advanePrice
                                                         )[advance] 

                                                         ,SUM(customsClearance
                                                         +nextEntry
                                                         +tranSportation
                                                         +containerDrop
                                                         +gateFee
                                                         +chargeLiftOnLiftOff2040
                                                         +transportOvertime
                                                         +portCharge
                                                         +chargePrice
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
                                            <td><?php echo  number_format($resultsum["wt3"], 2); ?></td>
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
<?php
} else {

    $Date = date("Ymd");
    $frompage = "IMPORT"."_".$userId. "_" . $Date;
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
                <th>ค่าบริการ (หัก 3%)</th>
                <th>ค่าบริการ (หัก 1%)</th>
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
                                                         +tranSportation
                                                         +containerDrop
                                                         +gateFee
                                                         +chargeLiftOnLiftOff2040
                                                         +transportOvertime
                                                         +portCharge
                                                         +chargePrice
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
                                                         +customsOvertime
                                                         +advanePrice
                                                         )[advance] 

                                                         ,SUM(customsClearance
                                                         +nextEntry
                                                         +tranSportation
                                                         +containerDrop
                                                         +gateFee
                                                         +chargeLiftOnLiftOff2040
                                                         +transportOvertime
                                                         +portCharge
                                                         +chargePrice
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
                    <td><?php echo  number_format($resultsum["wt3"], 2); ?></td>
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