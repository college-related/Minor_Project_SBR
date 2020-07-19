<?php
    $connect = mysqli_connect("localhost", "root", "", "sbr_db");

    if(!$connect){
        echo "Not Connected successfully !!!";
        die();
    }
?>