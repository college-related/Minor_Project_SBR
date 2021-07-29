<?php 
    session_start(); 

    $uId = $_SESSION['uId'];

    require('../PHP/includes/connection.php');
    include('../PHP/includes/table_columns_name.php');
    include('../PHP/includes/encryption.php');

    $command = "SELECT * FROM users WHERE uId=$uId";
    $execute = mysqli_query($connect, $command);
    $row = mysqli_fetch_assoc($execute);

    $str = '/6G6F;WvK7;s{au/6G6F;WvK7;s{au';
    $key = md5($str);

    
    $sql_info = "SELECT users.$citizenship_column, users.$image_column, users.$username_column, users.$phoneNumber_column, vehicles_data.* FROM users JOIN vehicles_data ON users.uId=vehicles_data.uId WHERE users.uId='$uId' && vehicles_data.uId='$uId'";
    $info_result = mysqli_query($connect, $sql_info);

    $infoarray = mysqli_fetch_all($info_result, MYSQLI_ASSOC);


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

    include('../repeated_section/language.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Edit</title>
    
    <link rel="stylesheet" href="../CSS/new-css/style.css">
    <link rel="stylesheet" href="../CSS/new-css/profile.css">
    <link rel="stylesheet" href="../CSS/new-css/admin-profile.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
   <style>
       .form-body{
        margin:3rem 1rem 0rem 1rem;
       }
       .form-field,.edit-btn{
        border-radius:10px;
       }
       .edit-btn{
           margin-top:3rem;
       }
       @media screen and (max-width: 800px){
            .form-body-part2{
                margin:0rem 1rem;
            }
            .edit-btn{
                margin-top:1rem;
            }
        }
    </style>
    <script defer src="../JS/category_type.js"></script>

</head>
<body>
    <?php include('../repeated_section/header.php')?>
    <main>
        <div  class="container">
            <div class=" main-holder row-3">
                <div class="profile-photo-wrapper">
                    <div id="add-photo" >
                        <div class="profile-image">
                            <?php
                                if($row[$image_column] == null){
                                    echo "";
                                }else{
                                    echo "<img src='../ASSETS/upload/$row[$image_column]' alt='profile picture' id='profile_picture'>";
                                }
                            ?>
                        </div>
                        <div class="image-adder-btn">
                            <div>
                                <form action='../PHP/handleImage.php' method='POST' enctype='multipart/form-data'>
                                    <input type='file' name='img' onchange='this.form.submit();' id='image_adder'>
                                    <label for='image_adder'>
                                        <i class='far fa-image'> </i> 
                                        <span class="tooltip" id="add-image"><?=$lang['profile-edit-page']['img-text-one']?></span> 
                                    <lable>
                                </form>
                            </div>
                            <div>
                                <form action="../PHP/deleteImage.php" id="delete-image-form" method="POST">
                                    <label for="image-remover" onclick="submitForm()">
                                        <i class="fas fa-user-times"></i>
                                        <span class="tooltip" id="delete-image"><?=$lang['profile-edit-page']['img-text-two']?></span>
                                    </label>
                                <input type="hidden" value="delete" name="delete-btn">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="information-holder">
                        <h2><?=$lang['profile-edit-page']['h1-text']?></h2>
                        <hr class="hr">
                        <form action="../PHP/handleBasicdata.php" method="POST">
                            <div class="row-2">
                                <div class="col-1 form-body">
                                    <input type="text" placeholder="<?=$lang['profile-edit-page']['form-texts'][0]?>" name="Phn" class="form-field form-group" value="<?=decryptData($infoarray[0][$phoneNumber_column],$key); ?>">
                                    <input type="text" placeholder="<?=$lang['profile-edit-page']['form-texts'][1]?>" name="vReg" class="form-field form-group" value="<?=decryptData($infoarray[0][$vehicleRegistration_column],$key); ?>">
                                </div>
                                <div class="col-1 form-body form-body-part2">
                                    <select name="vType" id="type" class="form-field form-group">
                                        <option value="two wheeler" <?php if($infoarray[0][$vehicleType_column] == "two wheeler")?>>Two wheeler</option>
                                        <option value="four wheeler" <?php if($infoarray[0][$vehicleType_column] == "four wheeler")?>>Four wheeler</option>
                                    </select>                                       
                                    <select name="vCategory" id="category" class="form-field form-group">
                                        <?php 
                                            echo "<option value='$vcat'>$vcat</option>";
                                        ?>
                                    </select>                               
                                    <select name="ECC" id="engCC" class="form-field form-group">
                                            <?php
                                                echo "<option value='$enginecc'>$enginecc</option>";
                                            ?>
                                    </select>
                                    <div class="row-2">
                                        <div class="cancel-btn col-1">
                                            <a href="./profile.php"><input type="submit" name="canclebtn" value="<?=$lang['profile-edit-page']['btn-text-one']?>" class="btn btn-secondary edit-btn btn-bgdanger" ></a>
                                        </div>
                                        <div class="btn-edit btn-td col-1">
                                            <input type="submit" name="savebtn"  value="<?=$lang['profile-edit-page']['btn-text-two']?>" class="btn btn-secondary edit-btn editsavebtn" >
                                        </div> 
                                    </div>
                                </div>
                            </div>                        
                        </form>
                    </div>
                </div>
            </div>          
        </div>
    </main>
    <?php include('../repeated_section/mobile-header.php')?>
    
    <script>
        function submitForm()
        {
            document.getElementById('delete-image-form').submit()
        }
    </script>
    <?php include '../repeated_section/footer.html' ?>
    <script src="../JS/new-js/theme.js"></script>
    <script src="../JS/new-js/mobile-menu.js"></script>
</body>
</html>