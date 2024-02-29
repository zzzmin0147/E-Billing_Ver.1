<?php
$where = "";
if ($_SESSION['userlevel'] == "acc") {
    $company = $_SESSION['company'];
    $where .= " AND conSigNee = '$company' ";
}
if (($_SESSION['userlevel'] == "boi") || ($_SESSION['userlevel'] == "boimng")) {
    $where .= " AND dePartMent = 'B' ";
}
if ($_SESSION['userlevel'] == "scm") {
    $where .= " AND dePartMent = 'S' ";
} else {
}
$sql_bill = " SELECT usr.member_fristname as vendor_name,
sum (case when stSO = '0' and seaSo ='IMPORT' then 1 else 0 end) as st_im_0,
sum (case when stSO = '1' and seaSo ='IMPORT' then 1 else 0 end) as st_im_1,
sum (case when stSO = '2' and seaSo ='IMPORT' then 1 else 0 end) as st_im_2,
sum (case when stSO = '3' and seaSo ='IMPORT' then 1 else 0 end) as st_im_3,
sum (case when stSO = '4' and seaSo ='IMPORT' then 1 else 0 end) as st_im_4,
sum (case when stSO = '5' and seaSo ='IMPORT' then 1 else 0 end) as st_im_5,
sum (case when stSO = '6' and seaSo ='IMPORT' then 1 else 0 end) as st_im_6,
sum (case when stSO = '7' and seaSo ='IMPORT' then 1 else 0 end) as st_im_7,
sum (case when stSO = '0' and seaSo ='EXPORT' then 1 else 0 end) as st_ex_0,
sum (case when stSO = '1' and seaSo ='EXPORT' then 1 else 0 end) as st_ex_1,
sum (case when stSO = '2' and seaSo ='EXPORT' then 1 else 0 end) as st_ex_2,
sum (case when stSO = '3' and seaSo ='EXPORT' then 1 else 0 end) as st_ex_3,
sum (case when stSO = '4' and seaSo ='EXPORT' then 1 else 0 end) as st_ex_4,
sum (case when stSO = '5' and seaSo ='EXPORT' then 1 else 0 end) as st_ex_5,
sum (case when stSO = '6' and seaSo ='EXPORT' then 1 else 0 end) as st_ex_6,
sum (case when stSO = '7' and seaSo ='EXPORT' then 1 else 0 end) as st_ex_7
 FROM [SNC_Webapp].[dbo].[sonicdb] as bill
LEFT JOIN [SNC_Webapp].[dbo].[usersdb] as usr
ON bill.useridSo = usr.member_username
where invSo > '0' $where
 GROUP BY usr.member_fristname
 ORDER BY vendor_name ASC
 ";
$query_bill = $conn->prepare($sql_bill);
$query_bill->execute();