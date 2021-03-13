<?php
    
    function decryptData($data, $key){
        $encryption_key = base64_decode($key);
        list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
        $decryptedData = openssl_decrypt($encrypted_data, "aes-256-cbc", $encryption_key, 0, $iv);

        return $decryptedData;
    }

    // data passed through GET method
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

    $str = "j-{b\b{Prd(.w4:Zj-{b\b{Prd(.w4:Z";
    $key = md5($str);
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
                    <table>
                        <tr>
                            <td> Name: </td>
                            <td>
                                <?= $data[0][$username_column] ?>
                            </td>
                        </tr>
                        <tr>
                            <td> Phone no:</td>
                            <td>
                                <?= decryptData($data[0][$phoneNumber_column], $key); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Citizenship Number:</td>
                            <td>
                                <?= decryptData($data[0][$citizenship_column], $key); ?>
                            </td>
                        </tr>
                        <tr>
                            <td> Vehicle type:</td>
                            <td>
                                <?= $data[0][$vehicleType_column] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Engine CC:</td>
                            <td>
                                <?= $data[0][$engineCC_column] ?>
                            </td>
                        </tr>
                        <tr>
                            <td> Registration number:</td>
                            <td>
                                <?= decryptData($data[0][$vehicleRegistration_column], $key); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Last renew date:</td>
                            <td>
                                <?= $data[0][$renewDate_column] ?>
                            </td>
                        </tr>
                    </table>
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
                        if($data[0][$insurance_column] == 'yes'){
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