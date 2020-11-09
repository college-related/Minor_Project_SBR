<?php

if(isset($_POST['signup'])){

    // data from the signup form
    $email = $_POST['Email'];
    $username =  $_POST['Uname'];
    $password =  $_POST['Password'];
    $confirmpassword =  $_POST['Repass'];
    $phonenumber =  $_POST['Phn'];
    $address = $_POST['address'];
    $citizenshipNo = $_POST['citizenshipNo'];
    $vehicleType = $_POST['vType'];
    $vehicleCategory = $_POST['vCategory'];
    $vehicleReg = $_POST['vReg'];
    $engineCC = $_POST['engineCC'];
    $activateCode = md5(rand());

    // checking if the password's match or not 
    if($password == $confirmpassword){
        require_once "./connection.php";

        $sql_email_check = "SELECT * FROM users WHERE EMAIL = '$email';";
        $sql_phn_check = "SELECT * FROM users WHERE PHN = '$phonenumber';";

            $query_email_check = mysqli_query($connect, $sql_email_check);
            $query_phn_check = mysqli_query($connect, $sql_phn_check);

        // checking if the email is already used
        // TODO: maybe use the library or some preg_match patterns
        if(mysqli_num_rows($query_email_check) > 0 ){
            header("location: ../register.php?inputError=AlreadyUserEmail&infoBack=noEmail&nameB=$username&phoneB=$phonenumber&addressB=$address&citizenB=$citizenshipNo&vRegB=$vehicleReg&engCCB=$engineCC&vTypeB=$vehicleType&vCatB=$vehicleCategory");
        }
        // checking if the phone number already exits
        else if(mysqli_num_rows($query_phn_check) > 0){
            header("location: ../register.php?inputError=AlreadyUserPhone&infoBack=noPhone&nameB=$username&emailB=$email&addressB=$address&citizenB=$citizenshipNo&vRegB=$vehicleReg&engCCB=$engineCC&vTypeB=$vehicleType&vCatB=$vehicleCategory");
        }else{
            session_start();
            $_SESSION['Uname'] = $username;
            $_SESSION['Email'] = $email;
            $_SESSION['Phone'] = $phonenumber;
            $_SESSION['Address'] = $address;
            $_SESSION['CitizenNo'] = $citizenshipNo;
            $_SESSION['Vtype'] = $vehicleType;
            $_SESSION['Vcat'] = $vehicleCategory;
            $_SESSION['Vreg'] = $vehicleReg;
            $_SESSION['EngCC'] = $engineCC;

            $sql = 
                "INSERT INTO users(NAME, EMAIL, PASSWORD, PHN, ACTIVATE_CODE, EMAIL_STATUS, ADDRESS, CITIZEN) 
                VALUES('$username', '$email', '$password', '$phonenumber', '$activateCode', 'verified', '$address', '$citizenshipNo')";

            mysqli_query($connect, $sql);

            if(mysqli_affected_rows($connect)){
                $uIdGet = "SELECT uId FROM users WHERE EMAIL = '$email'";
                $execute = mysqli_query($connect, $uIdGet);
                $row = mysqli_fetch_assoc($execute);
                $uId = $row['uId'];

                $sqlV = "INSERT INTO vehicle_data(uId, VEHICLE_TYPE, VEHICLE_CATEGORY, VEHICLE_REG, ENGINE_CC) VALUES('$uId','$vehicleType','$vehicleCategory', '$vehicleReg', '$engineCC')";
                mysqli_query($connect, $sqlV);

                if(mysqli_affected_rows($connect)){
                    header("location: ./emailVerification.php");
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