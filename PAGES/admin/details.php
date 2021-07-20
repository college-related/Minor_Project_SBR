<?php 
    session_start(); 
    require('../../PHP/includes/connection.php');
    include('../../PHP/includes/table_columns_name.php');
    include('../../PHP/includes/encryption.php');

    $str = "/6G6F;WvK7;s{au/6G6F;WvK7;s{au";
    $key = md5($str);
    
    if(isset($_GET['keyword']) && $_GET['keyword'] != ''){
        $keyword = trim($_GET['keyword']);

        $command = "SELECT * FROM users WHERE $username_column LIKE '%$keyword%' AND $role_column != 'admin'";
        $execute = mysqli_query($connect, $command);

        $users = mysqli_fetch_all($execute, MYSQLI_ASSOC);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>

    <link rel="stylesheet" href="../../CSS/new-css/style.css">
    <link rel="stylesheet" href="../../CSS/new-css/admin-details.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body>
    <?php include('../../repeated_section/header.php') ?>

    <main>
        <div class="container">
            <div class="top-title">
                <h1>Search User Details</h1>
                <hr class="hr">
            </div>
            <div class="search-holder">
                <div class="row-6">
                    <div class="col-2">
                        <form action="" method="get" autocomplete="off">
                            <div class="form-holder justify-center">
                                <div class="input-holder">
                                    <input type="text" name="keyword" placeholder="Search" class="form-field">
                                </div>
                                <div class="text-center justify-center">
                                    <button type="submit" class="btn btn-primary btn-rounded">Search <i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="users-holder">
                <?php
                    if(isset($users)){ 
                        if(count($users) > 0){
                        foreach($users as $user) { 
                ?>
                        <div class="user-wrapper">
                            <div class="user-top justify-center">
                                <div class="user-image-wrapper">
                                    <?php if($user[$image_column] != null) {?>
                                        <img src="../../ASSETS/upload/<?=$user[$image_column]?>" alt="">
                                    <?php } ?>
                                </div>
                                <div class="user-name text-center">
                                    <b><?=$user[$username_column]?></b>
                                </div>
                            </div>
                            <div class="user-details">
                                <table>
                                    <tr>
                                        <th>Email:</th>
                                        <td><?=decryptData($user[$email_column], $key)?></td>
                                    </tr>
                                    <tr>
                                        <th>Phone:</th>
                                        <td><?=decryptData($user[$phoneNumber_column], $key)?></td>
                                    </tr>
                                    <tr>
                                        <th>Citizenship:</th>
                                        <td><?=decryptData($user[$citizenship_column], $key)?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="more-holder text-center">
                                <a href="#">
                                    <button class="btn btn-secondary btn-reset">More Info</button>
                                </a>
                            </div>
                        </div>
                <?php } }else{ ?>
                    <h2>No users found</h2>
                <?php } }?>
            </div>
        </div>
    </main>

    <?php include('../../repeated_section/mobile-header.php') ?>

    <script src="../../JS/new-js/mobile-menu.js"></script>
    <script src="../../JS/new-js/theme.js"></script>
</body>
</html>