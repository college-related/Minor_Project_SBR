var show = document.getElementById("display");
var autoBtn = document.getElementById("autofill");
function reveal() {
    if (show.style.display === "none") {
        show.style.display = "block";
        // autoBtn.setAttribute("disabled", "true");
    } else {
        show.style.display = "none";       
        // autoBtn.removeAttribute("disabled");
    }
  }