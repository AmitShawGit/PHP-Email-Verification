


let username = document.getElementById("username");
let mobile = document.getElementById("mobile");
let gmail = document.getElementById("email");
let password = document.getElementById("password");
let repass = document.getElementById("repass");

let flag = 1;

function validateForm() {
    /*username*/
    if (username.value == "") {
        document.getElementById("text").innerHTML = "Please fill the name";
        flag = 0;
    }
    else if (username.value.length < 4) {
        document.getElementById("text").innerHTML = "Please fill at least four character";
        flag = 0;
    }
    else {
        document.getElementById("text").innerHTML = "";
        flag = 1;
    }
 
    /*mobile*/
    if (mobile.value == "") {
        document.getElementById("phone").innerHTML = "Please fill the Number";
        flag = 0;
    }
    else if(mobile.value.length < 10){
         document.getElementById("phone").innerHTML = "Invalid Mobile Number";
         flag =  0;
    }
    else{
        document.getElementById("phone").innerHTML = "";
        flag = 1;
    }

    /*email*/
    if (gmail.value == ""){
        document.getElementById("mail").innerHTML = "Fill gmail";
        flag = 0;
    }
    else if(gmail.value == "gmail"){
        document.getElementById("mail").innerHTML = "Fill Valid Email";
        flag = 0;
    }
    else{
        document.getElementById("mail").innerHTML = "";
        flag = 1;
    }

       /*password*/
       if (password.value == ""){
        document.getElementById("pass").innerHTML = "Fill password";
        flag = 0;
    }
    else if(password.value.length  < 5){
        document.getElementById("pass").innerHTML = "atleast five character ";
        flag = 0;
    }
    else{
        document.getElementById("pass").innerHTML = "";
        flag = 1;
    }
     /*repassword*/
    




    /*Flag */
    if (flag) {
        return true;
    }
    else {
        return false;
    }
}
