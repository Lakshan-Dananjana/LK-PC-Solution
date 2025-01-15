const fpassword = document.getElementById("fpassword");
const fshow = document.getElementById("fshow");
const fhide = document.getElementById("fhide");
const fshowicon = document.getElementById("fshowicon");
const fhideicon = document.getElementById("fhideicon");

fshow.addEventListener("click",function(){
    fpassword.type = "text";
    fshowicon.style.display = "none";
    fhideicon.style.display = "flex";
});

fhide.addEventListener("click",function(){
    fpassword.type = "password";
    fshowicon.style.display = "flex";
    fhideicon.style.display = "none";
});

const fcpassword = document.getElementById("fcpassword");
const fshow1 = document.getElementById("fshow1");
const fhide1 = document.getElementById("fhide1");
const fshowicon1 = document.getElementById("fshowicon1");
const fhideicon1 = document.getElementById("fhideicon1");

fshow1.addEventListener("click",function(){
    fcpassword.type = "text";
    fshowicon1.style.display = "none";
    fhideicon1.style.display = "flex";
});

fhide1.addEventListener("click",function(){
    fcpassword.type = "password";
    fshowicon1.style.display = "flex";
    fhideicon1.style.display = "none";
});