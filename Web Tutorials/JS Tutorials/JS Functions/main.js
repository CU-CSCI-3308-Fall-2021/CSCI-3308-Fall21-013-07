/*
function testExample(name) {
    var greeting = "Hi! My name is " + name;
    return greeting;
}

console.log(testExample("Daniel"));
*/

/*
var testExample = function() { //<-- This is an anonymous function
    var greeting = "Hi! My name is Nick";
    return greeting;
}

console.log(testExample());
*/

(function() { //<--Immediately invoked functional expression
    var greeting = "Hi! My name is Nick";
    console.log(greeting);
}()) //<--The () allows you to invoke the function