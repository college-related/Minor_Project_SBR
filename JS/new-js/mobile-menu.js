
let mobileNav = document.querySelector(".mobile-nav")
let mobileMenu = document.querySelector(".mobile-menu")
let mobileCross = document.querySelector(".mobile-close-mark")
let mobileLog = document.querySelectorAll(".mobile-log")

mobileNav.addEventListener('click', () => mobileMenu.classList.add("showMobile-Menu"))
mobileCross.addEventListener('click', () => mobileMenu.classList.remove("showMobile-Menu"))

for(mblBtn of mobileLog){
    mblBtn.addEventListener('click', () => mobileMenu.classList.remove('showMobile-Menu'))
}