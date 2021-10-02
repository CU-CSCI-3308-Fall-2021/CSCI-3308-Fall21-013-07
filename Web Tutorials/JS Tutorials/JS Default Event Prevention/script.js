let btn = document.querySelector(".test-btn");
let form = document.querySelector(".test-form");

function changeBtnText(e) {
    e.preventDefault();
    btn.innerHTML = "Yay!";
}

function stopFormSubmit(e) {
    e.preventDefault();
}

btn.onclick = changeBtnText;
form.onclick = stopFormSubmit;