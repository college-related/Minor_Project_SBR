<?php

function calculateTax($type,$engicc){

    $taxAmount;
    if($type=="two wheeler"){
        if($engicc=="0-125CC"){
            $taxAmount=2500;
        }
        else if($engicc=="126CC-250CC"){
            $taxAmount=4000;
        }
        else if($engicc=="251CC-400CC"){
            $taxAmount=8000;
        }
        else{
            $taxAmount=15000;
        }
    }
    else if ($type== "four wheeler"){
        if($engicc=="0-1000CC"){
            $taxAmount=19000;
        }
        else if($engicc=="1001CC-1500CC"){
            $taxAmount=21000;
        }
        else if($engicc=="1501CC-2000CC"){
            $taxAmount=23000;
        }
        else if($engicc=="2001CC-2500CC"){
            $taxAmount=32000;
        }
        else if($engicc=="2501CC-2900CC"){
            $taxAmount=37000;
        }
        else{
            $taxAmount=53000;
        }
    }
    else{
        echo "Error";
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

    require "./includes/connection.php";
    require("./includes/table_columns_name.php");

    session_start();

    $fillerId=$_SESSION['uId'];
    
    $sql = "SELECT $vehicleType_column,$engineCC_column,$renewDate_column,$insurance_column,$formFillerId_column,uId FROM forms_data WHERE $formFillerId_column='$fillerId' ORDER BY $formID_column DESC LIMIT 1 ";
    $query = mysqli_query($connect,$sql);

    $infoArr = mysqli_fetch_all($query,MYSQLI_ASSOC);

    // print_r($infoArr);
    // die();

    $date = date("Y-m-d");
    $dateArr = explode("-",$date);
    $lastDateArr = explode("-",$infoArr[0][$renewDate_column]);
    $insCheck = $infoArr[0][$insurance_column];

    if($insCheck == 'no'){
        $insMssg = "Insurance Not Paid";
    }
    else{
        $insMssg = "Insurance Paid";
    }
    $fineDaysCal = ((($dateArr[0]-$lastDateArr[0])*365)+(($dateArr[1]-$lastDateArr[1])*30)+($dateArr[2]-$lastDateArr[2]))-365;

    $tAmount = calculateTax($infoArr[0][$vehicleType_column],$infoArr[0][$engineCC_column]);
    $fAmount = calculateFine($tAmount,$fineDaysCal);

    $totalAmount= $tAmount + $fAmount;

    $fineper = calculatePercentageFine($fineDaysCal);

    if($fineDaysCal<0){
        $fine = "You paid your tax " . abs($fineDaysCal) . " days ahead";
        $fineInDB = "Paid " . abs($fineDaysCal) . " days ahead";
    }
    else{
        $fine = $fineper ."/ fine-" . $fAmount . "(". $fineDaysCal. "days late)";
        $fineInDB = "Paid " . $fineDaysCal . " days late";
    }

    if($infoArr[0][$formFillerId_column] == $infoArr[0]['uId']){
        $uId = $fillerId;
    }else{
        $uId = 0;
    }

    $sql_add = "INSERT INTO tax_details($fillerId_column,uId,$createdAt_column,$fineAmount_column,$taxAmount_column,$finePercentage_column,$paidIn_column,$totalAmount_column) VALUES ('$fillerId','$uId',null,'$fAmount','$tAmount','$fineper','$fineInDB','$totalAmount');";
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