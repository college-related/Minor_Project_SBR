<?php

    // * Connecting to the database
    $connect = mysqli_connect("localhost", "root", "", "sbr_db");
    
    // * checking if the database connection fails
    if(!$connect){
        echo "Not Connected successfully !!!";
        die();
    }
?>