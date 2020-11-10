// function to change the selection of vehicle category according to type
// TODO: add the same functionality for Engine CC
function changingType(sel1, sel2, selectedCat = ''){
    var select1 = document.getElementById(sel1);
    var select2 = document.getElementById(sel2);
    
    select2.innerHTML = "";

    var optArry = [];

    if(select1.value == "two Wheeler"){
        optArry = ["k|K", "a|A"];
    }else{
        optArry = ["b|B"];
    }

    for(var option in optArry){
        var pair = optArry[option].split("|");
        var newOption = document.createElement("option");
        newOption.value = pair[0];
        newOption.innerHTML = pair[1];
        if(newOption.value == selectedCat){
            newOption.setAttribute("selected", "true");
        }
        select2.options.add(newOption);
    }
}
// "c|C", "d|D", "e|E", "f|F", "g|G", "h|H", "i|I", "j|J"

function changingCC(sel1, sel2, selectedCC = ''){
    var select1 = document.getElementById(sel1);
    var select2 = document.getElementById(sel2);
    
    select2.innerHTML = "";

    var optArry = [];

    if(select1.value == "b"){
        optArry = [
            "0-1000CC|upto 1000CC", 
            "1001-1500CC|1001CC to 1500CC", 
            "1501-2000CC|1501CC to 2000CC", 
            "2001CC-2500CC|2001CC to 2500CC",
            "2501CC-2900CC|2501CC to 2900CC",
            ">2901CC|2901CC to greater"
        ];
    }else{
        optArry = [
            "0-125CC|upto 125CC",
            "126CC-250CC|126CC to 250CC",
            "251CC-400CC|251CC to 400CC",
            ">401CC|401CC to greater"
        ];
    }

    for(var option in optArry){
        var pair = optArry[option].split("|");
        var newOption = document.createElement("option");
        newOption.value = pair[0];
        newOption.innerHTML = pair[1];
        if(newOption.value == selectedCC){
            newOption.setAttribute("selected", "true");
        }
        select2.options.add(newOption);
    }
}

var dropDown = document.getElementById('sel1');
// var selectedCC = document.getElementById('selectedCC').value;
// var selectedCategory = document.getElementById('selectedCat').value;

dropDown.addEventListener('click', function(){
    changingCC('sel2', 'sel3');
});

dropDown.addEventListener('change', function(){
    changingType('sel1', 'sel2');
})