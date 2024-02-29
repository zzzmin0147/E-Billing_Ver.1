<?php
require_once '../connection/connect.php';
$selected_string = implode(",", $_POST['checkbox']);
$sql = "SELECT *
           FROM dbo.sonicdb
           WHERE invSo IN ($selected_string)";
$query = $conn->prepare($sql);
$query->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export PDF</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../dist/css/adminlte.min.css">


</head>

<body>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">


                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DataTable with default features</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
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
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <tr>
                                        <td>TOTAL</td>
                                        <td></td>
                                        <td></td>
                                        <td>-</td>
                                        <td>X</td>
                                        <td>X</td>
                                        <td>X</td>
                                        <td>X</td>
                                        <td>X</td>
                                        <td>X</td>
                                        <td>X</td>
                                        <td>X</td>
                                    </tr>
                                </tbody>

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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DataTable with default features</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
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
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                                        $num = 0;
                                        $num++;
                                    ?>
                                        <tr>
                                            <td><?php echo $num; ?> </td>
                                            <td><?php echo $result["dateSo"]; ?></td>
                                            <td><?php echo $result["invSo"]; ?></td>
                                            <td><?php echo $result["cusTomFee"]; ?></td>
                                            <td><?php echo $result["tranSportation"]; ?></td>
                                            <td><?php echo $result["vatAmt"]; ?></td>
                                            <td><?php echo $result["advanePrice"]; ?></td>
                                            <td><?php echo $result["totalAmt"]; ?></td>
                                            <td><?php echo $result["wt3"]; ?></td>
                                            <td><?php echo $result["wt1"]; ?></td>
                                            <td><?php echo $result["netAmt"]; ?></td>
                                            <td>
                                                <?php
                                                if ($result["stSO"] == '1')
                                                    echo "<span class='badge rounded-pill text-dark bg-warning'>" . $result["stShow"] . "</bage>" . "</span>";
                                                else if ($result["stSO"] == '2')
                                                    echo "<span class='badge rounded-pill text-dark bg-warning''>" . $result["stShow"] . "</badge>" . "</span>";
                                                else if ($result["stSO"] == '3')
                                                    echo "<span class='badge rounded-pill text-dark bg-info'>" . $result["stShow"] . "</badge>" . "</span>";
                                                else if ($result["stSO"] == '4')
                                                    echo "<span class='badge rounded-pill bg-primary'>" . $result["stShow"] . "</badge>" . "</span>";
                                                else if ($result["stSO"] == '5')
                                                    echo "<span class='badge rounded-pill bg-primary'>" . $result["stShow"] . "</badge>" . "</span>";
                                                else if ($result["stSO"] == '6')
                                                    echo "<span class='text-dark bg-danger'>" . $result["stShow"] . "</badge>" . "</span>";
                                                else echo "<span class='badge rounded-pill text-dark'>" . $result["stShow"] . "</badge>" . "</span>";
                                                ?>

                                            </td>
                                        </tr>
                                    <?php }; ?>

                                    <tr>
                                        <td colspan="3">TOTAL</td>
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                        <td>5</td>
                                        <td>6</td>
                                        <td>7</td>
                                        <td>8</td>
                                        <td>9</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <script src="../../../dist/js/demo.js"></script>
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