<?php

if(isset($_POST['saveForm'])) {

    require_once "./connection.php";

    $phn = $_POST['Phn'];
    $name = $_POST['Name'];
    
    $vehicleType = $_POST['Vtype'];
    $vehicleCat = $_POST['Vcategory'];
    $engineCC = $_POST['EngineCC'];
    $vehicleReg = $_POST['VehicleReg'];
    $renewDate = $_POST['RenewDate'];
    $insSlip = $_POST['insuranceSlip'];

    // creating a default names for the column fields NAME1, Phn1, VehicleReg1 if the 
    // form is for themselves
    if($_POST['Name1'] == "" && $_POST['Phn1'] == "" && $_POST['VehicleReg1'] == ""){
        $name1 = "Self";
        $phn1 = $_POST['Phn'];
        $vehicleReg1 = $_POST['VehicleReg'];
    }
    // else adding the data that is passed from the form
    else{
        $name1 = $_POST['Name1'];
        $phn1 = $_POST['Phn1'];
        $vehicleReg1 = $_POST['VehicleReg1'];
    }

        $sql_phn_check = "SELECT * FROM form WHERE PHN = '$phn';";

        $query_phn_check = mysqli_query($connect, $sql_phn_check);

    // updating the form table for the user
    // TODO: Dissucss further
    if(mysqli_num_rows($query_phn_check)) {

        $sql = "UPDATE form SET NAME = '$name', VEHICLE_TYPE = '$vehicleType', VEHICLE_CAT = '$vehicleCat', ENGINE_CC = '$engineCC', VEHICLE_REG = '$vehicleReg', RENEW_DATE = '$renewDate', INS_SLIP = '$insSlip' WHERE PHN = '$phn';";
    
        mysqli_query($connect, $sql);

        if(mysqli_affected_rows($connect)){
            header("location: ./calculateTax.php?savedForm");
        }else{
            header("location: ../PAGES/form.html?error=NotInserted");
        }

    }
    // adding the data to the form table if its the first time
    // TODO: discuss later on
    else {

        $sql = "INSERT INTO form(PHN, NAME, VEHICLE_TYPE, VEHICLE_CAT, ENGINE_CC, VEHICLE_REG, RENEW_DATE, NAME2, PHN2, VEHICLE_REG2, INS_SLIP) VALUES('$phn', '$name', '$vehicleType', '$vehicleCat', '$engineCC', '$vehicleReg', '$renewDate', '$name1', '$phn1', '$vehicleReg1', '$insSlip');";
    
        mysqli_query($connect, $sql);

        if(mysqli_affected_rows($connect)){
            header("location: ./calculateTax.php?savedForm");
        }else{
            header("location: ../PAGES/form.html?error=NotInserted");
        }
    }

}else{
    header("location:../PAGES/form.html?error=IllegalWay");
}