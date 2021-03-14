<?php

include('./includes/table_columns_name.php');
include("./includes/encryption.php");

if(isset($_POST['signup'])){

    // * data from the signup form
    $email = protect($_POST['email']);
    $username =  protect($_POST['username']);
    $password =  protect($_POST['password']);
    $confirmpassword =  protect($_POST['repassword']);
    $phonenumber =  protect($_POST['phoneNumber']);
    $citizenshipNumber = protect($_POST['citizenshipNumber']);
    $vehicleType = protect($_POST['vType']);
    $vehicleCategory = protect($_POST['vCategory']);
    $vehicleRegistrationNumber = protect($_POST['vReg']);
    $engineCC = protect($_POST['engineCC']);
    $activationCode = md5(rand());

    // * setting the public or private as the need
    if($_POST['public_or_private']){
        $publicOrPrivate = protect($_POST['public_or_private']);
    }else{
        $publicOrPrivate = "private";
    }

    // * checking if the password's match or not 
    if($password == $confirmpassword){
        require "./includes/connection.php";

        // * Generating key for encryption
        $str = "/6G6F;WvK7;s{au/6G6F;WvK7;s{au";
        $key = md5($str);

        // * encrypting email, phone number, citizenship number and vehicle Registration number
        $EncryptedEmail = encryptData($email, $key, $str);
        $EncryptedPhonenumber = encryptData($phonenumber, $key, $str);
        $EncryptedCitizenshipNumber = encryptData($citizenshipNumber, $key, $str);
        $EncryptedVehicleRegistrationNumber = encryptData($vehicleRegistrationNumber, $key, $str);

        // * hashing the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql_email_check = "SELECT * FROM users WHERE $email_column = '$EncryptedEmail';";
        $sql_phn_check = "SELECT * FROM users WHERE $phoneNumber_column = '$EncryptedPhonenumber';";
        $sql_citizen_check = "SELECT * FROM users WHERE $citizenship_column = '$EncryptedCitizenshipNumber';";
        $sql_vreg_check = "SELECT * FROM vehicles_data WHERE $vehicleRegistration_column = '$EncryptedVehicleRegistrationNumber';";

            $query_email_check = mysqli_query($connect, $sql_email_check);
            $query_phn_check = mysqli_query($connect, $sql_phn_check);
            $query_citizen_check = mysqli_query($connect, $sql_citizen_check);
            $query_vreg_check = mysqli_query($connect, $sql_vreg_check);

            // * checking if the email is already used
            // TODO: maybe use the library or some preg_match patterns
            if(mysqli_num_rows($query_email_check) > 0 ){
                header("location: ../register.php?inputError=AlreadyUserEmail&infoBack=noEmail&nameB=$username&phoneB=$phonenumber&addressB=$address&citizenB=$citizenshipNumber&vRegB=$vehicleRegistrationNumber&engCCB=$engineCC&vTypeB=$vehicleType&vCatB=$vehicleCategory&pp=$publicOrPrivate");
            }
            // * checking if the phone number already used
            else if(mysqli_num_rows($query_phn_check) > 0){
                header("location: ../register.php?inputError=AlreadyUserPhone&infoBack=noPhone&nameB=$username&emailB=$email&addressB=$address&citizenB=$citizenshipNumber&vRegB=$vehicleRegistrationNumber&engCCB=$engineCC&vTypeB=$vehicleType&vCatB=$vehicleCategory&pp=$publicOrPrivate");
            }
            // * checking if citizenship number already used
            else if(mysqli_num_rows($query_citizen_check) > 0 ){
                header("location: ../register.php?inputError=AlreadyCitizen&infoBack=noCitizen&emailB=$email&nameB=$username&phoneB=$phonenumber&addressB=$address&vRegB=$vehicleRegistrationNumber&engCCB=$engineCC&vTypeB=$vehicleType&vCatB=$vehicleCategory&pp=$publicOrPrivate");
            }
            // * Checking if the vehicle regitartion number already used
            else if(mysqli_num_rows($query_vreg_check) > 0 ){
                header("location: ../register.php?inputError=AlreadyVReg&infoBack=noVreg&emailB=$email&nameB=$username&phoneB=$phonenumber&addressB=$address&citizenB=$citizenshipNumber&engCCB=$engineCC&vTypeB=$vehicleType&vCatB=$vehicleCategory&pp=$publicOrPrivate");
            }

            else{
            
                // * Adding to users table
                $sql = 
                    "INSERT INTO users($username_column, $email_column, $password_column, $activation_column, $emailVerification_column, $phoneNumber_column, $citizenship_column) VALUES('$username', '$EncryptedEmail', '$hashedPassword', '$activationCode', 'not verified', '$EncryptedPhonenumber', '$EncryptedCitizenshipNumber')";

                mysqli_query($connect, $sql);

                if(mysqli_affected_rows($connect)){
                    $uIdGet = "SELECT uId FROM users WHERE $email_column = '$EncryptedEmail'";
                    $execute = mysqli_query($connect, $uIdGet);
                    $row = mysqli_fetch_assoc($execute);
                    $uId = $row['uId'];

                    // * Adding to vehicles_data table
                    $sqlV = 
                        "INSERT INTO vehicles_data(uId, $vehicleType_column, $vehicleCategory_column, $vehicleRegistration_column, $engineCC_column, $pp_column) 
                        VALUES($uId,'$vehicleType','$vehicleCategory', '$EncryptedVehicleRegistrationNumber', '$engineCC', '$publicOrPrivate')";

                    mysqli_query($connect, $sqlV);

                    if(mysqli_affected_rows($connect)){
                            header("location: ./emailVerification.php?Email=$email&Uname=$username&Phone=$phonenumber&CitizenNo=$citizenshipNumber&Vtype=$vehicleType&Vcat=$vehicleCategory&Vreg=$vehicleRegistrationNumber&EngCC=$engineCC&pp=$publicOrPrivate&email=$EncryptedEmail");
                    }else{
                        header("location: ../register.php?error=NotInserted&infoBack=full&nameB=$username&phoneB=$phonenumber&emailB=$email&addressB=$address&citizenB=$citizenshipNumber&vRegB=$vehicleRegistrationNumber&engCCB=$engineCC&vTypeB=$vehicleType&vCatB=$vehicleCategory&pp=$publicOrPrivate");
                    }
                }else{
                    header("location: ../register.php?error=NotInserted&infoBack=full&nameB=$username&phoneB=$phonenumber&emailB=$email&addressB=$address&citizenB=$citizenshipNumber&vRegB=$vehicleRegistrationNumber&engCCB=$engineCC&vTypeB=$vehicleType&vCatB=$vehicleCategory&pp=$publicOrPrivate");
                }
            }
    }else{
        header("location: ../register.php?inputError=PasswordNotSame&infoBack=full&nameB=$username&phoneB=$phonenumber&emailB=$email&addressB=$address&citizenB=$citizenshipNumber&vRegB=$vehicleRegistrationNumber&engCCB=$engineCC&vTypeB=$vehicleType&vCatB=$vehicleCategory&pp=$publicOrPrivate");
    }
}else{
    header("location:../register.php?error=IllegalWay");
}

?>