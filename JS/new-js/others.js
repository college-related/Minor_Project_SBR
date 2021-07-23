let show = document.getElementById("display");
let autoBtn = document.getElementById("autoFill");
let autoOtherBtn = document.getElementById("autoOtherFill");
let check = document.querySelector('#check');

function reveal() {
    if (show.style.display === "none" || show.style.display == "") {
        show.style.display = "block";
        check.innerHTML = '<i class="fas fa-check-circle"></i>';
        autoBtn.style.display = "none";
        autoOtherBtn.style.display = "block";
    
        if(window.location.href == 'http://localhost/MINOR_PROJECT_SBR/PAGES/form.php?autoFill=Auto-Fill')
            autoOtherBtn.children.item(0).click()
    } else {
        show.style.display = "none";
        check.innerHTML = '<i class="far fa-check-circle"></i>';
        autoBtn.style.display = "block";
        autoOtherBtn.style.display = "none";

        console.log(window.location.href)
        if(window.location.href == 'http://localhost/MINOR_PROJECT_SBR/PAGES/form.php?autoOtherFill=Auto-Fill')
            autoBtn.children.item(0).click()
    }
}