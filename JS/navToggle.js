var nav = document.getElementById('navMenu');
var btn = document.getElementById('navToggler');

function toggleNav(){
    if(nav.style.display == ''){
        nav.style.display = 'block';
    }else{
        nav.style.display = '';
    }
}

btn.addEventListener('click', toggleNav);