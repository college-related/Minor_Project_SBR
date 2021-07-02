
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