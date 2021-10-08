<?php

/*
    * function to calculate tax amount

    *@param [vehicle name, engine cc, province number, and private/public]
    *@return [tax amount]
*/
function calculateTax($name, $engCC, $province, $radio){
    $taxAmount = "";

    if($name == "Motorcycle" || $name == "Scooter" || $name == "Moped"){
        if($engCC == "0-125CC"){
            if($province == "1"){
                $taxAmount = 2800;
            }else if($province == "2"){
                $taxAmount = 2500;
            }else if($province == "3"){
                $taxAmount = 2750;
            }else if($province == "4"){
                $taxAmount = 2500;
            }else if($province == "5"){
                $taxAmount = 2500;
            }else if($province == "6"){
                $taxAmount = 2500;
            }else if($province == "7"){
                $taxAmount = 2500;
            }         
        }else if($engCC == "126CC-250CC"){
            if($province == "1"){
                $taxAmount = 4500;
            }else if($province == "2" || $province == "4" || $province == "5" || $province == "6"){
                $taxAmount = 4000;
            }else if($province == "3"){
                $taxAmount = 4400;
            }else if($province == "7"){
                $taxAmount = 6000;
            }
        }else if($engCC == "251CC-400CC"){
            if($province == "1"){
                $taxAmount = 9000;
            }else if($province == "2" || $province == "4" || $province == "5" || $province == "6"){
                $taxAmount = 8000;
            }else if($province == "3"){
                $taxAmount = 8800;
            }else if($province == "7"){
                $taxAmount = 16000;
            }
        }else if($engCC == "401CC-Greater"){
            if($province == "1" || $province == "3"){
                $taxAmount = 16500;
            }else if($province == "2" || $province == "4" || $province == "5" || $province == "6"){
                $taxAmount = 15000;
            }else if($province == "7"){
                $taxAmount = 30000;
            }
        }
    }else if($name == "Car" || $name == "Jeep" || $name == "Van"){
        if($radio == "private"){
            if($engCC == "0-1000CC"){
                if($province == "1" || $province == "7"){
                    $taxAmount = 21000;
                }else if($province == "2" || $province == "4" || $province == "5"){
                    $taxAmount = 19000;
                }else if($province == "3"){
                    $taxAmount = 20900;
                }else if($province == "6"){
                    $taxAmount = 16000;
                }
            }else if($engCC == "1001CC-1500CC"){
                if($province == "2" || $province == "4" || $province == "5" || $province == "6"){
                    $taxAmount = 21000;
                }else if($province == "1" || $province == "7"){
                    $taxAmount = 23000;
                }else if($province == "3"){
                    $taxAmount = 23100;
                }
            }else if($engCC == "1501CC-2000CC"){
                if($province == "2" || $province == "4" || $province == "5" || $province == "6"){
                    $taxAmount = 23000;
                }else if($province == "1"){
                    $taxAmount = 30000;
                }else if($province == "7"){
                    $taxAmount = 25000;
                }else if($province == "3"){
                    $taxAmount = 25300;
                }
            }else if($engCC == "2001CC-2500CC"){
                if($province == "2" || $province == "4" || $province == "5" || $province == "6"){
                    $taxAmount = 32000;
                }else if($province == "1"){
                    $taxAmount = 35500;
                }else if($province == "7"){
                    $taxAmount = 38000;
                }else if($province == "3"){
                    $taxAmount = 35200;
                }
            }else if($engCC == "2501CC-2900"){
                if($province == "2" || $province == "4" || $province == "5" || $province == "6"){
                    $taxAmount = 37000;
                }else if($province == "1"){
                    $taxAmount = 41000;
                }else if($province == "7"){
                    $taxAmount = 45000;
                }else if($province == "3"){
                    $taxAmount = 40700;
                }
            }else if($engCC == "2901CC-Greater"){
                if($province == "2" || $province == "4" || $province == "5" || $province == "6"){
                    $taxAmount = 53000;
                }else if($province == "1"){
                    $taxAmount = 58500;
                }else if($province == "7"){
                    $taxAmount = 65000;
                }else if($province == "3"){
                    $taxAmount = 58300;
                }
            }
        }else if($radio == "public"){
            if($engCC == "0-1300CC"){
                if($province == "1"){
                    $taxAmount = 8500;
                }else if($province == "2" || $province == "4" || $province == "5" || $province == "6"){
                    $taxAmount = 8000;
                }else if($province == "3"){
                    $taxAmount = 8800;
                }else if($province == "7"){
                    $taxAmount = 10000;
                }
            }else if($engCC == "1301CC-2000CC"){
                if($province == "1"){
                    $taxAmount = 9500;
                }else if($province == "2" || $province == "4" || $province == "5" || $province == "6"){
                    $taxAmount = 9000;
                }else if($province == "3"){
                    $taxAmount = 9900;
                }else if($province == "7"){
                    $taxAmount = 12000;
                }
            }else if($engCC == "2001CC-2900CC"){
                if($province == "1"){
                    $taxAmount = 11500;
                }else if($province == "2" || $province == "4" || $province == "5" || $province == "6"){
                    $taxAmount = 11000;
                }else if($province == "3"){
                    $taxAmount = 12900;
                }else if($province == "7"){
                    $taxAmount = 14000;
                }
            }else if($engCC == "2901CC-4000CC"){
                if($province == "1"){
                    $taxAmount = 13500;
                }else if($province == "2" || $province == "4" || $province == "5" || $province == "6"){
                    $taxAmount = 13000;
                }else if($province == "3"){
                    $taxAmount = 14300;
                }else if($province == "7"){
                    $taxAmount = 16000;
                }
            }else if($engCC == "4001CC-Greater"){
                if($province == "1" || $province == "3"){
                    $taxAmount = 16500;
                }else if($province == "2" || $province == "4" || $province == "5" || $province == "6"){
                    $taxAmount = 15000;
                }else if($province == "7"){
                    $taxAmount = 20000;
                }
            }
        }
    }else if($name == "Tractor"){
        if($radio == "private"){
            if($province = "1"){
                $taxAmount = 4500;
            }else if($province == "2" || $province == "4" || $province == "5" || $province == "6"){
                $taxAmount = 4000;
            }else if($province == "3" || $province == "7"){
                $taxAmount = 5000;
            }
        }else if($name == "public"){
            if($province == "1"){
                $taxAmount = 2700;
            }else if($province == "4" || $province == "5" || $province == "6"){
                $taxAmount = 2500;
            }else if($province == "2"){
                $taxAmount = 4000;
            }else if($province == "3"){
                $taxAmount = 5000;
            }else if($province == "7"){
                $taxAmount = 3000;
            }
        }
    }else if($name == "Power-tiller"){
        if($radio == "private"){
            if($province =="1"){
                $taxAmount = 0;
            }else if($province == "2" || $province == "4" || $province == "5" || $province == "6"){
                $taxAmount = 3000;
            }else if($province == "3"){
                $taxAmount = 3300;
            }else if($province == "7"){
                $taxAmount = 3500;
            }
        }else if($name == "public"){
            if($province == "1"){
                $taxAmount = 0;
            }else if($province == "2" || $province == "4" || $province == "5" || $province == "6"){
                $taxAmount = 2000;
            }else if($province == "3"){
                $taxAmount = 3300;
            }else if($province == "7"){
                $taxAmount = 2500;
            }
        }
    }else if($name == "MiniTruck" || $name == "MiniBus"){
        if($radio == "private"){
            if($province == "1"){
                $taxAmount = 24500;
            }else if($province == "2" || $province == "4" || $province == "6"){
                $taxAmount = 22000;
            }else if($province == "3"){
                $taxAmount = 24200;
            }else if($province == "5"){
                $taxAmount = 25000;
            }else if($province == "7"){
                $taxAmount = 27000;
            }
        }else if($name == "public"){
            if($province == "1"){
                $taxAmount = 12500;
            }else if($province == "2" || $province == "4" || $province == "5" || $province == "6"){
                $taxAmount = 12000;
            }else if($province == "3"){
                $taxAmount = 13200;
            }else if($province == "7"){
                $taxAmount = 15000;
            }
        }
    }else if($name == "Truck" || $name == "Bus" || $name == "Fire-Brigade" || $name == "Lorry"){
        if($radio == "private"){
            if($province == "1" || $province == "3"){
                $taxAmount = 33000;
            }else if($province == "2" || $province == "7" || $province == "5" || $province == "6"){
                $taxAmount = 30000;
            }else if($province == "4"){
                $taxAmount = 32000;
            }
        }else if($radio == "public"){
            if($province == "1"){
                $taxAmount = 17000;
            }else if($province == "2" || $province == "4" || $province == "5" || $province == "6"){
                $taxAmount = 16000;
            }else if($province == "3"){
                $taxAmount = 15400;
            }else if($province == "7"){
                $taxAmount = 20000;
            }
        }
    }else if($name == "Auto-Rickshaw" || $name == "Tempo" || $name == "E-Rickshaw" || $name == "Three-Wheeler"){
        if($province == "1" || $province == "3" || $province == "7"){
            $taxAmount = 0;
        }else{
            if($radio == "private"){
                $taxAmount = 5000;
            }else{
                $taxAmount = 4000;
            }
        }
    }else if($name == "MiniTipper"){
        if($province == "1" || $province == "7"){
            $taxAmount = 15000;
        }else if($province == "2" || $province == "4" || $province == "5" || $province == "6"){
            $taxAmount = 14000;
        }else if($province == "3"){
            $taxAmount = 15400;
        }
    }else if($name == "Crane" || $name == "Tipper" || $name == "Road-Roller" || $name == "Dozer" || $name == "Excavator" || $name == "Loader" || $name == "Froklift" || $name == "Grader" || $name = "Backhoe-Loader"){
        if($radio == "private"){
            if($province == "1"){
                $taxAmount = 38500;
            }else if($province == "2" || $province == "4" || $province == "5" || $province == "6"){
                $taxAmount = 35000;
            }else if($province == "3"){
                $taxAmount = 50000;
            }else if($province == "7"){
                $taxAmount = 40000;
            }
        }else if($radio == "public"){
            if($province == "1"){
                $taxAmount = 18000;
            }else if($province == "2" || $province == "4" || $province == "6"){
                $taxAmount = 17000;
            }else if($province == "3"){
                $taxAmount = 50000;
            }else if($province == "5"){
                $taxAmount = 12000;
            }else if($province == "7"){
                $taxAmount = 25000;
            }
        }
    }

    return $taxAmount;
}

