<?php
function protect($data){
  return trim(strip_tags(addslashes($data)));
}

function encryptData($data, $key, $str){
  $encryption_key = base64_decode($key);
  $ivlength = substr(md5($str."users"),1, 16);
  $encryptedData = openssl_encrypt($data, "aes-256-cbc", $encryption_key, 0, $ivlength);

  return base64_encode($encryptedData.'::'.$ivlength);
}

if( isset($_POST['savebtn'])){
   require "./includes/connection.php";
   include("./includes/table_columns_name.php");

   session_start();

   $uId=$_SESSION['uId'];

   $vType=protect($_POST['vType']);
   $vCat=protect($_POST['vCategory']);
   $vReg=protect($_POST['regNo']);
   $engineCC=protect($_POST['ECC']);
   $phn = protect($_POST['Phn']);

   $str = "/6G6F;WvK7;s{au/6G6F;WvK7;s{au";
    $key = md5($str);
   $vReg = encryptData($vReg, $key, $str);
   $phn = encryptData($phn,$key, $str);

      $sql = "UPDATE vehicles_data SET $vehicleType_column='$vType', $vehicleCategory_column='$vCat', $vehicleRegistration_column='$vReg', $engineCC_column='$engineCC' WHERE uId=$uId";
      $query = mysqli_query($connect,$sql);

      if(mysqli_affected_rows($connect)){
          mysqli_query($connect, "UPDATE users SET $phoneNumber_column='$phn' WHERE uId=$uId");
          header("location: ../PAGES/profile.php?Logged&Updated");
      }else{
        mysqli_query($connect, "UPDATE users SET $phoneNumber_column='$phn' WHERE uId=$uId");
          if(mysqli_affected_rows($connect)){
            header("location: ../PAGES/profile.php?Logged&Updated");
          }else{
            header("location: ../PAGES/profile.php?Logged&NothingUpdated");
          }
      }
    

}else{
    header("location: ../PAGES/profile.php?Logged");
}