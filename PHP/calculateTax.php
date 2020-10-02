<?php

function calculateTax($type,$engcc){

    $taxAmount;
    if($type=="twoWheel"){
        if($engicc<=125){
            $taxAmount=2500;
        }
        else if($engicc<250){
            $taxAmount=4000;
        }
        else if($engicc<400){
            $taxAmount=8000;
        }
        else{
            $taxAmount=15000;
        }
    }
    else if ($type== "fourWheel"){
        if($engicc<=1000){
            $taxAmount=19000;
        }
        else if($engicc<1500){
            $taxAmount=21000;
        }
        else if($engicc<2000){
            $taxAmount=23000;
        }
        else if($engicc<2500){
            $taxAmount=32000;
        }
        else if($engicc<2900){
            $taxAmount=37000;
        }
        else{
            $taxAmount=53000;
        }
    }
    else{
        echo "Error";
        die();
    }
    return $taxAmount;

}



function calculateFine($currentTaxAmount,$totalDays){
    // $finePercent;
    // $fineDays= $totalDays;
    $fineAmount;

    if($totalDays<=0){
        $fineAmount=0;
    }
    else if($totalDays<=30){
        $fineAmount=(5/100)*$currentTaxAmount;
    }
    else if($totalDays<=45){
        $fineAmount=(10/100)*$currentTaxAmount;
    }
    else if($totalDays<=365){
        $fineAmount=(20/100)*$currentTaxAmount;
    }
    else if($totalDays<=365*5){
        $fineAmount=(32/100)*($totalDays/365)*$currentTaxAmount;
    }
    else {
        $fineAmount="Contact the main office";
    }
    return $fineAmount;
}
function calculatePercentageFine($totalDays){
    $finePercent;

    if($totalDays<=0){
        $finePercent = "0%";
    }
    else if($totalDays<=30){
        $finePercent = "5%";
    }
    else if($totalDays<=45){
        $finePercent = "10%";
    }
    else if($totalDays<=365){
        $finePercent = "20%";
    }
    else if($totalDays<=365*5){
        $finePercent = "32%(per/year)";
    }
    else {
        $finePercent = "Contact the main office";
    }
    return $finePercent;
}

if(isset($_GET['savedForm'])){

    require_once "connection.php";
    session_start();

    $phoneNo = $_SESSION['phone'];
    
    

    $sql = "SELECT VEHICLE_TYPE,ENGINE_CC,RENEW_DATE,INS_SLIP FROM form WHERE PHN ='$phoneNo'";
    $query = mysqli_query($connect,$sql);

    $infoArr = mysqli_fetch_all($query,MYSQLI_ASSOC);

    $date = date("Y-m-d");
    $dateArr = explode("-",$date);
    $lastDateArr = explode("-",$infoArr[0]['RENEW_DATE']);
    $insCheck = $infoArr[0]['INS_SLIP'];

    if($insCheck == 'no'){
        $insMssg = "You have to pay for the insurance too";
    }
    else{
        $insMssg = "";
    }
    $fineDaysCal = ((($dateArr[0]-$lastDateArr[0])*365)+(($dateArr[1]-$lastDateArr[1])*30)+($dateArr[2]-$lastDateArr[2]))-365;

    $tAmount = calculateTax($infoArr[0]['VEHICLE_TYPE'],$infoArr[0]['ENGINE_CC']);
    $fAmount = calculateFine($tAmount,$fineDaysCal);

    $totalAmount= $tAmount + $fAmount;

    $fineper = calculatePercentageFine($fineDaysCal);

    if($fineDaysCal<0){
        $fine = "You paid your tax " . abs($fineDaysCal) . " days ahead";
    }
    else{
        $fine = $fineper ."/ fine-" . $fAmount . "(". $fineDaysCal. "days late)";

    }
    $sql_add = "INSERT INTO FINE(PHN,YEAR,FINE,TAX_AMOUNT) VALUES ('$phoneNo','$date','$fine','$totalAmount');";
    $query_add=mysqli_query($connect, $sql_add);

    if(mysqli_affected_rows($connect)){
        header("location: ./QRPage.php?amount=$tAmount&fine=$fineper&mssg=$insMssg&fineAmount=$fAmount");
    }
    else{
        header("location: ../PAGES/form.html?error=NotInserted");
    }

}
else{
    header("location: ../PAGES/form.html?error=IllegalWay");
}



?>