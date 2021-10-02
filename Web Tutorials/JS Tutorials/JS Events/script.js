let menuBtn = document.querySelector(".menu-btn");
let menu = document.querySelector(".menu");
let menuStatus = false;

menu.style.marginLeft = "-300px";

function menuToggle() {
    if (!menuStatus) {
        menu.style.marginLeft = "0px";
        menuStatus = true;
    } else if (menuStatus){
        menu.style.marginLeft = "-300px";
        menuStratus = false;
    }
}

menuBtn.onclick = menuToggle; //DO NOT PUT PARENTHESIS SO THAT IT DOES NOT IMMEDIATELY START