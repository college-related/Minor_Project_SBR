<?php

    include("../PHP/includes/encryption.php");
    
    session_start();

    if(!isset($_SESSION['uId'])){
        header("location: ../index.php?NotLogged");
        session_destroy();
    }

    require "../PHP/includes/connection.php";
    include("../PHP/includes/table_columns_name.php");

    $uId = $_SESSION['uId'];

    $sql_info = "SELECT users.*, vehicles_data.* FROM users JOIN vehicles_data ON users.uId=vehicles_data.uId WHERE users.uId='$uId' && vehicles_data.uId='$uId'";
    $info_result = mysqli_query($connect, $sql_info);

    $infoarray = mysqli_fetch_all($info_result, MYSQLI_ASSOC);

    $str = "/6G6F;WvK7;s{au/6G6F;WvK7;s{au";
    $key = md5($str);

    $sql_form = "SELECT * FROM forms_data WHERE $formFillerId_column='$uId';";
    $form_result = mysqli_query($connect, $sql_form);

    $sql_tax="SELECT * FROM tax_details WHERE $fillerId_column ='$uId';";
    $tax_result=mysqli_query($connect,$sql_tax);

    if($infoarray[0][$image_column] != null){
        $img = $infoarray[0][$image_column];
        $image_src = "../ASSETS/upload/" . $img;
    }

    $formArray = mysqli_fetch_all($form_result,MYSQLI_ASSOC);

    $taxArray = mysqli_fetch_all($tax_result,MYSQLI_ASSOC);
    $vcat = $infoarray[0][$vehicleCategory_column];
    $enginecc = $infoarray[0][$engineCC_column];

    $taxHistoryPaginate = count($taxArray) - 4;
    if($taxHistoryPaginate < 0){
        $taxHistoryPaginate = 0;
    }
    if(isset($_GET['thp'])){$taxHistoryPaginate = $_GET['thp'];}
    if(isset($_GET['pagination']))
    {
        $taxHistoryPaginate = $taxHistoryPaginate - $_GET['pagination'];
    }
    $paginate =  $taxHistoryPaginate;
    if($paginate > 2){
        $paginate = 2;
    }

    include('../repeated_section/language.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <link rel="stylesheet" href="../CSS/new-css/style.css">
    <link rel="stylesheet" href="../CSS/new-css/admin-profile.css">
    <link rel="stylesheet" href="../CSS/new-css/profile.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
   
</head>
<body>
    <?php include('../repeated_section/header.php')?>
   
    <main>
    <div class="container">
    <div class="main-holder row-3">
        <div class="photo-section">
            <div class="profile-photo-wrapper text-center">
                <div id="add-photo" >
                    <div class="profile-image">
                        <?php
                            if($infoarray[0][$image_column] == null){
                                echo "";
                            }else{
                                echo "<img src='$image_src' alt='profile picture' id='profile_picture'>";
                            }
                        ?>
                    </div>
                </div>
                <div class="editBtn row-">
                    <a href="./profileEdit.php" class="desktop-edit--btn"><input type="button" value="<?=$lang['profile-page']['btn-text-two']?>" class="btn btn-secondary btn-mobile btn-reset" ></a>
                </div>
            </div>
                <a href="./profileEdit.php" class="mobile-edit--btn"> <i class="far fa-edit"></i></a>
            </div>
    <div class="col-2 ">
        <div class="information-holder">
            <h2><?=$lang['profile-page']['h1-text']?></h2>
            <hr class="hr">
            <div class="row-2 info">
                <div>
                    <p>
                        <b><?=$lang['profile-page']['form-texts'][0]?>:  </b> 
                        <?php
                            echo $infoarray[0][$username_column]; 
                        ?>
                    </p>
                    <p>
                        <b><?=$lang['profile-page']['form-texts'][1]?>: </b>
                        <?php 
                            
                            if(empty($infoarray)){
                                echo "???";
                            }else{
                                echo decryptData($infoarray[0][$email_column],$key);
                            }
                            
                            ?>
                    </p>
                    <p>
                        <b><?=$lang['profile-page']['form-texts'][2]?>: </b> 
                        <?php 
                            
                            if(empty($infoarray)){
                                echo "???";
                            }else{
                                echo decryptData($infoarray[0][$phoneNumber_column],$key);
                            }
                            
                            ?>
                    </p>
                    <p>
                        <b><?=$lang['profile-page']['form-texts'][3]?>:  </b>  
                        <?php
                                    if(empty($infoarray)){
                                        echo "???";
                                    }else{
                                        echo decryptData($infoarray[0][$citizenship_column],$key);
                                    }
                                ?>
                    </p>
                    
                </div>
                <div>
                <p>
                    <b><?=$lang['profile-page']['form-texts'][4]?>:  </b>  
                    <?php
                                 if(empty($infoarray) || $infoarray[0][$vehicleRegistration_column] == ""){
                                    echo "???";
                                }else{
                                    echo decryptData($infoarray[0][$vehicleRegistration_column],$key);
                                }
                            ?>
                </p>
                <p>
                    <b><?=$lang['profile-page']['form-texts'][5]?>:  </b> 
                    <?php    
                                if(empty($infoarray) || $infoarray[0][$vehicleType_column] == ""){
                                    echo "???";
                                }else{
                                    echo $infoarray[0][$vehicleType_column];
                                }
                            ?>
                </p>
                <p>
                    <b><?=$lang['profile-page']['form-texts'][6]?>:  </b>  
                    <?php
                                if(empty($infoarray) || $infoarray[0][$vehicleCategory_column] == ""){
                                    echo "???";
                                }else{
                                    echo $infoarray[0][$vehicleCategory_column];
                                }
                            ?>
                </p>
                <p>
                    <b><?=$lang['profile-page']['form-texts'][7]?>:  </b>  
                    <?php
                                 if(empty($infoarray) || $infoarray[0][$engineCC_column] == ""){
                                    echo "???";
                                }else{
                                    echo $infoarray[0][$engineCC_column];
                                }
                            ?>
                </p>
                </div>
            </div>
            
        </div>
        <div class="information-holder">
            <h2><?=$lang['profile-page']['h1-text-two']?></h2>
            <hr class="hr">
            <div class="profile-detail-section tax-detail info">
                <?php if(count($taxArray) > 0){  ?>
                <div id="tax-h" class="tax-history">
                    
                    <?php for($i=count($taxArray) - 1; $i >= $taxHistoryPaginate; $i--) { ?>
                        <div class="main-holder tax-holder">
                            <div class="year-amount">
                                <?= strtok($taxArray[$i][$createdAt_column],'-') ?>
                            </div>
                            <div class="fine-amount-holder">
                                <div class="fine <?php if($taxArray[$i][$finePercentage_column] != '0%'){ echo 'text-danger';} ?>">
                                    <?= $taxArray[$i][$finePercentage_column] ?> Fine</div>
                                <div class="year-amount">Rs 
                                    <?= $taxArray[$i][$taxAmount_column] ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php if($paginate >= 1){ ?> 
                    <a href="http://localhost/MINOR_PROJECT_SBR/PAGES/profile.php?Logged&pagination=<?=$paginate ?>&thp=<?=$taxHistoryPaginate ?>#tax-h">
                        <button class="btn btn-secondary btn-mobile btn-reset"><?=$lang['profile-page']['btn-text-one']?></button>
                    </a> <?php } 
                ?>
                <?php } else { ?>
                <div class="text-center"> 
                    <h3>No Tax History</h3> 
                </div>
                <?php } ?>
            </div>
        </div>
        </div>
    </div>
    </div>
                    </div>
    </main>

    <?php include('../repeated_section/mobile-header.php')?>
    <?php include '../repeated_section/footer.html' ?>
    <script src="../JS/new-js/theme.js"></script>
    <script src="../JS/new-js/mobile-menu.js"></script>
 
</body>
</html>