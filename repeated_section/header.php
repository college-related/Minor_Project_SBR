<?php
    $pageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
?>

<div class="container">
    <header class="flex">
        <div class="flex">
            <span class="logo">SBR</span>
            <nav class="nav">
                <ul class="nav-list">
                    <?php include('navMenu.php'); ?>
                    <?php if(isset($_SESSION['uId'])) {?>
                        <a href="http://localhost/MINOR_PROJECT_SBR/PHP/logout.php">
                            <button class="btn btn-primary btn-rounded nav-btn">Log Out</button>
                        </a>
                    <?php } else {?>
                        <a href="#form-wrapper">
                            <button class="btn btn-primary btn-rounded nav-btn">Log In</button>
                        </a>
                    <?php } ?>
                </ul>
            </nav>
        </div>
        <div class="settings-widget">
            <span class="language-setting">EN | NP</span>
            <span class="theme-setting">
                <i class="far fa-moon"></i>
            </span>
        </div>
    </header>
</div>

<div class="mobile-nav">
    <div class="mobile-nav-lines">
        <div class="line-1"></div>
        <div class="line-2"></div>
        <div class="line-3"></div>
    </div>
</div>
<div class="mobile-menu">
    <div class="mobile-close-mark">&times;</div>
    <?php include('navMenu.php'); ?>
    <?php if(isset($_SESSION['uId'])) {?>
        <a href="http://localhost/MINOR_PROJECT_SBR/PHP/logout.php" class="btn-mobile">
            Log Out
        </a>
    <?php } else {?>
        <a href="#form-wrapper" class="btn-mobile" id="mobile-log">
            Log In
        </a>
    <?php } ?>
</div>