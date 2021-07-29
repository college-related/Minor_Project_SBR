<?php

$full_url = 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
$pageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
$dir = dirname($full_url);

if(!isset($_SESSION['lang']))
    $_SESSION['lang'] = "en";
elseif(isset($_GET['lang']) && !empty($_GET['lang']) && $_SESSION['lang'] != $_GET['lang']){
    $_SESSION['lang'] = $_GET['lang'];
}

$url = $_SESSION['lang'];

if($pageName == 'index.php' || $pageName == 'register.php'){
    $path = './';
}elseif($pageName == 'forgetPassword.php' || $pageName == 'resetPassword.php'
         || $pageName == 'profileEdit.php' ||
        $pageName == 'taxCalculator.php' || $pageName == 'information.php'
        || $pageName == 'form.php'){
    $path = '../';
}elseif($pageName == 'details.php' || $pageName == 'user-detail.php'){
    $path = "../../";
}elseif($pageName == 'profile.php'){
    if($dir == 'http://localhost/MINOR_PROJECT_SBR/PAGES/admin')
        $path = "../../";
    else
        $path = "../";
}

require($path.'Language/'.$url.'.php');