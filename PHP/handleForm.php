<?php

include("./includes/encryption.php");

if(isset($_POST['saveForm'])) {

    require "./includes/connection.php";
    include("./includes/table_columns_name.php");
    session_start();

    $phn = $_POST['Phn'];
    $name = $_POST['Name'];
    $fillerId = $_SESSION['uId'];
    
    $vehicleType = $_POST['Vtype'];
    $vehicleCat = $_POST['Vcategory'];
    $engineCC = $_POST['EngineCC'];
    $vehicleReg = $_POST['VehicleReg'];
    $renewDate = $_POST['RenewDate'];
    $insSlip = $_POST['insuranceSlip'];
    $citizen = $_POST['Citizen'];
    $pp = $_POST['pp'];

    $name1 = $_POST['Name1'];
    $phn1 = $_POST['Phn1'];
    $vehicleReg1 = $_POST['VehicleReg1'];
    $uId = 0;

    // * making the uId filed same as the form filler id if the filler is 
    // * filling the form for themselves
    if($vehicleReg1 == $vehicleReg){
        $uId = $fillerId;
    }

        // * developing key for encrypting
        $str = "j-{b\b{Prd(.w4:Zj-{b\b{Prd(.w4:Z";
        $key = md5($str);
        
        // * encrypting phone number, vehicle registration number, phone number of filler
        // * vehicle registration number of filler, citizenship number 
        $phn = encryptData($phn, $key, $str);
        $vehicleReg = encryptData($vehicleReg, $key, $str);
        $phn1 = encryptData($phn1, $key, $str);
        $vehicleReg1 = encryptData($vehicleReg1, $key, $str);
        $citizen = encryptData($citizen, $key, $str);

        $sql = "INSERT INTO forms_data(uId, $phoneNumber_column, $username_column, $vehicleType_column, $vehicleCategory_column, $engineCC_column, $vehicleRegistration_column, $renewDate_column, $formFillerName_column, $formFillerPhn_column, $formFillerVehicleReg_column, $insurance_column, $formFillerId_column, $citizenship_column, $pp_column) VALUES('$uId', '$phn', '$name', '$vehicleType', '$vehicleCat', '$engineCC', '$vehicleReg', '$renewDate', '$name1', '$phn1', '$vehicleReg1', '$insSlip', '$fillerId', '$citizen', '$pp');";
    
        mysqli_query($connect, $sql);

        if(mysqli_affected_rows($connect)){
            header("location: ./calculateTax.php?savedForm");
        }else{
            header("location: ../PAGES/form.html?error=NotInserted");
        }

}else{
    header("location:../PAGES/form.html?error=IllegalWay");
}