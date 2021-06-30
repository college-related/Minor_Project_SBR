<?php

include('./includes/table_columns_name.php');
include("./includes/encryption.php");

if(isset($_POST['login'])){
    require "./includes/connection.php";

    $user = protect($_POST['user']);
    $Password = protect($_POST['Password']);

    // * generating key for encryption
    $str = "/6G6F;WvK7;s{au/6G6F;WvK7;s{au";
    $key = md5($str);

    $username_sql = "SELECT $password_column, $emailVerification_column, $role_column, uId FROM users WHERE $username_column = '$user';";
    $result = mysqli_query($connect, $username_sql);
    
    // * checking if the user with the given name is a valid user or not
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach($row as $data){
            // * checking if the email is verified or not
            if($data[$emailVerification_column] == "not verified"){
                header("location: ../index.php?error=EmailNotVerified#loginForm");
                die();
            }

            // * cheking if the password is correct or not
            if(password_verify($Password,$data[$password_column])){
                session_start();
                $_SESSION['uId'] = $data['uId'];

                if($data[$role_column] == 'admin'){
                    $_SESSION['role'] = 'admin';
                    header("location: ../PAGES/admin/profile.php");
                    die();
                }else{
                    header("location: ../PAGES/profile.php?Logged");
                    die();
                }
            }else{
                header("location: ../index.php?inputError=WrongPass#loginForm");
            }
        }
    }else{
        $user = encryptData($user, $key, $str);    
        $email_sql = "SELECT $password_column, $emailVerification_column, $role_column, uId FROM users WHERE $email_column = '$user';";
        $result = mysqli_query($connect, $email_sql);
        
        // * checking if the user with the given email is a valid user
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);

            // * checking if the email is verified or not
            if($row[$emailVerification_column] == "not verified"){
                header("location: ../index.php?error=EmailNotVerified#loginForm");
                die();
            }

            session_start();
            $_SESSION['uId'] = $row['uId'];

            // * checking if the password is correct or not
            if(password_verify($Password,$row[$password_column])){
                if($row[$role_column] == 'admin'){
                    $_SESSION['role'] = 'admin';
                    header("location: ../PAGES/admin/profile.php");
                    die();
                }else{
                    header("location: ../PAGES/profile.php?Logged");
                    die();
                }
            }else{
                header("location: ../index.php?inputError=WrongNameORPass#loginForm");
            }
        }else{
            header("location: ../index.php?inputError=WrongEmailOrUser#loginForm");
        }
    }

}else{
    header("location:../index.php?error=IllegalWay");
}

?>