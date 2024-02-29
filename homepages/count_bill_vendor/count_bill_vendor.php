<?php
$username = $_SESSION['username'];
$sqlim = "SELECT usr.member_fristname as vendor_name,
sum (case when stSO = '0' then 1 else 0 end) as st_0,
sum (case when stSO = '1' then 1 else 0 end) as st_1,
sum (case when stSO = '2' then 1 else 0 end) as st_2,
sum (case when stSO = '3' then 1 else 0 end) as st_3,
sum (case when stSO = '4' then 1 else 0 end) as st_4,
sum (case when stSO = '5' then 1 else 0 end) as st_5,
sum (case when stSO = '6' then 1 else 0 end) as st_6,
sum (case when stSO = '7' then 1 else 0 end) as st_7
 FROM [SNC_Webapp].[dbo].[sonicdb] as bill
LEFT JOIN [SNC_Webapp].[dbo].[usersdb] as usr
ON bill.useridSo = usr.member_username
where invSo > '0'
 and seaSo ='IMPORT' 
 and useridSo = '$username'
 GROUP BY usr.member_fristname";
$queryim = $conn->prepare($sqlim);
$queryim->execute();
$resultim = $queryim->fetch(PDO::FETCH_ASSOC);


$sqlex = "SELECT usr.member_fristname as vendor_name,
sum (case when stSO = '0' then 1 else 0 end) as st_0,
sum (case when stSO = '1' then 1 else 0 end) as st_1,
sum (case when stSO = '2' then 1 else 0 end) as st_2,
sum (case when stSO = '3' then 1 else 0 end) as st_3,
sum (case when stSO = '4' then 1 else 0 end) as st_4,
sum (case when stSO = '5' then 1 else 0 end) as st_5,
sum (case when stSO = '6' then 1 else 0 end) as st_6,
sum (case when stSO = '7' then 1 else 0 end) as st_7
 FROM [SNC_Webapp].[dbo].[sonicdb] as bill
LEFT JOIN [SNC_Webapp].[dbo].[usersdb] as usr
ON bill.useridSo = usr.member_username
where invSo > '0'
 and seaSo ='EXPORT' 
 and useridSo = '$username'
 GROUP BY usr.member_fristname";
$queryex = $conn->prepare($sqlex);
$queryex->execute();
$resultex = $queryex->fetch(PDO::FETCH_ASSOC);

