const show = document.getElementById('show');
const close = document.getElementById('close');
const showIcon = document.getElementById('showIcon');
const closeIcon = document.getElementById('closeIcon');
const navLink = document.querySelector('.navLink');

show.addEventListener('click',function(){
    navLink.style.display = "flex";
    showIcon.style.display = "none";
    closeIcon.style.display = "flex";
});
close.addEventListener('click',function(){
    navLink.style.display = "noen";
    showIcon.style.display = "flex";
    closeIcon.style.display = "none";
    navLink.setAttribute("style","");
})