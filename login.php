<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=tis-620">
<?php
echo '
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
require_once 'connection/connect.php';
session_start();

date_default_timezone_set("Asia/Bangkok");

$date  = date("Y-m-d");
$time  = date("H:i:s");
$web_app_type  = 'e-billing';

error_reporting(0);
ini_set('display_errors', 0);

$username = $_POST["username"];
$pass = $_POST['password'];

$sql_c = "SELECT * FROM dbo.usersdb where member_username = '" . $username . "' and member_password = '" . $pass . "'";
$query_c = $conn->prepare($sql_c);
$query_c->execute();
$result_c = $query_c->fetch(PDO::FETCH_ASSOC);
if ($result_c['member_username'] == $username) {

  $_SESSION["username"] = $result_c["member_username"];
  $_SESSION["company"] = $result_c["member_company"];
  $_SESSION["userlevel"] = $result_c["member_level"];
  $_SESSION["fristname"] = $result_c["member_fristname"];
  $_SESSION["lastname"] = $result_c["member_lastname"];
  $_SESSION["department"] = $result_c["member_department"];

  if ($_SESSION["userlevel"] == "sonic") {
    $sql_log = "INSERT INTO [SNC_Webapp].[dbo].[web_app_log_user]
    (
        ip_address_log
,username_log
,name_log
,date_log
,time_log
,type_web_app_log
    )
     VALUES (?,?,?,?,?,?)";
    $stmt_log = $conn->prepare($sql_log);
    $stmt_log->bindParam(1, $_SERVER['REMOTE_ADDR']);
    $stmt_log->bindParam(2, $result_c["member_username"]);
    $stmt_log->bindParam(3, $result_c["member_username"]);
    $stmt_log->bindParam(4, $date);
    $stmt_log->bindParam(5, $time);
    $stmt_log->bindParam(6, $web_app_type);
    $stmt_log->execute();

    echo '<script>
                                              setTimeout(function() {
                                               swal({
                                                  title: "เข้าสู่ระบบ",
                                                  text: "กำลังเข้าสู่ระบบ...",
                                                  type: "success",
                                                  showConfirmButton: false,
                                                  timer: 2000
                                                   
                                               }, function() {
                                                   window.location = "homepages/index.php"; //หน้าที่ต้องการให้กระโดดไป
                                               });
                                             }, 1000);
                                         </script>';
  }
} else {

  if ($username != null and $pass != null) {
    $server = "snc-former.com";  //dc1-nu
    $user = $_POST["username"] . "@snc-former.com";
    $member_username = $_POST["username"];
    // connect to active directory
    $ad = ldap_connect($server);
    if (!$ad) {
      die("Connect not connect to " . $server);
      //   include("chk_login_db.php");
      echo "ไม่สามารถติดต่อ server ได้";
      exit();
    } else {
      $b = @ldap_bind($ad, $user, $pass);
      if (!$b) {
        echo '<script>
                    setTimeout(function() {
                     swal({
                         title: "เกิดข้อผิดพลาด",
                          text: "Username หรือ Password ไม่ถูกต้อง ลองใหม่อีกครั้ง",
                         type: "warning"
                     }, function() {
                         window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
                     });
                   }, 1000);
               </script>';
      } else {

        //login ผ่านแล้วมาทำไรก็ว่าไป

        $_SESSION["user"] = $user;
        $_SESSION["firstname"] = $member_username;

        $sql = "SELECT * FROM dbo.usersdb where member_username = '$member_username' ";
        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);


        if ($result['member_username'] != "$member_username") {
          echo '<script>
        setTimeout(function() {
         swal({
             title: "เกิดข้อผิดพลาด",
              text: "Username กับ Member Username ไม่ตรงกัน",
             type: "warning"
         }, function() {
             window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
         });
       }, 1000);
   </script>';
        }

        if ($result != "") {
          $_SESSION["username"] = $result["member_username"];
          $_SESSION["company"] = $result["member_company"];
          $_SESSION["userlevel"] = $result["member_level"];
          $_SESSION["fristname"] = $result["member_fristname"];
          $_SESSION["lastname"] = $result["member_lastname"];
          $_SESSION["department"] = $result["member_department"];
          $sql_log = "INSERT INTO [SNC_Webapp].[dbo].[web_app_log_user]
            (
                ip_address_log
      ,username_log
      ,name_log
      ,date_log
      ,time_log
      ,type_web_app_log
            )
             VALUES (?,?,?,?,?,?)";
          $stmt_log = $conn->prepare($sql_log);
          $stmt_log->bindParam(1, $_SERVER['REMOTE_ADDR']);
          $stmt_log->bindParam(2, $result["member_username"]);
          $stmt_log->bindParam(3, $result["member_username"]);
          $stmt_log->bindParam(4, $date);
          $stmt_log->bindParam(5, $time);
          $stmt_log->bindParam(6, $web_app_type);
          $stmt_log->execute();
          echo '<script>
                                              setTimeout(function() {
                                               swal({
                                                  title: "เข้าสู่ระบบ",
                                                  text: "กำลังเข้าสู่ระบบ...",
                                                  type: "success",
                                                  showConfirmButton: false,
                                                  timer: 2000
                                                   
                                               }, function() {
                                                   window.location = "homepages/index.php"; //หน้าที่ต้องการให้กระโดดไป
                                               });
                                             }, 1000);
                                         </script>';
        }
        $conn = null; //close connect db
      }
    }
  }
}
?>