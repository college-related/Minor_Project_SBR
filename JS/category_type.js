// function to change the selection of vehicle category according to type

function changingType(sel1, sel2){
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
        
        select2.options.add(newOption);
    }
}
// "c|C", "d|D", "e|E", "f|F", "g|G", "h|H", "i|I", "j|J"

function changingCC(sel1, sel2){
    var select1 = document.getElementById(sel1);
    var select2 = document.getElementById(sel2);
    
    select2.innerHTML = "";

    var optArry = [];

    if(select1.value == "b"){
        optArry = [
            "0-1000CC|0-1000CC", 
            "1001CC-1500CC|1001CC-1500CC", 
            "1501CC-2000CC|1501CC-2000CC", 
            "2001CC-2500CC|2001CC-2500CC",
            "2501CC-2900CC|2501CC-2900CC",
            "2901CC to greater|2901CC to greater"
        ];
    }else{
        optArry = [
            "0-125CC|0-125CC",
            "126CC-250CC|126CC-50CC",
            "251CC-400CC|251CC-400CC",
            "401CC to greater|401CC to greater"
        ];
    }

    for(var option in optArry){
        var pair = optArry[option].split("|");
        var newOption = document.createElement("option");
        newOption.value = pair[0];
        newOption.innerHTML = pair[1];
       
        select2.options.add(newOption);
    }
}

var dropDown = document.getElementById('type');

dropDown.addEventListener('click', function(){
    changingCC('category', 'engCC');
});

dropDown.addEventListener('change', function(){
    changingType('type', 'category');
})