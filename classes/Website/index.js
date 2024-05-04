// A variable is a containeer for storing data
// A variable behave as if it was the value that it contains
// Two steps:

// 1. Declaration (var,let,const)
// 2.Assignment ("Assignment operator")

//let age;
//age = 22;

//age = age + 1;
/*let firstName = "Tharushi"; //string
let age = 22; // numbers
let Student = true; //boolean

console.log("Hello", firstName);
console.log("You Are", age, "Years Old");
console.log("Enrolled", Student);

document.getElementById("p1").innerHTML = "Hello " + firstName;
document.getElementById("p2").innerHTML = "You Are " + age + "Years Old";
document.getElementById("p3").innerHTML = "Enrolled " + Student;

/*  
Arithmetic Expression is a combination of....
operand (values,numbers,variables)
operators(+,-,*,/,%)
that can be evaluated to a signle value
ex:y=x*8;
*/

//let students = 20;

//students = students + 1;
//students = students - 1;
//students = students * 2;
//students = students / 2;
//let extraStudent = students % 2;

//console.log(extraStudent);

// How to accept user input
// 1.Easy way with a window prompt

//let username = window.prompt("What is your name");
//console.log(username);

//  2.difficult way html text box

/*let username;
document.getElementById("myButton").onclick = function () {
  username = document.getElementById("myText").Value;
  console.log(username);
  document.getElementById("myLabel").innerHTML = "Hello" + username;
};*/

//  type conversion = change the datatype of a value to another (string,numbers,booleans)

/*let age = window.prompt("How old are you?");
console.log(typeof age);
age = Number(age);
console.log(typeof age);
age += 1;
console.log("happy birthday you are ", age, "years old are you");*/

/*let x;
let y;
let z;

x = Number("3.14");
y = String(3.14);
z = Boolean("yes");

console.log(x, typeof x);
console.log(y, typeof y);
console.log(z, typeof z);*/

// const = a variable that can not be changed

/*const PI = 3.14159;
let radius;
let circumference;*/

//PI = 420.69;(with const we cant use like this becz if we use const keyword it cannot change variables)

/*radius = window.prompt("Enter the radius of a circle");
radius = Number(radius);

circumference = 2 * PI * radius;
console.log("The circumference is:", circumference);*/

// Math ( an intrinsic object that provides basic mathematics functionality and constants)
/*let x = 3.14;
let y = 2;
let z = 3;
let max;
let min;*/
//x = Math.round(x);
//x = Math.ceil(x);
//x = Math.floor(x);
//x = Math.sqrt(x);
//x = Math.abs(x);
//x = Math.pow(x, 2);
//max = Math.max(x, y, z);
//min = Math.min(x, y, z);
//let x;
//x = Math.PI;
//console.log(x);

//triangle

/*let a;
let b;
let c;

a = window.prompt("Enter side A");
//a = Number(a);
b = window.prompt("Enter side B");
//b = Number(b);

c = Math.pow(a, 2) + Math.pow(b, 2);
c = Math.sqrt(c);
console.log(c);*/

/*document.getElementById("submitButton").onclick = function () {
  a = document.getElementById("aTextBox").value;
  a = Number(a);

  b = document.getElementById("bTextBox").value;
  b = Number(b);

  c = Math.pow(a, 2) + Math.pow(b, 2);
  c = Math.sqrt(c);

  document.getElementById("cLabel").innerHTML = "side C:" + c;
};*/

/*let count = 0;

document.getElementById("decreaseBtn").onclick = function () {
  count -= 1;
  document.getElementById("countLabel").innerHTML = count;
};
document.getElementById("resetBtn").onclick = function () {
  count = 0;
  document.getElementById("countLabel").innerHTML = count;
};
document.getElementById("increaseBtn").onclick = function () {
  count += 1;
  document.getElementById("countLabel").innerHTML = count;
};*/

/*math.random()--> this function use to genarate a pseudo random floating point number in the range from 0-1
0(inclusive)to 1(exclusive). the genarate number is decimal value between 0 and 1.*/

//let x = Math.random();
//let x = Math.random() * 6;
//let x = Math.floor(Math.random() * 6);(0to5  6 is not included)
//let x = Math.floor(Math.random() * 6) + 1;(0to6)

/*let x;
let y;
let z;

document.getElementById("rollButton").onclick = function () {
  x = Math.floor(Math.random() * 6) + 1;
  y = Math.floor(Math.random() * 6) + 1;
  z = Math.floor(Math.random() * 6) + 1;

  document.getElementById("xLabel").innerHTML = x;
  document.getElementById("yLabel").innerHTML = y;
  document.getElementById("zLabel").innerHTML = z;
};*/

// useful string properties and methods

//let userName = "Bro Code";
//let phoneNumber = "0781902711";

//console.log(userName.length);
//console.log(userName.toUpperCase);
//console.log(userName.toLowerCase);
//console.log(userName.charAt(0));
//console.log(userName.indexOf("D"));
//console.log(userName.lastIndexOf("i"));
//console.log(userName.substring(0, 8));

// method chaining = calling one method after another in one continuous line of code

/*let userName = "tharushi";
let letter = userName.charAt(0).toUpperCase().trim();

console.log(letter);*/

// if statement = a basic form of decision making if a condition is true  then do somthing if not then dont do it

/*let age = 22;

if (age >= 18) {
  console.log("you are an adult");
} else if (age <= 65) {
  console.log("you are a senior citizen");
} else if (age <= 0) {
  console.log("you are not born yet");
} else {
  console.log("you are a child");
}*/

/*let online = true;
if (online) {
  console.log("you are online");
} else {
  console.log("you are offline");
}*/
