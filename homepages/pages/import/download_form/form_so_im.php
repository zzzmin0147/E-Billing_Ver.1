<?php 
    $delimiter = ","; 
    $filename = "IMBook4" . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
    fputs($f, chr(0xEF) . chr(0xBB) . chr(0xBF));
     
    // Set column headers 
    $fields = array( 
        'CONSIGNEE', 
        'INVOICE', 
        'INVOICE DATE', 
        'INVOICE CUSTOMER', 
        'B/L NO.', 
        'IMPORT ENTRY NO.', 
        'EXPORT ENTRY NO.', 
        'CONTAINER 20',
        'CONTAINER 40',
        'CUSTOMS FEE',
        'DUT&TAX',
        'DELIVERY ORDER FEES',
        'TERMINAL HANDLING CHARGE',
        'ADVANCE LIFT ON/LIFT OFF 20-40',
        'DETENTION CHARGES',
        'DEMURRAGE CHARGE',
        'REPAIR',
        'STORAGE CHARGE',
        'PORT CHARGE',
        'CUSTOMS OVER TIME',
        'ADVANCE OTHER DESCRIPTION',
        'ADVANCE PRICE',
        'CUSTOMS CLEARANCE',
        'NEXTENTRY',
        'TRANSPORTATION',
        'CONTAINER DROP',
        'GATE FEE',
        'CHARGE LIFT ON/LIFT OFF 20-40',
        'TRANSPORT OVER TIME',
        'OCEAN FREIGHT',
        'AIR FREIGHT',
        'CARRIER DELIVERY ORDER',
        'THC PORT OF DISCHARGE',
        'CONTAINER CLEANING FEE',
        'EQUIPMENT CONTAINER FEE',
        'IMPORT HANDLING FEE',
        'EX-WORK COST',
        'INSURANCE',

        'CHARGE OTHER DESCRIPTION',
        'CHARGE PRICE',
        'GROSS AMT',
        'VAT AMT',
        'TOTAL AMT',
        'W/T 1%',
        'W/T 1% (SERVICE)',
        'W/T 3%',
        'NET AMT'
); 
    fputcsv($f, $fields, $delimiter); 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
    header("Pragma:no-cache");
     
    //output all remaining data on a file pointer 
    fpassthru($f); 

exit;
?>