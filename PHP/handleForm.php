<?php

function encryptData($data, $key, $str){
    $encryption_key = base64_decode($key);
    $ivlength = substr(md5($str."users"),1, 16);
    $encryptedData = openssl_encrypt($data, "aes-256-cbc", $encryption_key, 0, $ivlength);

    return base64_encode($encryptedData.'::'.$ivlength);
}

if(isset($_POST['saveForm'])) {

    require "./includes/connection.php";
    session_start();

    $phn = $_POST['Phn'];
    $name = $_POST['Name'];
    $uId = $_SESSION['uId'];
    
    $vehicleType = $_POST['Vtype'];
    $vehicleCat = $_POST['Vcategory'];
    $engineCC = $_POST['EngineCC'];
    $vehicleReg = $_POST['VehicleReg'];
    $renewDate = $_POST['RenewDate'];
    $insSlip = $_POST['insuranceSlip'];
    $address = $_POST['Address'];
    $citizen = $_POST['Citizen'];

    $name1 = $_POST['Name1'];
    $phn1 = $_POST['Phn1'];
    $address1 = $_POST['Address1'];
    $citizen1 = $_POST['Citizen1'];
    $vehicleReg1 = $_POST['VehicleReg1'];

    if($name1 == "")
        $name1 = $_POST['Name'];
    if($phn1 == "")
        $phn1 = $_POST['Phn'];
    if($address1 == "")
        $address1 = $_POST['Address'];
    if($citizen1 == "")
        $citizen1 = $_POST['Citizen'];
    if($vehicleReg1 == "")
        $vehicleReg1 = $_POST['VehicleReg'];

        $str = "j-{b\b{Prd(.w4:Zj-{b\b{Prd(.w4:Z";
        $key = md5($str);

        $phn = encryptData($phn, $key, $str);
        $name = encryptData($name, $key, $str);
        $vehicleReg = encryptData($vehicleReg, $key, $str);
        $name1 = encryptData($name1, $key, $str);
        $phn1 = encryptData($phn1, $key, $str);
        $vehicleReg1 = encryptData($vehicleReg1, $key, $str);
        $address = encryptData($address, $key, $str);
        $address1 = encryptData($address1, $key, $str);
        $citizen = encryptData($citizen, $key, $str);
        $citizen1 = encryptData($citizen1, $key, $str);

        $sql = "INSERT INTO form(PHN, NAME, VEHICLE_TYPE, VEHICLE_CATEGORY, ENGINE_CC, VEHICLE_REG, RENEW_DATE, NAME1, PHN1, VEHICLE_REG1, INS_SLIP, uId, ADDRESS, ADDRESS1, CITIZEN, CITIZEN1) VALUES('$phn', '$name', '$vehicleType', '$vehicleCat', '$engineCC', '$vehicleReg', '$renewDate', '$name1', '$phn1', '$vehicleReg1', '$insSlip', '$uId', '$address', '$address1', '$citizen', '$citizen1');";
    
        mysqli_query($connect, $sql);

        if(mysqli_affected_rows($connect)){
            header("location: ./calculateTax.php?savedForm");
        }else{
            header("location: ../PAGES/form.html?error=NotInserted");
        }

}else{
    header("location:../PAGES/form.html?error=IllegalWay");
}