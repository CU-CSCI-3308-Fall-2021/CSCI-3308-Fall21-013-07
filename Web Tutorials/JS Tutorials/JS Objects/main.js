/*let name01 = "Daniel";                NOT IDEAL
let eyeColour01 = "Blue";
let age01 = 27;

let name02 = "John";
let eyeColour02 = "Brown";
let age02 = 35;

let name03 = "Jane";
let eyeColour03 = "Brown";
let age03 = 47;

let updateAge = function(age) {
    return ++age;
} */ 

/* LONG HAND WAY

let person = new Object();

person.name = "Daniel";
person.eyeColor = "Blue";
person.age = 27;
person.updateAge = function() {
    return ++person.age;
} */

//SHORT HAND WAY
/*
let person = {
    name: "Daniel",
    eyeColor: "Blue",
    age: 27,
    updateAge: function() {
        return ++person.age;
    }
} */

//Object Constructor

function Person(name, eyeColor, age) {
    this.name = name;
    this.eyeColor = eyeColor;
    this.age = age;

    this.updateAge = function() {
        return ++this.age;
    }; //You need a semicolon here
}

let person01 = new Person("Daniel", "Blue", 27);