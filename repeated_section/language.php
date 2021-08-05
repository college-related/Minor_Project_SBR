<?php

$pageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

if(!isset($_SESSION['lang']))
    $_SESSION['lang'] = "en";
elseif(isset($_GET['lang']) && !empty($_GET['lang']) && $_SESSION['lang'] != $_GET['lang']){
    $_SESSION['lang'] = $_GET['lang'];
}

$url = $_SESSION['lang'];

if($pageName == 'index.php' || $pageName == 'register.php'){
    $path = './';
}elseif($pageName == 'forgetPassword.php' || $pageName == 'resetPassword.php'
         || $pageName == 'profileEdit.php' || $pageName == 'profile.php'||
        $pageName == 'taxCalculator.php' || $pageName == 'information.php'
        || $pageName == 'form.php' || $pageName == 'QRPage.php'){
    $path = '../';
}elseif($pageName == 'details.php' || $pageName == 'user-detail.php' || $pageName == 'admin-profile.php'){
    $path = "../../";
}

require($path.'Language/'.$url.'.php');