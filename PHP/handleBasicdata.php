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

    $sql_phn_check = "SELECT * FROM basic_data WHERE PHN1 = '$phn';";
    $Phn = mysqli_query($connect,$sql_phn_check);

    if(mysqli_num_rows($Phn) > 0 ){
      $sql = "UPDATE basic_data SET VEHICLE_TYPE1 = '$vType', VEHICLE_CAT1 = '$vCat', VEHICLE_REG1 = '$vReg', ENGINE_CC1 = '$engineCC' WHERE PHN1 = '$phn' && NAME1 = '$name';";

      $query = mysqli_query($connect,$sql);

      if(mysqli_affected_rows($connect)){
          header("location: ../PAGES/profile.php?Logged1");
      }else{
        header("location: ../PAGES/profile.php?Logged&Err");
      }
    }else{
        $sql = "INSERT INTO basic_data(PHN1, NAME1, VEHICLE_TYPE1, VEHICLE_CAT1, VEHICLE_REG1, ENGINE_CC1) VALUES ('$phn', '$name', '$vType', '$vCat', '$vReg', '$engineCC')";
        
        $query = mysqli_query($connect, $sql);

            if(mysqli_affected_rows($connect)){
                header("location: ../PAGES/profile.php?Logged");
            }else{
                header("location: ../PAGES/profile.php?Logged&Error");
            }
    }

}else{
    header("location: ../PAGES/profile.php?Logged");
}