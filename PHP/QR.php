<?php

    function decryptData($data, $key){
        $encryption_key = base64_decode($key);
        list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
        $decryptedData = openssl_decrypt($encrypted_data, "aes-256-cbc", $encryption_key, 0, $iv);

        return $decryptedData;
    }

    include('./phpqrcode/qrlib.php');
    
    require "./includes/connection.php";
    require("./includes/table_columns_name.php");

    session_start();

    $uId = $_SESSION['uId'];

    $sql = "SELECT $username_column, $vehicleType_column, $engineCC_column, $renewDate_column FROM forms_data WHERE $formFillerId_column = '$uId' ORDER BY $formID_column DESC LIMIT 1;";
    $query = mysqli_query($connect, $sql);

    // array containing datas from the form table to be included in the QR
    $arr = mysqli_fetch_all($query, MYSQLI_ASSOC);

    $str = "j-{b\b{Prd(.w4:Zj-{b\b{Prd(.w4:Z";
    $key = md5($str);
    // passed data from GET method
    $taxAmount = $_GET['amount']; // total amount
    $finePercent = $_GET['fine']; // fine %
    $mssg = $_GET['mssg']; // mssg for insurance
    $date = Date("Y-m-d"); // QR Generated date

    // Add the above data in readable form
    $qrName = 'Name: ' . $arr[0][$username_column] . "\n";
    $qrVtype =  'Vehicle type: '. $arr[0][$vehicleType_column] . "\n";
    $qrEng = 'Engine cc: '. $arr[0][$engineCC_column] . "\n";
    $qrRenew = 'Last Renew date: ' . $arr[0][$renewDate_column] . "\n";
    $qrTax = 'Tax Amount: ' . $taxAmount . "\n";
    $qrFine = 'Fine: ' . $finePercent . "\n";
    $qrInsMssg = 'Mssg: ' . $mssg . "\n";
    $dateMssg = 'QR generated date: ' . $date;

    // Final mssg to be encoded in the QR code
    $qrMssg = $qrName . $qrVtype . $qrEng . $qrRenew . $qrTax . $qrFine . $qrInsMssg . $dateMssg;

    // outputs image directly into browser, as PNG stream
    QRcode::png($qrMssg);
