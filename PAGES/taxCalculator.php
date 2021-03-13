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
            $daysMssg = abs($days)." days ahead";
        }else{
            $daysMssg = $days." days"; 
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

    <style>
        .result>table,.result td ,.result th{
            border : 1px solid black;
            border-collapse:collapse;
            padding: 10px;
        }
    </style>
</head>
<body>
    <main>
        <h1>Tax Calculator</h1>
        <form action="../PHP/calculator.php" method="post">
            <label for="wheel">Vehicle Type: </label>
            <select name="wheeler" id="wheel">
                <option value="0W">--Select type--</option>
                <option value="2W">Two Wheeler</option>
                <option value="3W">Three Wheeler</option>
                <option value="4W">Four Wheeler</option>
                <option value="6W">Six Wheeler</option>
                <option value="8W">Eight Wheeler</option>
                <option value="W">Tracks(Dozer)</option>
            </select>
            <label for="name">Vehicle name: </label>
            <select name="Name" id="name" disabled>
            <option value="none">--Select vehicle--</option>
            </select><br><br>
            <input type="radio" name="pp" value="private" checked disabled/>Private
            <input type="radio" name="pp" value="public" disabled/>Public
            <br><br>
            <label for="engCC">Engine CC:</label>
            <select name="engineCC" id="engCC" disabled></select>
            <br><br>
            <label for="lastRenew">Last Renew Date: </label>
            <input type="date" name="lastRenewDate" id="lastRenew">
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
            <input type="submit" value="Calculate Tax" name="taxCalculate">
        </form>
        <?php
            if(isset($_GET['calculated'])){
                echo 
                "
                <div class='result'>
                <span>Your tax will be: </span>
                 <table>
                    <tr>
                        <th>Vehicle Type</th>
                        <th>Engine CC</th>
                        <th>Last renew date</th>
                        <th>Province Number</th>
                        <th>Tax Amount</th>
                        <th>Fine percentage</th>
                        <th>Fine Amount</th>
                        <th>Paid In</th>
                        <th>Total tax Amount</th>
                    </tr>
                    <tr>
                        <td>$vType</td>
                        <td>$engCC</td>
                        <td>$lastRenewDate</td>
                        <td>$province</td>
                        <td>Rs$taxAmount</td>
                        <td>$finePercentage</td>
                        <td>Rs$fineAmount</td>
                        <td>$daysMssg</td>
                        <td> Rs$totalAmount</td>
                    </tr>
                 </table>
                </div>
                ";
            }
        ?>
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