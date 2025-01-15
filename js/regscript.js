const password = document.getElementById("password");
const show1 = document.getElementById("show1");
const hide1 = document.getElementById("hide1");
const showicon1 = document.getElementById("showicon1");
const hideicon1 = document.getElementById("hideicon1");



show1.addEventListener("click",function(){
    showicon1.style.display = "none";
    hideicon1.style.display = "flex";
    password.type = "text";
});

hide1.addEventListener("click",function(){
    hideicon1.style.display = "none";
    showicon1.style.display = "flex";
    password.type = "password";
});


const cpassword = document.getElementById("cpassword");
const show2 = document.getElementById("show2");
const hide12= document.getElementById("hide2");
const showicon2 = document.getElementById("showicon2");
const hideicon2= document.getElementById("hideicon2");

show2.addEventListener("click",function(){
    showicon2.style.display = "none";
    hideicon2.style.display = "flex";
    cpassword.type = "text";
});

hide2.addEventListener("click",function(){
    hideicon2.style.display = "none";
    showicon2.style.display = "flex";
    cpassword.type = "password";
});