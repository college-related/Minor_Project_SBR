<?php 
    session_start(); 

    $uId = $_SESSION['uId'];

    require('../../PHP/includes/connection.php');
    include('../../PHP/includes/table_columns_name.php');
    include('../../PHP/includes/encryption.php');

    $command = "SELECT * FROM users WHERE uId=$uId";
    $execute = mysqli_query($connect, $command);
    $row = mysqli_fetch_assoc($execute);

    $str = '/6G6F;WvK7;s{au/6G6F;WvK7;s{au';
    $key = md5($str);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>

    <link rel="stylesheet" href="../../CSS/new-css/style.css">
    <link rel="stylesheet" href="../../CSS/new-css/admin-profile.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body>
    <?php include('../../repeated_section/header.php') ?>

    <main>
        <div class="container">
            <div class="row-3 main-holder">
                <div class="profile-photo-wrapper">
                    <div id="add-photo" >
                        <div class="profile-image">
                            <?php
                                if($row[$image_column] == null){
                                    echo "";
                                }else{
                                    echo "<img src='../../ASSETS/upload/$row[$image_column]' alt='profile picture' id='profile_picture'>";
                                }
                            ?>
                        </div>
                        <div class="image-adder-btn">
                            <div>
                                <form action='../../PHP/handleImage.php' method='POST' enctype='multipart/form-data'>
                                    <input type='file' name='img' onchange='this.form.submit();' id='image_adder'>
                                    <label for='image_adder'>
                                        <i class='far fa-image'> </i> 
                                        <span class="tooltip" id="add-image">Upload image</span> 
                                    <lable>
                                </form>
                            </div>
                            <div>
                                <form action="../../PHP/deleteImage.php" id="delete-image-form" method="POST">
                                    <label for="image-remover" onclick="submitForm()">
                                        <i class="fas fa-user-times"></i>
                                        <span class="tooltip" id="delete-image">Delete image</span>
                                    </label>
                                <input type="hidden" value="delete" name="delete-btn">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="information-holder col-2">
                    <h2>Personal Information</h2>
                    <hr class="hr">
                    <div class="info">
                        <p>
                            <b>Name:  </b> <?= $row[$username_column] ?>
                        </p>
                        <p>
                            <b>Email: </b> <?= decryptData($row[$email_column], $key) ?>
                        </p>
                        <p>
                            <b>Phone Number: </b> <?= $row[$phoneNumber_column] ?>
                        </p>
                    </div>
                    <h2>Password</h2>
                    <div class="reset-form--holder">
                        <form action="../../PHP/admin/resetPassword.php" method="POST">
                            <div class="row-5">
                                <div class="col-2">
                                    <input type="password" name="password" class="form-field" placeholder="Leave to keep the current password">
                                </div>
                                <div class="col-3">
                                    <input type="submit" value="Reset Password" name="reset-pass" class="btn btn-secondary btn-reset">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function submitForm()
        {
            document.getElementById('delete-image-form').submit()
        }
    </script>

    <script src="../../JS/new-js/mobile-menu.js"></script>
    <script src="../../JS/new-js/theme.js"></script>
</body>
</html>