<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>

    <!-- font links -->
    <link href="https://fonts.googleapis.com/css2?family=ZCOOL+XiaoWei&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mukta+Malar&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kalam&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/form.css">

    <style>

        /* styling for the insurance section where the radio buttons are present */
        .insurance-slip {
            width: fit-content;
        }

        /* giving top margin for more space between form and banner section */
        .form-main {
            margin-top: 40px;
        }

    </style>

    <script defer src="../JS/category_type.js"></script>
    <script defer src="../js/others.js"></script>

</head>
<body>
    <header class="col-12">

        <!-- logo and website name -->
        <span id="logo">SWIFT BLUEBOOK RENEW</span>

        <!-- navigation bar for desktop view -->
        <nav>
            <ul>
                <li><a href="./information.php?isLogged=true">Infos</a></li>
                <li><a href="#" class="active-nav-link">Form</a></li>
                <li><a href="./profile.php?Logged">Profile</a></li>
                <li><a href="../php/logout.php">LogOut</a></li>
                <li><i class="fa fa-search"></i></li>
            </ul>
        </nav>
       
    </header>

    <main class="form-main col-12">
        <!-- checkbox to check if the form is for others -->
        <div class="btns">
            <input type="checkbox" id="check" onclick="reveal()"> For-Others
            <!-- TODO: add auto-fill -->
            <button>Auto-Fill</button>
        </div>
        <form action="../PHP/handleForm.php" method="POST">
            <!-- hidden div for others -->
            <div class="others-info">
                <h3>Information of the person you are filling the form of:</h3>
            </div>
            <!-- personal details section -->
            <fieldset>
                <legend>Personal details:</legend>
                <table>
                    <tr>
                        <td><label for="name">Name:</label></td>
                        <td><input type="text" name="Name" id="name" required/></td>
                    </tr>
                    <tr>
                        <td><label for="phn">Phone Number:</label></td>
                        <td><input type="number" name="Phn" id="phn" required/></td>
                    </tr>
                </table>
            </fieldset>
            <!-- Vechile details section -->
            <fieldset>
                <legend>Vechile details:</legend>
                <table>
                    <tr>
                        <td><label for="type">Type:</label></td>
                        <td>
                            <select name="Vtype" id="type" onchange="changingType('type', 'category')" required>
                                <option value="none"></option>
                                <option value="twoWheel">Two wheeler</option>
                                <option value="fourWheel">Four wheeler</option>
                            </select>
                        </td>
                        <td><label for="category">Category:</label></td>
                        <td>
                            <select name="Vcategory" id="category" required></select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><label for="engine">Engine CC:</label></td>
                        <td colspan="2"><input type="number" name="EngineCC" id="engine" placeholder="Ex: 150" required/></td>
                    </tr>
                    <tr>
                        <td colspan="2"><label for="vehicleReg">Vehicle Registration no:</label></td>
                        <td colspan="2"><input type="text" name="VehicleReg" id="vehicleReg" placeholder="GA 16 PA 4381" required/></td>
                    </tr>
                </table>
            </fieldset>
            <!-- Bluebook / insurance section -->
            <fieldset>
                <legend>BLUEBOOK/Insurance:</legend>
                <table>
                    <tr>
                        <td><label for="renewDate">Last Renew Date:</label></td>
                        <td><input type="date" name="RenewDate" id="renewDate" /></td>
                    </tr>
                    <tr>
                        <td><label for="insuranceSlip">Insurance Slip:</label></td>
                        <td>
                            <input type="radio" name="insuranceSlip" value="yes" class="insurance-slip">YES
                            <input type="radio" name="insuranceSlip" value="no" class="insurance-slip">NO
                        </td>
                    </tr>
                </table>
            </fieldset>
            <!-- hidden section for others -->
            <!-- Here we fill the users data -->
            <div class="others-info">
                <h3>Your information:</h3>
                <fieldset>
                    <legend>Personal data:</legend>
                    <table>
                        <tr>
                            <td><label for="name1">Name:</label></td>
                            <td><input type="text" name="Name1" id="name1"/></td>
                        </tr>
                        <tr>
                            <td><label for="phn1">Phone Number:</label></td>
                            <td><input type="number" name="Phn1" id="phn1"/></td>
                        </tr>
                    </table>
                </fieldset>
                <fieldset>
                    <legend>Vechile data:</legend>
                    <table>
                        <tr>
                            <td><label for="vehicleReg1">Vehicle Registration no:</label></td>
                            <td><input type="text" name="VehicleReg1" id="vehicleReg1" placeholder="GA 16 PA 4382"/></td>
                        </tr>
                    </table>
                </fieldset>
            </div>
            <!-- submit button section -->
            <fieldset>
                <legend>Submit:</legend>
                <table>
                    <tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Save Form" name="saveForm" />
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </main>

    <!-- foot of the website -->
    <?php include("../repeated_section/footer.html"); ?>

</body>
</html>