<?php
    if(isset($_GET['calculated'])){
        $vType = $_GET['wt'];
        $vName = $_GET['vn'];
        $engCC = $_GET['e'];
        $lastRenewDate = $_GET['lr'];
        $province = $_GET['pr'];
        $taxAmount = $_GET['ta'];
        $fine = $_GET['f'];

        $fineArray = explode("|",$fine);
        $finePercentage = $fineArray[0];
        $fineAmount = $fineArray[1];
        $days = $fineArray[2];
        if($days <0){
            $daysMssg = "Paid ".abs($days)." days ahead";
        }else{
            $daysMssg = "Paid in ".$days." days"; 
        }
        if($fineAmount < 0 ){
            $totalAmount = "--";
        }else{
            $totalAmount = $taxAmount + $fineAmount;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tax Calculator</title>
    
    <link rel="stylesheet" href="../CSS/style.css">

    <style>
        p{
            text-align: center;
            padding-bottom:1rem;
        }
        label{
            color: white;
            width: 100%;
        }
        .row{
            width: 100%;
            height: 100%;
        }
        input{
            /* font-size: 24px; */
        }
        .main{
            height: 800px;
        }
        option{
            color: #0C0A67;
           width: 100%;
        }
        select{
            /* font-size: 24px; */
        }
        td{
            /* font-size:30px; */
        }
        .taxdata{
            width: 50%;
            float:left;
            background-color: #97C0F0;
            display:flex;
            flex-direction:column; 
            box-sizing:border-box;
            height: 800px;
            right:0;
        }
        form{
            margin-left: auto;
            margin-right: auto;
        }
        h1{
            color: #0C0A67;
            /* font-size: 35px; */
            text-align:center;
        }
        .taxresult{
            float:left;
            background-color: white;
            width: 50%;
            height:800px;
            box-sizing:border-box;
            right:0;
        }  
        table{
            margin-left: auto;
            margin-right: auto;
        } 
        .calculate{
            background-color:#0C0A67;
            color: #ffffff;
            /* font-size: 18px; */
            height: 3rem;
            width: 29rem;
        }

        <?php
            if(isset($_GET['calculated'])){
                echo '.result-table {
                            animation: fade-in 1.5s ease-in-out;
                        }';
            }
        ?>

        @keyframes fade-in {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @media screen and (max-width:750px)
         {
            .row{
                flex-direction:column;
            } 
            .taxdata ,.taxresult{
                width:100%;
            }
            
        }
    </style>
</head>
<body>
    <header class="col-12">
        <!-- logo and website name -->
        <span id="logo">
            Swift Bluebook Renew
        </span>

        <!-- navigation bar -->
        <nav>
            <ul>
                <li><a href="./pages/information.php?isLogged=false">Infos</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#" class="active-link">Tax Calulator</a></li>
                <li><a href="../index.php#loginForm">Log in</a></li>
            </ul>
        </nav>

    </header>
    <main>
        <div class="row">
        
        <div class="taxdata " id="td" >
            <h1>Tax Calculator</h1>
            <p>Estimate your tax according to your vehicle and other details</p>
             <form action="../PHP/calculator.php" method="POST" >
                <label for="wheel">Vehicle Type: </label>
                <select name="wheeler" id="wheel">
                    <option value="0W">--Select type--</option>
                    <option value="2W">Two Wheeler</option>
                    <option value="3W">Three Wheeler</option>
                    <option value="4W">Four Wheeler</option>
                    <option value="6W">Six Wheeler</option>
                    <option value="8W">Eight Wheeler</option>
                    <option value="W">Tracks(Dozer)</option>
                </select><br><br>
                <label for="name">Vehicle name: </label>
                <select name="Name" id="name" >
                    <option value="none">--Select vehicle--</option>
                </select><br><br>
                <label for="name">Public/Private: </label>
                <input type="radio" name="pp" value="private" checked /><label for="name" style="font-size: 24px; color: black;">Private </label>
                <input type="radio" name="pp" value="public" /><label for="name" style="font-size: 24px; color: black;">Public </label>
                <br><br>
                <label for="engCC">Engine CC:</label>
                <select name="engineCC" id="engCC" ></select>
                <br><br>
                <label for="lastRenew">Last Renew Date: </label>
                <input type="date" name="lastRenewDate" id="lastRenew">
                <br><br>
                <label for="province">Province Number: </label>
                <select name="pro" id="province">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                </select><br><br>
                <input type="submit" value="Calculate Tax" name="taxCalculate" class="calculate" id="slide" >
                </form>
        </div>
        <div class="taxresult" id="tr">
            <h1>Your Result</h1>
            <?php
            
                if(isset($_GET['calculated'])){
                    echo 
                    '<table class="result-table">
                        <tr>
                            <td>Vehicle Type:</td>
                            <td>'.$vType.'</td>
                        </tr>
                        <tr>
                            <td>Vehicle Name:</td>
                            <td>'.$vName.'</td>
                        </tr>
                        <tr>
                            <td>Engine CC:</td>
                            <td>'.$engCC.'</td>
                        </tr>
                        <tr>
                            <td>Last Renew Date:</td>
                            <td>'.$lastRenewDate.'</td>
                        </tr>
                        <tr>
                            <td>Provience:</td>
                            <td>'.$province.'</td>
                        </tr>
                        <tr>
                            <td>Tax Amount:</td>
                            <td>'.$taxAmount.'</td>
                        </tr>
                        <tr>
                            <td>Days:</td>
                            <td>'.$daysMssg.'</td>
                        </tr>
                        <tr>
                            <td>Fine Percentage:</td>
                            <td>'.$finePercentage.'</td>
                        </tr>
                        <tr>
                            <td>Fine Amount:</td>
                            <td>'.$fineAmount.'</td>
                        </tr>
                        <tr>
                            <td>Total Amount:</td>
                            <td>'.$totalAmount.'</td>
                        </tr>
                    </table>';
                }else{
                    echo '<p>Your Result will appear here</p>';
                }
            
            ?>
        </div>
        </div>
    </main>

    <script>
        var type = document.getElementById('wheel');
        
        function changeName(){
            var name = document.getElementById('name');
            name.disabled = false;
            var optArry;
            name.innerHTML = "";
            var eccDiv = document.getElementById("engCC");
            eccDiv.disabled = false;

            if(type.value == "2W"){
                optArry = ["Motorcycle", "Scooter","Moped"];
                addOption(optArry, name);
            }else if(type.value == "3W"){
                optArry = ["Tempo", "Auto-Rickshaw", "E-Rickshaw", "Three-Wheeler"];
                addOption(optArry, name);
                eccDiv.disabled = true;
            }else if(type.value == "4W"){
                optArry = ["Car", "Jeep", "Van", "MiniBus", "MiniTruck", 
                    "Power-tiller", "MiniTipper", "Tractor"];
                addOption(optArry, name);
            }else if(type.value == "6W"){
                optArry = ["Truck", "Bus", "Fire-Brigade", "Tipper"];
                addOption(optArry, name);
                eccDiv.disabled = true;
            }else if(type.value == "8W"){
                optArry = ["Lorry", "Truck"];
                addOption(optArry, name);
                eccDiv.disabled = true;
            }else if(type.value == "W"){
                optArry = ["Dozer", "Excavator", "Backhoe-Loader",
                    "Grader", "Loader", "Forklift", "Road-Roller", "Crane"];
                addOption(optArry, name);
                eccDiv.disabled = true;
            }else{
                name.innerHTML = "";
                optArry = ["--Select vehicle--"];
                addOption(optArry, name);
                eccDiv.disabled = true;
                name.disabled = true;
            }
        }

        function changeCC(){
            var engcc = document.getElementById('engCC');
            var name = document.getElementById("name");
            var private = document.getElementsByName("pp")[0];
            var public = document.getElementsByName("pp")[1];
            var value = name.value;
            var optArry;
            engcc.innerHTML = "";
            private.disabled = false;
            public.disabled = false;

            if(value == "Motorcycle" || value == "Scooter" || value == "Moped"){
                optArry = ["0-125CC", "126CC-250CC", "251CC-400CC", "401CC-Greater"];
                addOption(optArry, engcc);
                private.disabled = true;
                public.disabled = true;
            }else if(value == "Car" || value == "Jeep" || value == "Van"){
                engcc.disabled = false;
                if(private.checked){
                    optArry = ["0-1000CC", "1001CC-1500CC", "15001CC-2000CC", "2001CC-2500CC",
                     "2501CC-2900CC", "2901CC-Greater"];
                    addOption(optArry, engcc);
                }else{
                    optArry = ["0-1300CC", "1301CC-2000CC", "2001CC-2900CC", 
                        "2901CC-4000CC", "4001CC-Greater"];
                    addOption(optArry, engcc);
                }
            }else{
                document.getElementById("engCC").disabled = true;
                engcc.innerHTML = "";
            }
        }

        function addOption(optArry, name){
            for(var i = 0; i < optArry.length; i++){
                    var newOption = document.createElement("option");
                    newOption.value = optArry[i];
                    newOption.innerHTML = optArry[i];

                    name.appendChild(newOption);
            }
        }

        type.addEventListener('change', changeName);
        type.addEventListener('click', changeCC);
        document.getElementById("name").addEventListener('click', changeCC);
        var radios = document.getElementsByName("pp");

        for(var i = 0; i < radios.length; i++){
            radios[i].addEventListener('click', changeCC);
        }
    </script>
</body>
</html>