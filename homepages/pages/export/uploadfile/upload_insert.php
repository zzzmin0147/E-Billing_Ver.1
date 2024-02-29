
<?php
require_once '../connection/connect.php';
$invSo = $_POST['invSo'];


$sql = "SELECT * FROM dbo.sonicdb WHERE invSo ='$invSo'";
$query = $conn->prepare($sql);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);

$dateInSo = $result['dateInSo'];
$userId = $result['useridSo'];



$path1 = "../file_export/";
$target_file = $path1 . basename($_FILES["FilesName"]["name"]);
$FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
if ($FileType != "pdf") {
    echo "<script type='text/javascript'>";
    echo "alert(' ประเภทไฟล์ไม่ใช่ PDF');";
    echo "window.history.back() ";
    echo "</script>";
} /*
if($_FILES["FilesName"]["size"] >= 5545728) {

	echo "<script type='text/javascript'>";
	echo "alert(' ขนาดไฟล์มากกว่า 5MB');";
	echo "window.history.back() ";
	echo "</script>";
}
*/
else {
    $path = "../file_export/";
    $date = $dateInSo;
    $upload = $_FILES['FilesName'];

        $remove_these = array(' ', '`', '"', '\'', '\\', '/', '_');
        $newname = str_replace($remove_these, '', $_FILES['FilesName']['name']);


        $newname = $userId . '_' . $invSo . '_' . $date;
        $path_copy = $path . $newname;
        $path_link = "../file_export/" . $newname;


        move_uploaded_file($_FILES['FilesName']['tmp_name'], $path_copy);


    

$sql = " UPDATE dbo.sonicdb SET

		FilesName = '$newname'

        WHERE invSo = '$invSo' ";

$stmt = $conn->prepare($sql);
$stmt->execute();

if ($stmt) {
	echo "<script type='text/javascript'>";
	echo "alert('เพิ่มข้อมูล PDF สำเร็จ..');";
	echo "window.close()";
	echo "</script>";
} else {

	echo "<script type='text/javascript'>";
	echo "alert('error!');";
	echo "</script>";
}

}

?>
