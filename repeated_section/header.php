<?php
    $pageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
?>

<div class="container">
    <header class="flex">
        <div class="flex">
            <span class="logo">
                <a href="http://localhost/MINOR_PROJECT_SBR/index.php">
                    SBR
                </a>
            </span>
            <nav class="nav">
                <ul class="nav-list">
                    <?php include('navMenu.php'); ?>
                    <?php if(isset($_SESSION['uId'])) {?>
                        <a href="http://localhost/MINOR_PROJECT_SBR/PHP/logout.php">
                            <button class="btn btn-primary btn-rounded nav-btn"><?=$lang['header']['log-out-text']?></button>
                        </a>
                    <?php } else {?>
                        <?php 
                            if($pageName == 'taxCalculator.php' || $pageName == 'information.php'){
                                $link = 'http://localhost/MINOR_PROJECT_SBR/index.php#form-wrapper';
                            }else{
                                $link = '#form-wrapper';
                            } 
                        ?>
                        <a href="<?= $link ?>">
                            <button class="btn btn-primary btn-rounded nav-btn"><?=$lang['header']['log-in-text']?></button>
                        </a>
                    <?php } ?>
                </ul>
            </nav>
        </div>
        <div class="settings-widget">
            <span class="language-setting"><a href="?lang=en">EN</a> | <a href="?lang=np">ने</a></span>
            <span class="theme-setting">
                <i class="far fa-moon"></i>
            </span>
        </div>
    </header>
</div>

