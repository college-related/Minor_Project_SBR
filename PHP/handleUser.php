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

if(isset($_POST['signup'])){

    // data from the signup form
    $email = protect($_POST['Email']);
    $username =  protect($_POST['Uname']);
    $password =  protect($_POST['Password']);
    $confirmpassword =  protect($_POST['Repass']);
    $phonenumber =  protect($_POST['Phn']);
    $address = protect($_POST['address']);
    $citizenshipNo = protect($_POST['citizenshipNo']);
    $vehicleType = protect($_POST['vType']);
    $vehicleCategory = protect($_POST['vCategory']);
    $vehicleReg = protect($_POST['vReg']);
    $engineCC = protect($_POST['engineCC']);
    $activateCode = md5(rand());

    // checking if the password's match or not 
    if($password == $confirmpassword){
        require_once "./connection.php";

        $str = $email.$password;
        $key = md5($str);

        $EncryptedEmail = encryptData($email, $key, $str);
        $EncryptedUsername = encryptData($username, $key, $str);
        $EncryptedPhonenumber = encryptData($phonenumber, $key, $str);
        $EncryptedAddress = encryptData($address, $key, $str);
        $EncryptedCitizenshipNo = encryptData($citizenshipNo, $key, $str);
        $EncryptedVehicleReg = encryptData($vehicleReg, $key, $str);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql_email_check = "SELECT * FROM users WHERE EMAIL = '$EncryptedEmail';";
        $sql_phn_check = "SELECT * FROM users WHERE PHN = '$EncryptedPhonenumber';";
        $sql_citizen_check = "SELECT * FROM users WHERE CITIZEN = '$EncryptedCitizenshipNo';";
        $sql_vreg_check = "SELECT * FROM vehicle_data WHERE VEHICLE_REG = '$EncryptedVehicleReg';";

            $query_email_check = mysqli_query($connect, $sql_email_check);
            $query_phn_check = mysqli_query($connect, $sql_phn_check);
            $query_citizen_check = mysqli_query($connect, $sql_citizen_check);
            $query_vreg_check = mysqli_query($connect, $sql_vreg_check);

        // checking if the email is already used
        // TODO: maybe use the library or some preg_match patterns
        if(mysqli_num_rows($query_email_check) > 0 ){
            header("location: ../register.php?inputError=AlreadyUserEmail&infoBack=noEmail&nameB=$username&phoneB=$phonenumber&addressB=$address&citizenB=$citizenshipNo&vRegB=$vehicleReg&engCCB=$engineCC&vTypeB=$vehicleType&vCatB=$vehicleCategory");
        }
        // checking if the phone number already exits
        else if(mysqli_num_rows($query_phn_check) > 0){
            header("location: ../register.php?inputError=AlreadyUserPhone&infoBack=noPhone&nameB=$username&emailB=$email&addressB=$address&citizenB=$citizenshipNo&vRegB=$vehicleReg&engCCB=$engineCC&vTypeB=$vehicleType&vCatB=$vehicleCategory");
        }
        
        else if(mysqli_num_rows($query_citizen_check) > 0 ){
            header("location: ../register.php?inputError=AlreadyCitizen&infoBack=noCitizen&emailB=$email&nameB=$username&phoneB=$phonenumber&addressB=$address&vRegB=$vehicleReg&engCCB=$engineCC&vTypeB=$vehicleType&vCatB=$vehicleCategory");
        }

        else if(mysqli_num_rows($query_vreg_check) > 0 ){
            header("location: ../register.php?inputError=AlreadyVReg&infoBack=noVreg&emailB=$email&nameB=$username&phoneB=$phonenumber&addressB=$address&citizenB=$citizenshipNo&engCCB=$engineCC&vTypeB=$vehicleType&vCatB=$vehicleCategory");
        }

        else{
           
            $sql = 
                "INSERT INTO users(NAME, EMAIL, PASSWORD, PHN, ACTIVATE_CODE, EMAIL_STATUS, ADDRESS, CITIZEN) 
                VALUES('$EncryptedUsername', '$EncryptedEmail', '$hashedPassword', '$EncryptedPhonenumber', '$activateCode', 'not verified', '$EncryptedAddress', '$EncryptedCitizenshipNo')";

            mysqli_query($connect, $sql);

            if(mysqli_affected_rows($connect)){
                $uIdGet = "SELECT uId FROM users WHERE EMAIL = '$EncryptedEmail'";
                $execute = mysqli_query($connect, $uIdGet);
                $row = mysqli_fetch_assoc($execute);
                $uId = $row['uId'];

                $sqlV = "INSERT INTO vehicle_data(uId, VEHICLE_TYPE, VEHICLE_CATEGORY, VEHICLE_REG, ENGINE_CC) VALUES('$uId','$vehicleType','$vehicleCategory', '$EncryptedVehicleReg', '$engineCC')";
                mysqli_query($connect, $sqlV);

                if(mysqli_affected_rows($connect)){
                    $sqlKey = "INSERT INTO user_key(uID, userKey,userStr) VALUES('$uId', '$key','$str')";
                    $executeKey = mysqli_query($connectKey, $sqlKey);

                    if(mysqli_affected_rows($connectKey)){
                        header("location: ./emailVerification.php?email=$EncryptedEmail&Email=$email&Uname=$username&Phone=$phonenumber&Address=$address&CitizenNo=$citizenshipNo&Vtype=$vehicleType&Vcat=$vehicleCategory&Vreg=$vehicleReg&EngCC=$engineCC");
                    }else{
                        header("location: ../register.php?error=NotInserted&infoBack=full&nameB=$username&phoneB=$phonenumber&emailB=$email&addressB=$address&citizenB=$citizenshipNo&vRegB=$vehicleReg&engCCB=$engineCC&vTypeB=$vehicleType&vCatB=$vehicleCategory");
                    }

                }else{
                    header("location: ../register.php?error=NotInserted&infoBack=full&nameB=$username&phoneB=$phonenumber&emailB=$email&addressB=$address&citizenB=$citizenshipNo&vRegB=$vehicleReg&engCCB=$engineCC&vTypeB=$vehicleType&vCatB=$vehicleCategory");
                }
            }else{
                header("location: ../register.php?error=NotInserted&infoBack=full&nameB=$username&phoneB=$phonenumber&emailB=$email&addressB=$address&citizenB=$citizenshipNo&vRegB=$vehicleReg&engCCB=$engineCC&vTypeB=$vehicleType&vCatB=$vehicleCategory");
            }
        }

    }else 
    {
        header("location:../register.php?inputError=PasswordNotSame&infoBack=full&nameB=$username&phoneB=$phonenumber&emailB=$email&addressB=$address&citizenB=$citizenshipNo&vRegB=$vehicleReg&engCCB=$engineCC&vTypeB=$vehicleType&vCatB=$vehicleCategory");
    }
}else{
    header("location:../register.php?error=IllegalWay");
}

?>