var others1 = document.getElementsByClassName("others-info")[0];
var others2 = document.getElementsByClassName("others-info")[1];
var check = document.getElementById("check");

// function to reveal the others section
function reveal() {
    // check if the checkbox is checked or not
    if(check.checked == true){
        others1.style.display = "block";
        others2.style.display = "block";
    }else{
        others2.style.display = "none";
        others1.style.display = "none";
    }
}