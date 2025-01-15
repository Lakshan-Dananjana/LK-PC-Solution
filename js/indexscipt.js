let pwd1 = document.getElementById("pwd1");
let show = document.getElementById("show");
let hide = document.getElementById("hide");
let showicon = document.getElementById("showicon");
let hideicon = document.getElementById("hideicon");


show.addEventListener("click",function(){
    showicon.style.display = "none";
    hideicon.style.display = "flex";
    pwd1.type = "text";
});

hide.addEventListener("click",function(){
    hideicon.style.display = "none";
    showicon.style.display = "flex";
    pwd1.type = "password";
});