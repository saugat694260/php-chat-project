
//importing date
import dayjs from "../utilities/utils.js";
//importing elements of register.js
import { male,female,others} from "../scripts/register.js";

    let now = dayjs();
    const todaysDay=now.$D;
    const todaysMonth=now.$M;
    const todaysYear=now.$y;

    //for email and phone
    export function validateEmailOrPhone(value){

    let EmailRegex=/^([a-z]{2,24})(\d{2,5})@([a-z]{2,10}).([a-z]{2,12}).([a-z]{2,12})?$/gmi;
    let phoneNumberRegex=/^[\d]{10}$/gm;

    if(EmailRegex.test(value)){
        return 'email is success';
    }

        else if(phoneNumberRegex.test(value)){
            return 'phone is success';
        }
        else if(value==""){
            return 'cannot be left empty'
        }

            else{
                return 'enter valid phone or email';
            }


    }
    //for username
    export  function validateUsername(value){
    let usernameRegex=/^([a-z]{2,12})([\d]{1,5})?$/gmi;
    if(usernameRegex.test(value)){
        return 'success'
    }
    else if(value==""){
        return 'cannot be left empty'
    }

    else{
        return 'please enter valid user name';
    }

    }
    //for password
    export function validatePassword(value){
    let passwordRegex=/^([\w]{5,})?([a-zA-Z]{5,})([0-9]{1,})(.{1,})?$/gim;

    if(passwordRegex.test(value)){
        return 'sucess';
    }
    else if(value==''){
        return 'cant leave field empty'
    }
    else{
        return 'your password is too weak'
    }
    }
    //for age
    export function validateAge(value1,value2,value3){

    let usersDay=Math.abs(todaysDay-value1);
    let usersMonth=Math.abs(todaysMonth-value2);
    let usersYear=Math.abs(todaysYear-value3);
    if(usersYear>8){
        return `${usersDay}-${usersMonth}-${usersYear}`
    }
    else{
        return `you dont meet requirment`
    }

    }
    //for gender
    export function validateGender(){

    if(male.checked){
    return 'male';
    }
    else if(female.checked){
    return 'female';
    }
    else if(others.checked){
    return 'others';
    }
    else{
    return'please select a gender';
    }


    }