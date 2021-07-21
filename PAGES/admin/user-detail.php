<?php 
    session_start(); 
    require('../../PHP/includes/connection.php');
    include('../../PHP/includes/table_columns_name.php');
    include('../../PHP/includes/encryption.php');

    $str = "/6G6F;WvK7;s{au/6G6F;WvK7;s{au";
    $key = md5($str);
    
    $uId = $_GET['uId'];

    $command = "SELECT users.*, vehicles_data.* FROM users JOIN vehicles_data ON users.uId=vehicles_data.uId WHERE users.uId='$uId' && vehicles_data.uId='$uId'";
    $execute = mysqli_query($connect, $command);
    $row = mysqli_fetch_all($execute, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>

    <link rel="stylesheet" href="../../CSS/new-css/style.css">
    <link rel="stylesheet" href="../../CSS/new-css/admin-profile.css">
    <link rel="stylesheet" href="../../CSS/new-css/admin-details.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body>
    <?php include('../../repeated_section/header.php') ?>

    <main>
        <div class="container">
            <div class="row-5">
                <div class="main-holder col-2">
                    <div class="profile-photo-wrapper">
                        <div id="add-photo" >
                            <div class="profile-image">
                                <?php
                                    if($row[0][$image_column] == null){
                                        echo "";
                                    }else{
                                        echo "<img src='../../ASSETS/upload/$row[0][$image_column]' alt='profile picture' id='profile_picture'>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="name-holder text-center">
                        <h3><?=$row[0][$username_column]?></h3>
                        <a href="javascript:window.history.back();" class="btn btn-primary btn-reset">&larr; Go Back</a>
                    </div>
                </div>
                <div class="col-3 main-holder">
                    <h2>Personal Information</h2>
                    <hr class="hr">
                    <div class="infos">
                        <div class="info-holders">
                            <p><b>Email: </b> <?=decryptData($row[0][$email_column], $key)?></p>
                            <p><b>Phone number: </b> <?=decryptData($row[0][$phoneNumber_column], $key)?></p>
                            <p><b>Citizenship Number: </b> <?=decryptData($row[0][$citizenship_column], $key)?></p>
                            <p><b>Vehicle Registration Number: </b> <?=decryptData($row[0][$vehicleRegistration_column], $key)?></p>
                        </div>
                    </div>
                    <h2>Vehicle Data</h2>
                    <hr class="hr">
                    <div class="infos">
                        <div class="info-holders">
                            <p><b>Vehicle Type: </b> <?=$row[0][$vehicleType_column]?></p>
                            <p><b>Vehicle Name: </b> <?=$row[0][$vehicleCategory_column]?></p>
                            <p><b>Engine CC: </b> <?=$row[0][$engineCC_column]?></p>
                            <p><b>Public/Private: </b> <?=$row[0][$pp_column]?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include('../../repeated_section/mobile-header.php') ?>

    <script src="../../JS/new-js/mobile-menu.js"></script>
    <script src="../../JS/new-js/theme.js"></script>
</body>
</html>