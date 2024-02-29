<?php
session_start();
require_once '../connection/connect.php';
require '../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$invSo = $_GET['invSo'];
$stSO = $_GET['stSO'];
@$stDetail = $_GET['stDetail']." : ".$_SESSION['fristname'];
date_default_timezone_set("Asia/Bangkok");
$datetime = date("d-m-Y h:i:s a");


error_reporting(0);
ini_set('display_errors', 0);

if ($_GET["stSO"] == "1") {
	$sql = " UPDATE dbo.sonicdb SET

	    stSO = $stSO,
	    stShow = 'SNC Checking',
		tmpSO = '$datetime'

        WHERE invSo = '$invSo' ";

	$stmt = $conn->prepare($sql);
	$stmt->execute();

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
};
if ($_GET["stSO"] == "2") {
	$sql = " UPDATE dbo.sonicdb SET

	    stSO = $stSO,
	    stShow = 'MANAGER Checking',
		tmpSO = '$datetime'
	
	WHERE invSo = '$invSo' ";

	$stmt = $conn->prepare($sql);
	$stmt->execute();

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
};

if ($_GET["stSO"] == "3") {
	$sql = " UPDATE dbo.sonicdb SET
	
			stSO = $stSO,
			stShow = 'MD Checking',
			tmpSO = '$datetime'
	
			WHERE invSo = '$invSo' ";

	$stmt = $conn->prepare($sql);
	$stmt->execute();

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
};
if ($_GET["stSO"] == "4") {
	$sql = " UPDATE dbo.sonicdb SET
		
				stSO = $stSO,
				stShow = 'Accounting Checking',
				stSoApp = 'MD.Chayapa',
				tmpSO = '$datetime'
		
				WHERE invSo = '$invSo' ";

	$stmt = $conn->prepare($sql);
	$stmt->execute();

	if ($stmt) {

		$sql_data = "SELECT
			seaSo
      ,dePartMent
      ,conSigNee
      ,invSo
      ,dateSo
      ,invSncCusSo
      ,blNo
      ,importEntryNo
      ,exportEntryNo
	 FROM [SNC_Webapp].[dbo].[sonicdb]

	  WHERE invSo = ? ";
		$stmt_data = $conn->prepare($sql_data);
		$stmt_data->bindParam(1, $invSo, PDO::PARAM_STR);
		$stmt_data->execute();
		$result = $stmt_data->fetch(PDO::FETCH_ASSOC);

		$mail = new PHPMailer(true);
		$mail->CharSet = "utf-8";
		try {
			//Server settings
			// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = 'sncphpmailer01@gmail.com';             //SMTP username
			$mail->Password   = 'jgigficbnprtlywh';                     //SMTP password
			$mail->SMTPSecure = 'tls';                                   //Enable implicit TLS encryption
			$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			//Recipients
			$mail->setFrom('sncphpmailer01@gmail.com', 'E-BILLING Mailer SNC');
			if ($result['dePartMent'] == 'B') {

				$mail->addAddress('boi-snc@sncformer.com', 'BOI-SNC');     //Add a recipient
			} else {
				$mail->addAddress('Raken@snc-former.com', 'Raken-SNC');     //Add a recipient
			}
			// $mail->addAddress('lapsophon@sncformer.com', 'Lapsophon MIS');    //Add a recipient
			// $mail->addCC('lapsophon@sncformer.com', 'Lapsophon MIS'); //Add a CC
			//Attachments
			//Content
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = $result['invSo'].' Approve By MD.Chayapa';
			$mail->Body    = '<pre>
	<b> SEA </b> : ' . $result['seaSo'] . '
	<b> CONSIGNEE </b> : ' . $result['conSigNee'] . '
	<b> INVOICE BILL</b> : ' . $result['invSo'] . '
	<b> DATE BILL </b> : ' . date('d/m/Y', strtotime(str_replace('/', '-', $result['dateSo']))) . '
	<b> INVOICE CUSTOMER </b> : ' . $result['invSncCusSo'] . '
	<b> BL </b> : ' . $result['blNo'] . '
	<b> IMPORT ENTRY NO. </b> : ' . $result['importEntryNo'] . '
	<b> EXPORT ENTRY NO. </b> : ' . $result['exportEntryNo'] . '
						
						
						
						
						
						
						
						
						
						
	<H3><b> E-BILLING SNC (BI-MIS) </b> </H3>
				<pre>
				';
			// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			$mail->send();
			echo "<script type='text/javascript'>";
			echo "alert('Approve Ok !!');";
			echo "window.history.back() ";
			echo "</script>";
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}

	} else {

		echo "<script type='text/javascript'>";
		echo "alert('error!');";
		echo "window.history.back()";
		echo "</script>";
	}
};

if ($_GET["stSO"] == "5") {
	$sql = " UPDATE dbo.sonicdb SET
	
			stSO = $stSO,
			stShow = 'Prepare to pay',
			tmpSO = '$datetime'
	
			WHERE invSo = '$invSo' ";

	$stmt = $conn->prepare($sql);
	$stmt->execute();

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
};
if ($_GET["stSO"] == "6") {
	$sql = " UPDATE dbo.sonicdb SET
	
			stSO = $stSO,
			stShow = 'Wrong infomation',
			stDetail = '$stDetail',
			tmpSO = '$datetime'
	
			WHERE invSo = '$invSo' ";

	$stmt = $conn->prepare($sql);
	$stmt->execute();

	if ($stmt) {
		echo "<script type='text/javascript'>";
		echo "alert('Approve');";
		echo "window.close();";
		echo "</script>";
	} else {

		echo "<script type='text/javascript'>";
		echo "alert('error!');";
		echo "window.history.back()";
		echo "</script>";
	}
};
if ($_GET["stSO"] == "8") {
	$sql = " UPDATE dbo.sonicdb SET
	
			stSO = $stSO,
			stShow = 'Cancle',
			tmpSO = '$datetime'
	
			WHERE invSo = '$invSo' ";

	$stmt = $conn->prepare($sql);
	$stmt->execute();

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
};

if ($_GET["stSO"] == "7") {
	$sql = " UPDATE dbo.sonicdb SET
	
			stSO = $stSO,
			stShow = 'Approve payment',
			tmpSO = '$datetime'
	
			WHERE invSo = '$invSo' ";

	$stmt = $conn->prepare($sql);
	$stmt->execute();

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
} ;
?>
