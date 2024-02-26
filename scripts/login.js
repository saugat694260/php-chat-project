//importing from validate js
import {validateEmailOrPhone,validatePassword } from "../scripts/validation.js";

//elements in login page
const emailOrPhonenumber=document.getElementById("emailOrPhonenumber-js");
const errorMessageEmailOrPhonenumber=document.getElementById("error-message-emailOrPhonenumber-js");
const password=document.getElementById("password-js");
const errorMessagePassword=document.getElementById("error-message-password-js");
const submit=document.getElementById("submit-js");


//submit for login form
    if(submit && submit.value=='login'.trim()){
        submit.addEventListener('click',()=>{
        errorMessageEmailOrPhonenumber.innerHTML=validateEmailOrPhone(emailOrPhonenumber.value.trim());
        errorMessagePassword.innerHTML=validatePassword(password.value.trim());
    });
    }
