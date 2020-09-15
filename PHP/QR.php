<?php

    include('./phpqrcode/qrlib.php');
    
    require_once "connection.php";

    session_start();

    $phone = $_SESSION['phone'];

    $sql = "SELECT NAME, VEHICLE_TYPE, ENGINE_CC, RENEW_DATE FROM form WHERE PHN = '$phone';";
    $query = mysqli_query($connect, $sql);

    $arr = mysqli_fetch_all($query, MYSQLI_ASSOC);

    $taxAmount = $_GET['amount'];
    $finePercent = $_GET['fine'];
    $mssg = $_GET['mssg'];

    $qrName = 'Name: ' . $arr[0]['NAME'] . "\n";
    $qrVtype =  'Vehicle type: '. $arr[0]['VEHICLE_TYPE'] . "\n";
    $qrEng = 'Engine cc: '. $arr[0]['ENGINE_CC'] . "\n";
    $qrRenew = 'Renew date: ' . $arr[0]['RENEW_DATE'] . "\n";
    $qrTax = 'Tax Amount: ' . $taxAmount . "\n";
    $qrFine = 'Fine: ' . $finePercent . "\n";
    $qrInsMssg = 'Mssg: ' . $mssg;

    $qrMssg = $qrName . $qrVtype . $qrEng . $qrRenew . $qrTax . $qrFine . $qrInsMssg;

    // outputs image directly into browser, as PNG stream
    QRcode::png($qrMssg);
