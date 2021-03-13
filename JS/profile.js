var btns = document.getElementsByClassName('btn');
var detailSections = document.getElementsByClassName('profile-detail-section');

var basicBtn = document.getElementsByClassName('basic-btn')[0];
var taxBtn = document.getElementsByClassName('tax-btn')[0];
var formBtn = document.getElementsByClassName('latest-form-btn')[0];

var basicDetail = document.getElementsByClassName('basic-detail')[0];
var taxDetail = document.getElementsByClassName('tax-detail')[0];
var formDetail = document.getElementsByClassName('form-detail')[0];

function removeActiveBtnClass(){
    for(var i = 0; i < btns.length; i++){
        btns[i].classList.remove('active-btn');
    }
}

function removeAllDetailSection(){
    for(var i = 0; i < detailSections.length; i++){
        detailSections[i].style.display = 'none';
    }
}

basicBtn.addEventListener('click', function (){
    removeActiveBtnClass();
    removeAllDetailSection();
    basicBtn.classList.add('active-btn');
    basicDetail.style.display = 'block';
});

taxBtn.addEventListener('click', function (){
    removeActiveBtnClass();
    removeAllDetailSection();
    taxBtn.classList.add('active-btn');
    taxDetail.style.display = 'block';
});

formBtn.addEventListener('click', function (){
    removeActiveBtnClass();
    removeAllDetailSection();
    formBtn.classList.add('active-btn');
    formDetail.style.display = 'block';
});