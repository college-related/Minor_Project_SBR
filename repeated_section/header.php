<?php
    $pageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
?>

<div class="container">
    <header class="flex">
        <div class="flex">
            <span class="logo">SBR</span>
            <nav class="nav">
                <ul class="nav-list">
                    <?php if(isset($_SESSION['uId']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
                        <li><a href="http://localhost/MINOR_PROJECT_SBR/PAGES/admin/details.php" class='<?php if($pageName == "details.php") { echo "active-link"; } ?>'>Details</a></li>
                        <li><a href="http://localhost/MINOR_PROJECT_SBR/PAGES/admin/profile.php" class='<?php if($pageName == "profile.php") { echo "active-link"; } ?>'>Profile</a></li>
                    <?php }else {?>
                        <li><a href="http://localhost/MINOR_PROJECT_SBR/PAGES/taxCalculator.php" class='<?php if($pageName == "taxCalculator.php") { echo "active-link"; } ?>'>Tax Calculator</a></li>
                        <li><a href="http://localhost/MINOR_PROJECT_SBR/PAGES/information.php" class='<?php if($pageName == "information.php") { echo "active-link"; } ?>'>Info</a></li>
                        <?php if(isset($_SESSION['uId'])) { ?>
                            <li><a href="http://localhost/MINOR_PROJECT_SBR/PAGES/form.php" class='<?php if($pageName == "form.php") { echo "active-link"; } ?>'>Form</a></li>
                            <li><a href="http://localhost/MINOR_PROJECT_SBR/PAGES/profile.php" class='<?php if($pageName == "profile.php") { echo "active-link"; } ?>'>Profile</a></li>
                        <?php } ?>
                    <?php } ?>
                    <!-- <li> -->
                    <?php if(isset($_SESSION['uId'])) {?>
                        <a href="http://localhost/MINOR_PROJECT_SBR/PHP/logout.php" class="btn btn-primary btn-rounded nav-btn">
                            Log Out
                        </a>
                    <?php } else {?>
                        <a href="#form" class="btn btn-primary btn-rounded nav-btn">
                            Log In
                        </a>
                    <?php } ?>
                    <!-- </li> -->
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