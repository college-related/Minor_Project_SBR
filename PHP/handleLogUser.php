<?php

if(isset($_POST['login'])){
    require_once "./connection.php";

    $Uname = $_POST['Uname'];
    $Password = $_POST['Password'];
    
    $phn_sql = "SELECT PHN, EMAIL, EMAIL_STATUS FROM users WHERE USERNAME = '$Uname' && PASSWORD = '$Password';";
    $result = mysqli_query($connect, $phn_sql);
    $row = mysqli_fetch_assoc($result);
    $phn = $row['PHN'];
    $email = $row['EMAIL'];
    $emailStat = $row['EMAIL_STATUS'];

        if($emailStat == "not verified"){
            header("location: ../Landing.php?error=EmailNotVerified#loginForm");
        }

    session_start();
    $_SESSION['Uname'] = $Uname;
    $_SESSION['phone'] = $phn;
    $_SESSION['Email'] = $email;

    $sql = "SELECT * FROM users WHERE USERNAME = '$Uname' && PASSWORD = '$Password'";
    $query = mysqli_query($connect, $sql);

    if(mysqli_num_rows($query)){
        header("location: ../PAGES/profile.php?Logged");
    }else{
        header("location: ../Landing.php?error=NotInserted#loginForm");
    }

}else{
    header("location:../Landing.php?error=IllegalWay");
}

?>