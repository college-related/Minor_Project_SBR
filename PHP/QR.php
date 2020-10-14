<?php

    include('./phpqrcode/qrlib.php');
    
    require_once "connection.php";

    session_start();

    $phone = $_SESSION['phone'];

    $sql = "SELECT NAME, VEHICLE_TYPE, ENGINE_CC, RENEW_DATE FROM form WHERE PHN = '$phone';";
    $query = mysqli_query($connect, $sql);

    // array containing datas from the form table to be included in the QR
    $arr = mysqli_fetch_all($query, MYSQLI_ASSOC);
    
    // passed data from GET method
    $taxAmount = $_GET['amount']; // total amount
    $finePercent = $_GET['fine']; // fine %
    $mssg = $_GET['mssg']; // mssg for insurance
    $date = Date("Y-m-d"); // QR Generated date

    // Add the above data in readable form
    $qrName = 'Name: ' . $arr[0]['NAME'] . "\n";
    $qrVtype =  'Vehicle type: '. $arr[0]['VEHICLE_TYPE'] . "\n";
    $qrEng = 'Engine cc: '. $arr[0]['ENGINE_CC'] . "\n";
    $qrRenew = 'Renew date: ' . $arr[0]['RENEW_DATE'] . "\n";
    $qrTax = 'Tax Amount: ' . $taxAmount . "\n";
    $qrFine = 'Fine: ' . $finePercent . "\n";
    $qrInsMssg = 'Mssg: ' . $mssg;
    $dateMssg = 'QR generated date: ' . $date;

    // Final mssg to be encoded in the QR code
    $qrMssg = $qrName . $qrVtype . $qrEng . $qrRenew . $qrTax . $qrFine . $qrInsMssg . $dateMssg;

    // outputs image directly into browser, as PNG stream
    QRcode::png($qrMssg);
