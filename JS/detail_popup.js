var overlayBg = document.getElementsByClassName("bg-overlay")[0]
var overlayPopup = document.getElementsByClassName("detail-popup")[0]

function openEditPopup(){
    // addEventListener('scroll',window_lock);
    overlayBg.style.display ="block";
    overlayPopup.style.display="block";
}
function closedEditPopup(){
    overlayBg.style.display="none";
    overlayPopup.style.display="none";
}