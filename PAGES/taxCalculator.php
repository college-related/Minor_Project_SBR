<?php
    session_start();

    include('../repeated_section/language.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tax Calculator</title>
    
    <link rel="stylesheet" href="../CSS/new-css/style.css">
    <link rel="stylesheet" href="../CSS/new-css/tax-calculator.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="../JS/dist/mc-calendar.min.css">
</head>
<body>
    <?php include('../repeated_section/header.php') ?>

    <main>
        <div class="container">
            <div class="main-holder">
                <h2><?=$lang['taxCal-page']['top-text']?></h2>
                <div class="calculator-div row-2">
                    <form action="../PHP/calculator.php" method="post">
                        <div class="row-6 justify-center">
                            <div class="font-bold">
                                <label for=""><?=$lang['taxCal-page'][0]?>: </label>
                            </div>
                            <div class="col-5">
                                <input type="radio" value="2-wheeler" name="wheeler" class="wheeler-radio" id="2-wheeler" checked><label for="2-wheeler" class="tax-radio">Two Wheeler</label>
                                <input type="radio" value="3-wheeler" name="wheeler" class="wheeler-radio" id="3-wheeler"><label for="3-wheeler" class="tax-radio">Three Wheeler</label>
                                <input type="radio" value="4-wheeler" name="wheeler" class="wheeler-radio" id="4-wheeler"><label for="4-wheeler" class="tax-radio">Four Wheeler</label>
                                <input type="radio" value="6-wheeler" name="wheeler" class="wheeler-radio" id="6-wheeler"><label for="6-wheeler" class="tax-radio">Six Wheeler</label>
                                <input type="radio" value="8-wheeler" name="wheeler" class="wheeler-radio" id="8-wheeler"><label for="8-wheeler" class="tax-radio">Eight Wheeler</label>
                            </div>
                        </div>
                        <div class="row-6 justify-center">
                            <div class="font-bold">
                                <label for=""><?=$lang['taxCal-page'][1]?>: </label>
                            </div>
                            <div class="col-5">
                                <input type="radio" value="private" name="public-private" id="private" checked><label for="private" class="tax-radio">Private</label>
                                <input type="radio" value="public" name="public-private" id="public" disabled><label for="public" class="tax-radio disabled-radio" id="public-label">Public</label>
                            </div>
                        </div>
                        <div class="row-6 justify-center">
                            <div class="font-bold">
                                <label for=""><?=$lang['taxCal-page'][2]?>: </label>
                            </div>
                            <div class="col-5 name-div">
                                <input type="radio" value="Motorcycle" name="v-name" id="motorcycle" checked><label for="motorcycle" class="tax-radio tax-radio--vname">MotorCycle</label>
                                <input type="radio" value="Scooter" name="v-name" id="sccoter"><label for="sccoter" class="tax-radio tax-radio--vname">Scooter</label>
                                <input type="radio" value="Moped" name="v-name" id="moped"><label for="moped" class="tax-radio tax-radio--vname">Moped</label>
                            </div>
                        </div>
                        <div class="row-6 justify-center">
                            <div class="font-bold">
                                <label for=""><?=$lang['taxCal-page'][3]?>: </label>
                            </div>
                            <div class="col-5">
                                <select name="engine-cc" id="eng-cc" class="form-field">
                                    <option value="0-125CC">0cc - 125cc</option>
                                    <option value="126CC-250CC">126cc - 250cc</option>
                                    <option value="251CC-400CC">251cc - 400cc</option>
                                    <option value="401CC-Greater">401cc - greater</option>
                                </select>
                            </div>
                        </div>
                        <div class="row-6 justify-center">
                            <div class="font-bold">
                                <label for=""><?=$lang['taxCal-page'][4]?>: </label>
                            </div>
                            <div class="col-5">
                                <input type="radio" value="1" name="province" id="1" required checked><label for="1" class="tax-radio tax-radio--rounded">1</label>
                                <input type="radio" value="2" name="province" id="2"><label for="2" class="tax-radio tax-radio--rounded">2</label>
                                <input type="radio" value="3" name="province" id="3"><label for="3" class="tax-radio tax-radio--rounded">3</label>
                                <input type="radio" value="4" name="province" id="4"><label for="4" class="tax-radio tax-radio--rounded">4</label>
                                <input type="radio" value="5" name="province" id="5"><label for="5" class="tax-radio tax-radio--rounded">5</label>
                                <input type="radio" value="6" name="province" id="6"><label for="6" class="tax-radio tax-radio--rounded">6</label>
                                <input type="radio" value="7" name="province" id="7"><label for="7" class="tax-radio tax-radio--rounded">7</label>
                            </div>
                        </div>
                        <div class="row-6 justify-center">
                            <div class="font-bold">
                                <label for=""><?=$lang['taxCal-page'][5]?>: </label>
                            </div>
                            <div class="col-5">
                                <input type="text" placeholder="Last Renew Date" name="renew-date" id="date-field" class="form-field" required>
                            </div>
                        </div>
                        <input type="submit" name="taxCalculate" value="<?=$lang['taxCal-page'][6]?>" class="btn btn-primary" style="float: right;">
                    </form>
                    <div class="result">
                        <div class="result-holder">
                            <h3><?=$lang['taxCal-page'][7]?></h3>
                            <div class="row-2">
                                <div class="tax-amount">
                                    <h2>RS. <?php if(isset($_GET['ta'])){echo $_GET['toa'];}else{echo '0';} ?></h2>
                                </div>
                                <div class="result-details">
                                    <?php if(isset($_GET['fa']) && $_GET['fa'] == -1){ ?>
                                        <p><b><?=$lang['taxCal-page'][11]?></b></p>
                                    <?php }else{ ?> 
                                        <p>
                                            <b><?=$lang['taxCal-page'][8]?>: </b> Rs <?php if(isset($_GET['ta'])){echo $_GET['ta'];}else{echo '0';} ?>
                                        </p>
                                        <p><b><?=$lang['taxCal-page'][9]?>: </b> <?php if(isset($_GET['ta'])){echo $_GET['fp'];}else{echo '0';} ?>%</p>
                                        <p><b><?=$lang['taxCal-page'][10]?>:</b> Rs <?php if(isset($_GET['ta'])){echo $_GET['fa'];}else{echo '0';} ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h3>The tax are calculated as per the fiscal year 2076/77</h3>
            </div>
        </div>
    </main>

    <?php include('../repeated_section/mobile-header.php') ?>
    <?php include('../repeated_section/footer.html') ?>

    <script src="../JS/new-js/calculator.js"></script>
    <script src="../JS/new-js/mobile-menu.js"></script>
    <script src="../JS/new-js/theme.js"></script>
    <script src="../JS/dist/mc-calendar.min.js"></script>
    <script>
        const d = new Date();
        d.setDate(d.getDate() - 365)
        const myDatePicker = MCDatepicker.create({ 
            el: '#date-field',
            dateFormat: 'YYYY-MM-DD',
            bodyType: 'inline',
            maxDate: d,
        })
    </script>
</body>
</html>