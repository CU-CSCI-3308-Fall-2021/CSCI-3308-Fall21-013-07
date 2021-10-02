var a = "First", b = "Second", c = "Third";
//To prevent variables from being hoisted, place them in their respective functions

console.log(a + " " + b + " " + c);

console.log(d);

var d = "Fourth"; //When it's hoisted to the top, its value is not hoisted

console.log(d);

console.log(example()); //Like with variables, named functions are hoisted

function example() { //To prevent function hosting, use anonymous functions
    var a = 10;
    return a;
}

console.log(example());

console.log(funct); //Hurray, no more hoisting here!

var funct = (function() {
    var a = 7;
    return a;
}())

console.log(funct);

var a = function() {
    var b = 20;
    return b;
}

console.log(a());