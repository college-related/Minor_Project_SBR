<?php
    
    include("./includes/encryption.php");

    // * data passed through GET method
    $tAmount = $_GET['amount']; // total amount
    $finePer = $_GET['fine']; // fine percentage
    $insMssg = $_GET['mssg']; // insurance message
    $fineAmount = $_GET['fineAmount']; // fine amount
    // $urlPath = $_GET['path'];
    
    require "./includes/connection.php";
    include("./includes/table_columns_name.php");

    session_start();
    
    $uId = $_SESSION['uId'];
    
    $sql = "SELECT * FROM forms_data WHERE $formFillerId_column = '$uId' ORDER BY $formID_column DESC LIMIT 1";
    $query = mysqli_query($connect, $sql);
    $data = mysqli_fetch_all($query, MYSQLI_ASSOC);

    // * Generating key for encryption
    $str = "j-{b\b{Prd(.w4:Zj-{b\b{Prd(.w4:Z";
    $key = md5($str);

    if(isset($_GET['updated'])){
        $title = 'Updated';
        $icon = '<i class="far fa-grin-beam fa-2x"></i>';
        $mssg = 'Your data is updated successfully';
    }

    include('../repeated_section/language.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Page</title>

    <!-- <link rel="stylesheet" href="../CSS/QRPage.css"> -->
    <link rel="stylesheet" href="../CSS/new-css/style.css">
    <link rel="stylesheet" href="../CSS/new-css/admin-details.css">
    <link rel="stylesheet" href="../CSS/new-css/qr.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

</head>
<body>
    <?php include('../repeated_section/header.php') ?>

    <?php
        if(isset($_GET['updated'])){
            include('../repeated_section/success.php');
        }
    ?>

    <main>
        <div class="container">
            <div class="main-holder">
                <div class="row-3">
                    <div class="qr-holder text-center">
                        <?php echo "<img src='QR.php?amount=$tAmount&fine=$fineAmount&mssg=$insMssg'>"; ?>
                        <?php if($data[0][$insurance_column] == 'yes'){ ?>
                            <div class="ins-mssg text-success">
                                <?=$lang['qr-page']['slip-text-1']?>
                            </div>
                        <?php }else{ ?>
                            <div class="ins-mssg text-danger">
                                <?=$lang['qr-page']['slip-text-2']?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-2">
                        <div class="form-info--holder">
                            <h2><?=$lang['qr-page']['h1-text-1']?></h2>
                            <hr class="hr">
                            <div class="row-2 more-holder">
                                <div class="info-holders">
                                    <p><b><?=$lang['qr-page']['info-texts'][0]?>: </b><?=$data[0][$username_column]?></p>
                                    <p><b><?=$lang['qr-page']['info-texts'][1]?>: </b><?=decryptData($data[0][$phoneNumber_column], $key)?></p>
                                    <p><b><?=$lang['qr-page']['info-texts'][2]?>: </b><?=decryptData($data[0][$citizenship_column], $key)?></p>
                                    <p><b><?=$lang['qr-page']['info-texts'][3]?>: </b><?=$data[0][$renewDate_column]?></p>
                                </div>
                                <div class="info-holders">
                                    <p><b><?=$lang['qr-page']['info-texts'][4]?>: </b><?=decryptData($data[0][$vehicleRegistration_column], $key)?></p>
                                    <p><b><?=$lang['qr-page']['info-texts'][5]?>: </b><?=$data[0][$vehicleType_column]?></p>
                                    <p><b><?=$lang['qr-page']['info-texts'][6]?>: </b><?=$data[0][$vehicleCategory_column]?></p>
                                    <p><b><?=$lang['qr-page']['info-texts'][7]?>: </b><?=$data[0][$engineCC_column]?></p>
                                </div>
                            </div>
                            <h2><?=$lang['qr-page']['h1-text-2']?></h2>
                            <hr class="hr">
                            <div class="row-2 more-holder">
                                <div class="info-holders">
                                    <p><b><?=$lang['qr-page']['form-texts'][0]?>: </b> <?=$_GET['amount']?></p>
                                    <p><b><?=$lang['qr-page']['form-texts'][1]?>: </b><?=$_GET['fine']?></p>
                                </div>
                                <div class="info-holders">
                                    <p><b><?=$lang['qr-page']['form-texts'][2]?>: </b><?=$_GET['fineAmount']?></p>
                                    <p><b><?=$lang['qr-page']['form-texts'][3]?>: </b><?=$_GET['amount']+$_GET['fineAmount']?></p>
                                </div>
                            </div>
                            <h3><?=$lang['qr-page']['miss-text']?>? <a href="../PAGES/form.php?fId=<?=$data[0]['fId']?>&tId=<?=$_GET['tId']?>&others=<?=$_GET['other']?>"><?=$lang['qr-page']['link-text']?></a></h3>
                        </div>
                        <div id="button-layout">
                        <!-- TODO: add a download system -->
                            <a href="<?php echo 'QR.php?amount='.$tAmount.'&fine='.$fineAmount.'&mssg='.$insMssg; ?>" download="QR"><button class="btn btn-secondary btn-reset">Download <i class="fas fa-download"></i></button></a>
                            <a href="../PAGES/profile.php"><button class="btn btn-secondary btn-reset"><?=$lang['qr-page']['btn-text']?></button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include('../repeated_section/mobile-header.php') ?>

    <script>
        // function closeErrorPopUp(){
        //     document.getElementsByClassName('error-popup')[0].style.display = 'none';
        // }
        function closesuccessPopUp(){
            document.getElementsByClassName('success-popup')[0].style.display = 'none';
        }
    </script>
    <script src="../JS/new-js/theme.js"></script>
    <script src="../JS/new-js/mobile-menu.js"></script>
</body>
</html>