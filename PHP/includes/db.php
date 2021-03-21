<?php

$conn = new mysqli("localhost", "root", "");

// $conn->query('DROP DATABASE myDB');

// connecting to localhost
if($conn->connect_error){
    die('connection failed: '.$conn->connect_error);
}else{

    // using the database if database present
    $selectDB = "USE sbr_db";
    
    // creating the database if database not present
    if($conn->query($selectDB) === FALSE){
        $createDB = "CREATE DATABASE sbr_db";

        if($conn->query($createDB) === FALSE){
            die('some error while creating database');
        }
    }

    // connecting to the database in the localhost
    $con = new mysqli("localhost", "root", "", "sbr_db");

    if($con->connect_error){
        die("Unable to connect to database");
    }

    // checking if users table already exits
    $checkUserTable = "SELECT * FROM users";

    // creating a new users table if not present already
    if($con->query($checkUserTable) === FALSE){
        $createUserTable = 
            "CREATE TABLE users(
                uId int auto_increment primary key,
                name varchar(50) not null,
                email text not null unique,
                phone_number text not null unique,
                citizenship_number text not null unique,
                password text not null,
                email_verified enum('verified', 'not verified') not null,
                activation_code text not null,
                created_at timestamp,
                profile_image_name varchar(100)
            );
            ";
        
        if($con->query($createUserTable) === FALSE){
            die("Error while creating users table".$con->error_log);
        }
    }

    // checking if vehicles_data table is present
    $checkVehicleTable = "SELECT * FROM vehicles_data";

    // creating vehicles_data table if not already present
    if($con->query($checkVehicleTable) === FALSE){
        $createVehicleTable = 
            "CREATE TABLE vehicles_data(
                vId int auto_increment primary key,
                uId int not null,
                vehicle_type enum('two wheeler', 'four wheeler') not null,
                vehicle_category enum('A','B','K') not null,
                engine_cc varchar(100) not null,
                vehicle_registration_number text not null unique,
                public_private enum('public','private') not null,
                created_at timestamp,
                FOREIGN KEY (uId) REFERENCES users(uId)
            );
            ";

        if($con->query($createVehicleTable) === FALSE){
            die('Error while creating vehicle table');
        }
    }

    $checkFormsTable = "SELECT * FROM forms_data";

    if($con->query($checkFormsTable) === FALSE){
        $createFormsTable = 
            "CREATE TABLE forms_data(
                fId int auto_increment primary key,
                uId int,
                name varchar(50) not null,
                citizenship_number text not null,
                phone_number text not null,
                vehicle_type enum('two wheeler','four wheeler') not null,
                vehicle_category enum('A','B','K') not null,
                engine_cc varchar(100) not null,
                public_private enum('public', 'private') not null,
                insurance_slip enum('yes', 'no') not null,
                vehicle_registration_number text not null,
                last_renew_date date not null,
                created_at timestamp,
                form_filled_by varchar(50) not null,
                form_filler_vehicle_registration_number text not null,
                form_filler_phone_number text not null,
                form_filler_uId int not null,
                FOREIGN KEY (form_filler_uId) REFERENCES users(uId)
            );
            ";

        if($con->query($createFormsTable) === FALSE){
            die('Error while creating forms table');
        }
    }

    $checkTaxTable = "SELECT * FROM tax_details";

    if($con->query($checkTaxTable) === FALSE){
        $createTaxTable = 
            "CREATE TABLE tax_details(
                tId int auto_increment primary key,
                uId int,
                tax_amount varchar(100) not null,
                fine_amount varchar(100) not null,
                fine_percentage varchar(50) not null,
                paid_in varchar(100) not null,
                total_amount varchar(100) not null,
                created_at timestamp,
                filler_uId int not null,
                FOREIGN KEY (filler_uId) REFERENCES users(uId)
            );
            ";

        if($con->query($createTaxTable) === FALSE){
            die("Error while creating tax table");
        }
    }
}

?>
