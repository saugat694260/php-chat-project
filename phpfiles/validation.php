<?php
include("utils.php");
?>

<?php


    //for email and phone
    function validateEmailOrPhone($value){

        $EmailRegex="/^([a-z]{2,24})(\d{2,5})@([a-z]{2,10}).([a-z]{2,12}).([a-z]{2,12})?$/mi";
        $phoneNumberRegex="/^[\d]{10}$/m";

            if(preg_match_all($EmailRegex,$value)){
            return true;

            }
            
                else if(preg_match_all($phoneNumberRegex,$value)){
                return true;
                }

                    else{
                    return false;
                    }

    };

    //email or phone error message
    function emailOrPhoneErrorMessage($value){

        if(empty($value)){
            return 'dont leave this field empty';
        }
            else if(!validateEmailOrPhone($value) ){
                return 'invalid email';
            };

    };

    //for username
    function validateUsername($value){
        $usernameRegex="/^([a-z]{3,12})([\d]{1,5})?$/mi";
            if(preg_match_all($usernameRegex,$value)){
            return true;
            }
                else{
                return false;
                }

    }

    //username error message
    function usernameErrorMessage($value){
        if(empty($_POST["username"])){
            return 'dont leave this field empty';
        }
            else if(!validateUsername($value)){
                return 'invalid username';
            }

    }

    //for password
    function validatePassword($value){
        $passwordRegex="/^([\w]{5,})?([a-zA-Z]{5,})([0-9]{1,})(.{1,})?$/im";

            if(preg_match_all($passwordRegex,$value)){
            return true;
            }

                else{
                return false;
                }
    }

    //errormessage for password
    function passwordErrorMessage($value){
        if(empty($value)){
            return 'dont leave this field empty';
        }
            else if(!validatePassword($value)){
                return 'too weak password';
            }
                else{
                    return 'invalid';
                }

    }

    //for age
    function validateAge($userAge){
        if($userAge>8){
        return true ;
        }
            
            else{
            return false;
            }

    }

    ////errormessage for age
    function validateAgeErrorMessage($value){
    if(!validateAge($value)){
        return 'you dont meet requirment';
    };

    };
    //for gender
    function validateGender($value){

        if(!empty($value)){
        return true;
        }
            else{
            return false;
            }
    };

    //for login page
    function loginErrorEmailOrPhoneMessages($value){
        if($value==false){
            return false;
        }
        else{
            return true;
        }
    }
    function loginErrorPasswordMessages($value){
        if($value==false){
            return false;
        }
        else{
            return true;
        }
    }
?>