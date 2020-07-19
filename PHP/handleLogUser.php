<?php

if(isset($_POST['login'])){
    require_once "./connection.php";

    $Uname = $_POST['Uname'];
    $Password = $_POST['Password'];
    
    session_start();
    $_SESSION['Uname'] = $Uname;

    $sql = "SELECT * FROM users WHERE USERNAME = '$Uname' && PASSWORD = '$Password'";
    $query = mysqli_query($connect, $sql);

    if(mysqli_num_rows($query)){
        header("location: ../PAGES/profile.php?Logged");
    }else{
        header("location: ../Landing.php");
    }

}else{
    header("location:../Landing.php?NotLogged");
}

?>