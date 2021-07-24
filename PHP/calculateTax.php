<?php

/*
    * function to calculte the tax amount

    *@param [vehicle type and engine cc]
    *@return [tax amount]

*/
function calculateTax($type,$engicc){

    $taxAmount = "";
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

/*
    * function to calculte the fine amount if any

    *@param [tax amount and days the bluebook is renewed]
    *@return [fine amount]

*/
function calculateFine($currentTaxAmount,$totalDays){
    // $finePercent;
    // $fineDays= $totalDays;
    $fineAmount = "";

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

/*
    * function to calculte the fine percentage if any

    *@param [days the bluebook is renewed]
    *@return [fine percentage]

*/
function calculatePercentageFine($totalDays){
    $finePercent = "";

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

if(isset($_GET['savedForm']) || isset($_GET['updatedForm'])){

    require "./includes/connection.php";
    require("./includes/table_columns_name.php");

    session_start();

    $fillerId=$_SESSION['uId'];
    
    $sql = "SELECT $vehicleType_column,$engineCC_column,$renewDate_column,$insurance_column,$formFillerId_column,uId FROM forms_data WHERE $formFillerId_column='$fillerId' ORDER BY $formID_column DESC LIMIT 1 ";
    $query = mysqli_query($connect,$sql);

    $infoArr = mysqli_fetch_all($query,MYSQLI_ASSOC);

    $date = date("Y-m-d");
    $dateArr = explode("-",$date);
    $lastDateArr = explode("-",$infoArr[0][$renewDate_column]);
    $insCheck = $infoArr[0][$insurance_column];

    /*
        * checking if the insurance slip is present or not
        * and providing corresponding message
    */ 
    if($insCheck == 'no'){
        $insMssg = "Insurance Not Paid";
    }
    else{
        $insMssg = "Insurance Paid";
    }

    // * Calculating days in between renewing the bluebook by subtracting last renew date from today's date
    $fineDaysCal = ((($dateArr[0]-$lastDateArr[0])*365)+(($dateArr[1]-$lastDateArr[1])*30)+($dateArr[2]-$lastDateArr[2]))-365;

    // * Obtaining the tax amount  
    $tAmount = calculateTax($infoArr[0][$vehicleType_column],$infoArr[0][$engineCC_column]);

    // * Obtaining the fine amount
    $fAmount = calculateFine($tAmount,$fineDaysCal);

    // * calculating total amount
    $totalAmount= $tAmount + $fAmount;

    // * obtaining fine percentage
    $fineper = calculatePercentageFine($fineDaysCal);

    /*
        * Defining corresponding message as the days in between
    */
    if($fineDaysCal<0){
        $fine = "You paid your tax " . abs($fineDaysCal) . " days ahead";
        $fineInDB = "Paid " . abs($fineDaysCal) . " days ahead";
    }
    else{
        $fine = $fineper ."/ fine-" . $fAmount . "(". $fineDaysCal. "days late)";
        $fineInDB = "Paid " . $fineDaysCal . " days late";
    }

    // * giving the uId column same as the form filler id if its the filler's form
    if($infoArr[0][$formFillerId_column] == $infoArr[0]['uId']){
        $uId = $fillerId;
    }else{
        $uId = 0;
    }

    if(isset($_GET['tId'])){
        $sql_add = "UPDATE tax_details SET $fillerId_column='$fillerId', uId='$uId', $createdAt_column=null, $fineAmount_column='$fAmount', $taxAmount_column='$tAmount', $finePercentage_column='$fineper', $paidIn_column='$fineInDB', $totalAmount_column='$totalAmount';";
        $query_add=mysqli_query($connect, $sql_add);

        if(mysqli_affected_rows($connect)){
            $command = "SELECT * FROM forms_data WHERE $formFillerId_column='$fillerId' ORDER BY $formID_column DESC";
            $execute = mysqli_query($connect, $command);
            $row = mysqli_fetch_all($execute, MYSQLI_ASSOC);
            $fId = $row[0][$formID_column];

            if($row[0]['uId'] == $row[0][$formFillerId_column]){
                $other = 'no';
            }else{
                $other = 'yes';
            }

            $command2 = "SELECT tId FROM tax_details WHERE $fillerId_column='$fillerId' ORDER BY tId DESC";
            $execute2 = mysqli_query($connect, $command2);
            $row2 = mysqli_fetch_all($execute2, MYSQLI_ASSOC);
            $tId = $row2[0]['tId'];

            header("location: ./QRPage.php?amount=$tAmount&fine=$fineper&mssg=$insMssg&fineAmount=$fAmount&fId=$fId&tId=$tId&other=$other&updated");
        }else{
            header("location: ../PAGES/form.php?error=NotInserted");
        }
    }else{
        $sql_add = "INSERT INTO tax_details($fillerId_column,uId,$createdAt_column,$fineAmount_column,$taxAmount_column,$finePercentage_column,$paidIn_column,$totalAmount_column) VALUES ('$fillerId','$uId',null,'$fAmount','$tAmount','$fineper','$fineInDB','$totalAmount');";
        $query_add=mysqli_query($connect, $sql_add);

        if(mysqli_affected_rows($connect)){
            $command = "SELECT * FROM forms_data WHERE $formFillerId_column='$fillerId' ORDER BY $formID_column DESC";
            $execute = mysqli_query($connect, $command);
            $row = mysqli_fetch_all($execute, MYSQLI_ASSOC);
            $fId = $row[0][$formID_column];

            if($row[0]['uId'] == $row[0][$formFillerId_column]){
                $other = 'no';
            }else{
                $other = 'yes';
            }

            $command2 = "SELECT tId FROM tax_details WHERE $fillerId_column='$fillerId' ORDER BY tId DESC";
            $execute2 = mysqli_query($connect, $command2);
            $row2 = mysqli_fetch_all($execute2, MYSQLI_ASSOC);
            $tId = $row2[0]['tId'];

            header("location: ./QRPage.php?amount=$tAmount&fine=$fineper&mssg=$insMssg&fineAmount=$fAmount&fId=$fId&tId=$tId&other=$other");
        }else{
            header("location: ../PAGES/form.html?error=NotInserted");
        }
    }

}
else{
    header("location: ../PAGES/form.html?error=IllegalWay");
}



?>