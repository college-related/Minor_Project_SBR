<?php
    
    // data passed through GET method
    $tAmount = $_GET['amount']; // total amount
    $finePer = $_GET['fine']; // fine percentage
    $insMssg = $_GET['mssg']; // insurance message
    $fineAmount = $_GET['fineAmount']; // fine amount
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
    <!-- main wrapper div for qr page-->
        <div class="wrapper">
        <!-- div containing the qr image -->
            <div id="QrCode">
                <?php echo "<img src='QR.php?amount=$tAmount&fine=$finePer&mssg=$insMssg'>" ?>
            </div>
            <!-- div containing the form details -->
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
            <!-- div containing the fine details -->
            <div id="fine-detail">
                <h4>Amount Details</h4>
                <p>Your total amount will be Rs.<?= $tAmount ?></p>
                <p>You have <?= $finePer ?> fine, which is Rs.<?= $fineAmount ?></p>
            </div>
            <!-- div containing the insurance message -->
            <!-- TODO: make it more useful -->
            <div id="insurance-detail">
                <h4>Insurance Detail</h4>
                <p class="imp-insurance">
                    <?php 
                    // as the INS_SLIP column is in 10th index
                        if($array[0][10] == 'yes'){
                            echo "You must take the insurance slip with you.";
                        }else{
                            echo "You can either pay your insurance in any company or right outside the office.";
                        }
                    ?>
                </p>
            </div>
            <!-- Button div for going back to profile page -->
            <div id="button-layout">
            <!-- TODO: add a download system -->
                <!--<a href="<?php echo $urlPath; ?>"><button id="download-btn">Download</button></a>-->
                <a href="../PAGES/profile.php?Logged"><button id="goback-btn">Go Home</button></a>
            </div>
        </div>
    </main>
</body>
</html>