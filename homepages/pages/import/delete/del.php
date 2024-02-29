<?php
require_once '../connection/connect.php';

$invSo = $_GET['invSo'];
$FilesName = $_GET['FilesName'];

$sql = " DELETE FROM dbo.sonicdb WHERE invSo ='$invSo' ";
@unlink("../file_sonic/$FilesName");
$query = $conn->prepare($sql);
$query->execute();



if ($query) {
	echo "<script type='text/javascript'>";
	echo "alert('ลบสำเร็จ !');";
	echo "window.history.back()";
	echo "</script>";
} else {

	echo "<script type='text/javascript'>";
	echo "alert('error!');";
	echo "</script>";
}
?>