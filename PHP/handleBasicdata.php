<?php
if( isset($_POST['savebtn'])){
   require_once "./connection.php";

   session_start();

   $name=$_SESSION['Uname'];
   $phn=$_SESSION['phone'];


   $vType=$_POST['vType'];
   $vCat=$_POST['vCategory'];
   $vReg=$_POST['regNo'];
   $engineCC=$_POST['ECC'];
   $renew=$_POST['RenewDate'];   

    $sql_phn_check = "SELECT * FROM basic_data WHERE PHN = '$phn';";
    $Phn = mysqli_query($connect,$sql_phn_check);

    if(mysqli_num_rows($Phn) > 0 ){
        header("location: ../PAGES/profile.php?Logged&Error");
    }else{
        $sql = "INSERT INTO basic_data(PHN, NAME, VEHICLE_TYPE, VEHICLE_CAT, VEHICLE_REG, ENGINE_CC, INITIAL_RENEW_DATE) VALUES ('$phn', '$name', '$vType', '$vCat', '$vReg', '$engineCC', '$renew')";
        
        $query = mysqli_query($connect, $sql);

            if(mysqli_affected_rows($query)){
                header("location: ../PAGES/profile.php?Logged");
            }else{
                header("location: ../PAGES/profile.php?Logged&Error");
            }
    }

}else{
    header("location: ../PAGES/profile.php?Logged");
}