var index = 0;
autoSlide();

function autoSlide(){
    var i;
    var slide = document.getElementsByClassName('slides');

    for(i = 0; i < slide.length; i++){
        slide[i].style.display = "none";
    }

    index++;

    if(index > slide.length){
        index = 1;
    }
    slide[index-1].style.display = "flex";
    setTimeout(autoSlide, 5000);
}