<?php
    
    $tAmount = $_GET['amount'];
    $finePer = $_GET['fine'];
    $insMssg = $_GET['mssg'];
    $fineAmount = $_GET['fineAmount'];
    // $urlPath = $_GET['path'];
    
    require 'connection.php';
    
    session_start();
    
    $ph = $_SESSION['phone'];
    
    $sql = "SELECT * FROM form WHERE PHN = '$ph';";
    $query = mysqli_query($connect, $sql);
    $array = mysqli_fetch_all($query);
    
    // print_r($array);
    // die();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Page</title>

    <link rel="stylesheet" href="../CSS/QRPage.css">

</head>
<body>
    <main>
        <div class="wrapper">
            <div id="QrCode">
                <?php echo "<img src='QR.php?amount=$tAmount&fine=$finePer&mssg=$insMssg'>" ?>
            </div>
            <div id="form">
                <h4>Form Details</h4>
                <div id="table">
                    <?php foreach($array as $data) { ?>
                    <table>
                        <tr>
                            <td> Name: </td>
                            <td>
                                <?= $data[1] ?>
                            </td>
                        </tr>
                        <tr>
                            <td> Phone no:</td>
                            <td>
                                <?= $data[0] ?>
                            </td>
                        </tr>
                        <tr>
                            <td> Vehicle type:</td>
                            <td>
                                <?= $data[2] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Engine CC:</td>
                            <td>
                                <?= $data[4] ?>
                            </td>
                        </tr>
                        <tr>
                            <td> Registration number:</td>
                            <td>
                                <?= $data[5] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Last renew date:</td>
                            <td>
                                <?= $data[6] ?>
                            </td>
                        </tr>
                    </table>
                    <?php } ?>
            </div>
            </div>
            <div id="fine-detail">
                <h4>Amount Details</h4>
                <p>Your total amount will be Rs.<?= $tAmount ?></p>
                <p>You have <?= $finePer ?> fine, which is Rs.<?= $fineAmount ?></p>
            </div>
            <div id="insurance-detail">
                <h4>Insurance Detail</h4>
                <p class="imp-insurance">
                    <?php 
                        if($array[0][10] == 'yes'){
                            echo "You must take the insurance slip with you.";
                        }else{
                            echo "You can either pay your insurance in any company or right outside the office.";
                        }
                    ?>
                </p>
            </div>
            <div id="button-layout">
                <!--<a href="<?php echo $urlPath; ?>"><button id="download-btn">Download</button></a>-->
                <a href="../PAGES/profile.php?Logged"><button id="goback-btn">Go Home</button></a>
            </div>
        </div>
    </main>
</body>
</html>