<?php
 try {
 	$conn = new PDO("sqlsrv:Server=10.0.0.4;
 						Database=SNC_Webapp", "sa-webapp", "SnC@!!!@2023");
 	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 } catch (PDOException $e) {
 	die("Error connecting to SQL Server");
 }

?>