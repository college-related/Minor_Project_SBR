
let icon = document.getElementsByClassName("icon");
let i;

for(i = 0 ; i < holder.length ; i++){
    icon[i].addEventListener('click',function(e){
        this.classList.toggle("active")
        const holder = e.currentTarget.parentElement;

        if (holder.parentElement.classList.contains('show')) {
            holder.parentElement.classList.remove('show');
        }else {
            holder.parentElement.classList.add('show');
        }
    })
}
