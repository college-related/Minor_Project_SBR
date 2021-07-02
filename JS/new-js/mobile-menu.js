
let mobileNav = document.querySelector(".mobile-nav")
let mobileMenu = document.querySelector(".mobile-menu")
let mobileCross = document.querySelector(".mobile-close-mark")
let mobileLog = document.querySelector("#mobile-log")

mobileNav.addEventListener('click', () => mobileMenu.classList.add("showMobile-Menu"))
mobileCross.addEventListener('click', () => mobileMenu.classList.remove("showMobile-Menu"))
mobileLog.addEventListener('click', () => mobileMenu.classList.remove("showMobile-Menu"))