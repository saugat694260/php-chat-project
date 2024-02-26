
//importing validation js
import {validateEmailOrPhone,validateUsername,validatePassword,validateAge,validateGender  } from "../scripts/validation.js";
//importing date
import dayjs from "../utilities/utils.js";
//function of dayjs
let now = dayjs();
const todaysDay=now.$D;
const todaysMonth=now.$M;
const todaysYear=now.$y;

//day,month,year
const day=document.getElementById("day-js");
const month=document.getElementById("month-js");
const year=document.getElementById("year-js");



//adding dates on the day,month,year
const formSecondSubContainer=document.getElementById('form-second-sub-container-js');
//only runs if the container is present
if(formSecondSubContainer){
     addDatesInSelect();
}

function addDatesInSelect(){
    //loop for day
    for(let i=1;i<=32;i++){
        let html;
        html=`
        <option value="${i}">${i}</option>`;
        day.innerHTML+=html;
    }
    //loop for month
    for(let i=1;i<=12;i++){
        let html;
        html=`
        <option value="${i}">${i}</option>`;
        month.innerHTML+=html;
    }
    //loop for year
    for(let i=1905;i<=now.$y;i++){
        let html;
        html=`
        <option value="${i}">${i}</option>`;
        year.innerHTML+=html;
    }
}

//elements in register page
const emailOrPhonenumber=document.getElementById("emailOrPhonenumber-js");
const errorMessageEmailOrPhonenumber=document.getElementById("error-message-emailOrPhonenumber-js")
const username=document.getElementById("username-js");
const errorMessageUsername=document.getElementById('error-message-username-js');
const errorMessageAge=document.getElementById('error-message-age-js')
const password=document.getElementById("password-js");const errorMessagePassword=document.getElementById("error-message-password-js");
export const male=document.getElementById('male-js');
export const female=document.getElementById('female-js');
export const others=document.getElementById('others-js');
const errorMessageGender=document.getElementById("error-message-gender-js");
const submit=document.getElementById("submit-js");


 //submit for fourms of regestration
/**
 * if(submit && submit.value=='sign up'.trim()){
    submit.addEventListener('click',()=>{
       
        errorMessageEmailOrPhonenumber.innerHTML=validateEmailOrPhone(emailOrPhonenumber.value.trim());
        errorMessageUsername.innerHTML=validateUsername(username.value.trim());
        errorMessageAge.innerHTML=validateAge(day.value.trim(),month.value.trim(),year.value.trim());
        errorMessagePassword.innerHTML=validatePassword(password.value.trim());
        errorMessageGender.innerHTML=validateGender();
        });
}
 */







