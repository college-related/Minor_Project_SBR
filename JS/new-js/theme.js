
let root = document.documentElement.style;

let theme = localStorage.getItem('theme')
let themeChanger = document.querySelector(".theme-setting")

let lightThemeColors = {
    'bgColor': '#fff',
    'textColor': '#000',
    'shadowColor': '#e2e2e2',
    'scrollColor': '#89A6F3',
    'reverseBgColor': '#fff',
    'borderColor': '#000'
}
let darkThemeColors = {
    'bgColor': '#252525',
    'textColor': '#e2e2e2',
    'shadowColor': '#000',
    'scrollColor': '#CAD8FC',
    'reverseBgColor': '#000',
    'borderColor': '#CCC'
}

if(theme == null){
    localStorage.setItem('theme', 'light')
    theme = localStorage.getItem('theme')
    localStorage.setItem('themeColors', JSON.stringify(lightThemeColors))
    localStorage.setItem('themeIcon', '<i class="far fa-moon"></i>')
}

let themeColor = JSON.parse(localStorage.getItem("themeColors"))
root.setProperty('--bg-color', themeColor.bgColor);
root.setProperty('--text-color', themeColor.textColor);
root.setProperty('--shadow-color', themeColor.shadowColor);
root.setProperty('--scroll-color', themeColor.scrollColor);
root.setProperty('--reverse-bg-color', themeColor.reverseBgColor);
root.setProperty('--border-color', themeColor.borderColor);
themeChanger.innerHTML = localStorage.getItem('themeIcon')

function darkMode(){
    root.setProperty('--bg-color', '#252525');
    root.setProperty('--text-color', '#e2e2e2');
    root.setProperty('--shadow-color', '#000');
    root.setProperty('--scroll-color', '#CAD8FC');
    root.setProperty('--reverse-bg-color', '#000');
    root.setProperty('--border-color', '#CCC');

    localStorage.setItem('theme', 'dark')
    localStorage.setItem('themeColors', JSON.stringify(darkThemeColors))
    localStorage.setItem('themeIcon', '<i class="far fa-sun"></i>')
    themeChanger.innerHTML = localStorage.getItem('themeIcon')
}

function lightMode(){
    root.setProperty('--bg-color', '#fff');
    root.setProperty('--text-color', '#000');
    root.setProperty('--shadow-color', '#e2e2e2');
    root.setProperty('--scroll-color', '#89A6F3');
    root.setProperty('--reverse-bg-color', '#fff');
    root.setProperty('--border-color', '#000');

    localStorage.setItem('theme', 'light')
    localStorage.setItem('themeColors', JSON.stringify(lightThemeColors))
    localStorage.setItem('themeIcon', '<i class="far fa-moon"></i>')
    themeChanger.innerHTML = localStorage.getItem('themeIcon')
}

themeChanger.addEventListener('click' , () => {
    if(localStorage.getItem('theme') == 'light')
        darkMode()
    else
        lightMode()
})