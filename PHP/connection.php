<?php
    $connect = mysqli_connect("localhost", "root", "", "");

    if(!$connect){
        echo "Not Connected successfully !!!";
        die();
    }
?>