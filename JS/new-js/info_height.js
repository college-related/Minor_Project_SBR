var icon = document.getElementsByClassName("icon");
var i;
var holder= document.getElementsByClassName("info-holder")
for(i=0 ; i <holder.length ; i++){
    holder[i].addEventListener('click',function(e){
        if (e.currentTarget.style.height === 'fit-content' ) {
            e.currentTarget.style.height = "50px"; 
            plus.addEventListener('click', changeIcon());

        } 
        else {
            e.currentTarget.style.height = "fit-content";
            minus.addEventListener('click',changeIcon());
         }
    })
}
for (i = 0; i < icon.length; i++) {
    icon[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var holder = this.nextElementSibling;
        if (holder.style.maxHeight) {
        holder.style.maxHeight = null;
        } else {
        holder.style.maxHeight = holder.scrollHeight + "px";
        } 
    });
}
