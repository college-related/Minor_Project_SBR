<?php 
    session_start(); 
    include('../repeated_section/language.php');    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information</title>
    <link rel="stylesheet" href="../CSS/new-css/color.css">
    <link rel="stylesheet" href="../CSS/new-css/style.css">
    <link rel="stylesheet" href="../CSS/new-css/infopage.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script defer src="../JS/new-js/info_height.js"></script>
</head>
<body>
    <?php include("../repeated_section/header.php") ?>
    <main class="container ">
        <div class="row-2 main-div-holder">
            <div class="info-holder col-1 show">
                <div class="info-title-holder">
                    <button class="font-bold icon active"><?=$lang['info-page']['titles'][0]?></button>
                </div>
                <div class="info-body-holder">
                    <?=$lang['info-page']['descriptions'][0]?>
                </div>
            </div>
            <div class="info-holder col-1 show">
                <div class="info-title-holder">
                    <button class="font-bold icon active"><?=$lang['info-page']['titles'][1]?></button>
                </div>
                <div class="info-body-holder">
                    <?=$lang['info-page']['descriptions'][1]?>
                </div>
            </div>
            <div class="info-holder col-1 show" >
                <div class="info-title-holder">
                    <button class="font-bold icon active"><?=$lang['info-page']['titles'][2]?></button>
                </div>
                <div class="info-body-holder ">
                    <?=$lang['info-page']['descriptions'][2]?>
                </div>
            </div>
            <div class="info-holder col-1 ">
                <div class="info-title-holder">
                    <button class="font-bold icon"><?=$lang['info-page']['titles'][3]?></button>                          
                </div>
                <div class="info-body-holder">
                    <?=$lang['info-page']['descriptions'][3]?>
                </div>
            </div>
            <div class="info-holder col-1 ">
                <div class="info-title-holder">
                    <button class="font-bold icon"><?=$lang['info-page']['titles'][4]?></button>                            
                </div>
                <div class="info-body-holder">
                    <?=$lang['info-page']['descriptions'][4]?>
                </div>
            </div>
            <div class="info-holder col-1">
                <div class="info-title-holder">
                    <button class="font-bold icon"><?=$lang['info-page']['titles'][5]?>?</button>      
                </div>
                <div class="info-body-holder">
                    <?=$lang['info-page']['descriptions'][5]?>                
                </div>
            </div>
            <div class="info-holder col-1">
                <div class="info-title-holder">
                    <button class="font-bold icon"><?=$lang['info-page']['titles'][6]?></button>                 
                </div>
                <div class="info-body-holder">
                    <?=$lang['info-page']['descriptions'][6]?>                
                </div>
            </div>
            <div class="info-holder col-1">
                <div class="info-title-holder">
                    <button class="font-bold icon"><?=$lang['info-page']['titles'][7]?></button>                  
                </div>
                <div class="info-body-holder">
                    <?=$lang['info-page']['descriptions'][7]?>                
                </div>                
            </div>
            <div class="info-holder col-1">
                <div class="info-title-holder">
                    <button class="font-bold icon"><?=$lang['info-page']['titles'][8]?></button>                 
                </div>
                <div class="info-body-holder">
                    <?=$lang['info-page']['descriptions'][8]?>                
                </div>                
            </div>
            <div class="info-holder col-1">
                <div class="info-title-holder">
                    <button class="font-bold icon"><?=$lang['info-page']['titles'][9]?></button>                 
                </div>
                <div class="info-body-holder">
                    <?=$lang['info-page']['descriptions'][9]?>                 
                </div>                
            </div>
        </div>
    </main>
    
    <?php include('../repeated_section/footer.html') ?>
    <?php include('../repeated_section/mobile-header.php')?>
    
    <script src="../JS/new-js/mobile-menu.js"></script>
    <script src="../JS/new-js/theme.js"></script>
    
</body>
</html>