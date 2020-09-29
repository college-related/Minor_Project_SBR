                                            
function closePopUp(){
    var overlay = document.getElementsByClassName('overlay')[0];
    var popUp = document.getElementsByClassName('popup')[0];

    overlay.style.display = 'none';
    popUp.style.display = 'none';
}

var input = document.getElementsByTagName('input')[0];
var cross = document.getElementById('input-crossmark');

function clearInputField(){
    input.value="";
    input.focus();
    searchResult();
    letter.innerText = "";
}

cross.addEventListener('click',clearInputField);

var links = document.getElementsByClassName('link');
var letter = document.getElementById('searchLetter');

function clearSearchResult(){
    for(i=0; i<links.length; i++){
        links[i].style.display = "none";
    }

}

function searchResult(){
    var filter =input.value.toUpperCase() ;
    letter.innerText = "Search Result for \'" + input.value + "\'";

    var a ,i ,txt;

    if(filter == ""){
        clearSearchResult();
        return;
    }
        for(i=0; i < links.length; i++){
            a = links[i].getElementsByClassName('tag')[0];
            txt = a.innerText || a.textContent;

            if(txt.toUpperCase().indexOf(filter) > -1 ){
                links[i].style.display = 'block';
            }else{
                links[i].style.display = 'none';
            }
        }
}

input.addEventListener('keyup',function(e){
    if(e.key == 'Enter'){
        searchResult();
    }
},false);
function autocomplete(inp, arr) {

    

    var currentFocus;

    inp.addEventListener("input", function(e) {

        var a, b, i, val = this.value;

        closeAllLists();

        if (!val) { return false;}

        currentFocus = -1;

        a = document.createElement("DIV");

        a.setAttribute("id", this.id + "autocomplete-list");

        a.setAttribute("class", "autocomplete-items");

        this.parentNode.appendChild(a);

        for (i = 0; i < arr.length; i++) {

          if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {

            b = document.createElement("DIV");

            b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";

            b.innerHTML += arr[i].substr(val.length);

            b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";

            b.addEventListener("click", function(e) {

                inp.value = this.getElementsByTagName("input")[0].value;

                closeAllLists();

            });

            a.appendChild(b);

          }

        }

    });

 

    inp.addEventListener("keydown", function(e) {

        var x = document.getElementById(this.id + "autocomplete-list");

        if (x) x = x.getElementsByTagName("div");

        if (e.keyCode == 40) {

          currentFocus++;

          addActive(x);

        } else if (e.keyCode == 38) { 

          currentFocus--;

          addActive(x);

        } else if (e.keyCode == 13) {

          if (currentFocus > -1) {

            if (x) x[currentFocus].click();

          }

        }

    });

 

    function addActive(x) {

      if (!x) return false

      removeActive(x);

      if (currentFocus >= x.length) currentFocus = 0;

      if (currentFocus < 0) currentFocus = (x.length - 1);

      x[currentFocus].classList.add("autocomplete-active");

    }

    

    function removeActive(x) {

      for (var i = 0; i < x.length; i++) {

        x[i].classList.remove("autocomplete-active");

      }

    

    }

    function closeAllLists(elmnt) {

      var x = document.getElementsByClassName("autocomplete-items");

      for (var i = 0; i < x.length; i++) {

        if (elmnt != x[i] && elmnt != inp) {

          x[i].parentNode.removeChild(x[i]);

        }

      }

    }

 

    document.addEventListener("click", function (e) {

        closeAllLists(e.target);

    });

  }

  

  /*An array containing all the related question*/

  var questions = [

      "What is bluebook?", "What is insurance?", "What is tax rate?",

      "Tax rate", "Tax rate of motorbike", "How to renew bluebook?",

      "first party insurance", "third party insurance", "What is first party insurance",

      "What is third party insurance", "What is vehicle registration number",

      "Where is the bluebook renew office", "bluebook renew office",

      "How much does the insurance for motorbike cost", "How much does the insurance for taxi cost",

      "How much does the insurance for scooter cost", "How much does the insurance cost",

      "What is the fine rate of tax?", "Fine rate tax", 

  ];

  

  /*initiate the autocomplete function on the "myInput" element, and pass along the questions array as possible autocomplete values:*/

  autocomplete(document.getElementById("myInput"), questions);

 