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

    $sql_phn_check = "SELECT * FROM basic_data WHERE PHN = '$phn';";
    $Phn = mysqli_query($connect,$sql_phn_check);

    if(mysqli_num_rows($Phn) > 0 ){
      $sql = "UPDATE basic_data SET VEHICLE_TYPE = '$vType', VEHICLE_CAT = '$vCat', VEHICLE_REG = '$vReg', ENGINE_CC = '$engineCC' WHERE PHN = '$phn' && NAME = '$name';";

      $query = mysqli_query($connect,$sql);

      if(mysqli_affected_rows($connect)){
          header("location: ../PAGES/profile.php?Logged");
      }else{
        header("location: ../PAGES/profile.php?Logged&Err");
      }
    }else{
        $sql = "INSERT INTO basic_data(PHN, NAME, VEHICLE_TYPE, VEHICLE_CAT, VEHICLE_REG, ENGINE_CC) VALUES ('$phn', '$name', '$vType', '$vCat', '$vReg', '$engineCC')";
        
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