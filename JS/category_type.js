// function to change the selection of vehicle category according to type
// TODO: add the same functionality for Engine CC
function changingType(sel1, sel2){
    var select1 = document.getElementById(sel1);
    var select2 = document.getElementById(sel2);
    
    select2.innerHTML = "";

    var optArry = [];

    if(select1.value == "twoWheel"){
        optArry = ["k|K", "a|A"];
    }else{
        optArry = ["b|B", "c|C", "d|D", "e|E", "f|F", "g|G", "h|H", "i|I", "j|J"];
    }

    for(var option in optArry){
        var pair = optArry[option].split("|");
        var newOption = document.createElement("option");
        newOption.value = pair[0];
        newOption.innerHTML = pair[1];
        select2.options.add(newOption);
    }
}
