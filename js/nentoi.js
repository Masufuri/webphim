/*const background_color = document.querySelector('body'),
a=document.querySelectorAll('a'),
title_phim = document.querySelectorAll('a>.title-phim');
background_color.style.backgroundColor = "#272a2c";
background_color.style.color = "white";
for(var j=0;j<title_phim.length;j++){
    title_phim[j].style.color="white";
    title_phim[j].textContent="ádaksdh";
}
for(var i=0;i<a.length;i++){
    a[i].style.color="white";
}
*/
const add = document.querySelector('.nentoi'),
checkboxnentoi=document.querySelector('.switch input[type=checkbox]');
let checknentoi=document.cookie.includes("nentoi=true");
//if()document.cookie="nentoi=false";
if(checknentoi==true)checkboxnentoi.checked=true;
function nentoi() {
    if(checkboxnentoi.checked==true){
    add.innerHTML="<link rel='stylesheet' type='text/css' href='css/nentoi.css'>";
    document.cookie="nentoi=true";
    }else{
        add.innerHTML="";
        document.cookie="nentoi=false";
    }
}