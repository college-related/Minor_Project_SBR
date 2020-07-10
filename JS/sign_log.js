
var signupForm = document.getElementById("signupForm");
var loginForm = document.getElementById("loginForm");

function logPopUp() {
    signupForm.style.display = "none";
    loginForm.style.display = "block";
}

function signPopUp() {
    signupForm.style.display = "block";
    loginForm.style.display = "none";
}

document.querySelector("#toLogLink").addEventListener('click', logPopUp);
document.querySelector("#toSignLink").addEventListener('click', signPopUp);