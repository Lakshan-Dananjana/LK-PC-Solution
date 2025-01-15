let adminPwd = document.getElementById('adminPwd');
let show = document.getElementById('show');
let hide = document.getElementById('hide');
let showicon = document.getElementById('showicon');
let hideicon = document.getElementById('hideicon');

show.addEventListener("click",function(){
    showicon.style.display = "none";
    hideicon.style.display = "flex";
    adminPwd.type = "text";
});

hide.addEventListener("click",function(){
    hideicon.style.display = "none";
    showicon.style.display = "flex";
    adminPwd.type = "password";
});