/*
    * function to calculate fine amount

    *@param [last renew date and current tax amount]
    *@return [fine amount]
*/
function calculateFine($lastRenew, $taxAmount){
    $fine = "";
    $date = date("Y-m-d");
    $newDateArr = explode("-", $date);
    $oldDateArr = explode("-", $lastRenew);
    $fineAmount = 0;

    $totalDays = (($newDateArr[0]-$oldDateArr[0])*365+($newDateArr[1]-$oldDateArr[1])*30+($newDateArr[2]-$oldDateArr[2]))-364;
    if($totalDays <= 0){
        $fine = "0%|$fineAmount|$totalDays";
    }elseif($totalDays <= 30){
        $fineAmount  = $taxAmount * 0.05;
        $fine = "5%|$fineAmount|$totalDays";
    }elseif($totalDays <= 45){
        $fineAmount = $taxAmount * 0.1;
        $fine = "10%|$fineAmount|$totalDays";
    }elseif($totalDays <= 365){
        $fineAmount = $taxAmount * 0.2;
        $fine = "20%|$fineAmount|$totalDays";
    }else{
        $fineAmount = -1;
        $fine = "-|$fineAmount|$totalDays";
    }
    return $fine;
}

if(isset($_POST['taxCalculate'])){
    $vType = $_POST['wheeler'];
    $vName = $_POST['v-name'];
    $radio = $_POST['public-private'];
    
    if(isset($_POST['engine-cc']))
        $engCC = $_POST['engine-cc'];
    else
        $engCC = "";

    $lastRenew = $_POST['renew-date'];
    $province = $_POST['province'];

    // * obtaining the tax amount
    $taxAmount = calculateTax($vName, $engCC, $province, $radio);

    // * obtaining the fine amount
    $fine = calculateFine($lastRenew, $taxAmount);

    list($finepercentage, $fineamount, $totaldays) = array_pad(explode('|', $fine, 3), 3, 0);
    $finepercentage = intval($finepercentage);

    $totalAmount = $taxAmount + ($finepercentage/100 * $taxAmount);

    header("location: ../PAGES/taxCalculator.php?calculated&wt=$vType&vn=$vName&e=$engCC&lr=$lastRenew&pr=$province&ta=$taxAmount&fp=$finepercentage&fa=$fineamount&toa=$totalAmount");

}