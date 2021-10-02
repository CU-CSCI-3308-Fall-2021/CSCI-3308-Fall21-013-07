/* Method 1 (Messier) AKA Event Handler
let btn = document.querySelector(".test-btn");

function firstFunction() {
    btn.innerHTML = "YAY";
}

function secondFunction() {
    btn.style.backgroundColor = "red";
}

function btnClick(e) {
    e.preventDefault();
    firstFunction();
    secondFunction();
}

btn.onclick = btnClick;//Can have only one function otherwise the bottom will override the previous methods
*/

//Event Listener Method
let btn = document.querySelector(".test-btn");

function firstFunction(e, name) {
    e.preventDefault();
    btn.innerHTML = name;
}

//This is a way around needing parameters which would otherwise make it automatically run
btn.addEventListener("click", function(e) {  //Need e in anonymous function to connect it
    firstFunction(e, "Daniel");
});
btn.addEventListener("click", function() {
    btn.style.backgroundColor = "lightblue";
    console.log(btn.style.backgroundColor);
});