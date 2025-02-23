const addPdtBtn = document.getElementById("jBtn");
const viewTblBtn = document.getElementById("jBtn2");
const productTable = document.querySelector(".productTable");
const addProuctSection = document.querySelector(".productAdd");

addPdtBtn.addEventListener("click", function(){
    addProuctSection.style.display = "flex";
    productTable.style.display = "none";
    addPdtBtn.style.display = "none";
    viewTblBtn.style.display = "block";
});

viewTblBtn.addEventListener("click", function(){
    addProuctSection.style.display = "none";
    productTable.style.display = "flex";
    addPdtBtn.style.display = "block";
    viewTblBtn.style.display = "none";
});