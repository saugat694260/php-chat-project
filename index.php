<?php

session_start();
include('./phpfiles/connection.php');
include('./phpfiles/validation.php');
include('./phpfiles/utils.php');
checkLoggedoutOrNot();

if(isset($_COOKIE['userId'])) {
    
        $_SESSION['userId']=$_COOKIE['userId'];
        header("Location:users.php");
        die;
    
 
} 



?>

<!DOCTYPE html>

<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--fonts from google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">

<!--style link-->
    <link rel="stylesheet" href="css/shared.css?=v<?php echo time();?>">
    <link rel="stylesheet" href="css/login.css">
<!--script link-->
<script type="module" src="scripts/login.js"></script>


<title>FORM VALIDATION</title>

</head>
<body>

<div class="page-main-container">

    <div class="form-main-container">

        <form class="form" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">

            <div class="form-container">
            <span>
 <?php
    if($_SERVER['REQUEST_METHOD']=='POST'){

    $EmailRegex="/^([a-z]{2,24})(\d{2,5})@([a-z]{2,10}).([a-z]{2,12}).([a-z]{2,12})?$/mi";
    $phoneNumberRegex="/^[\d]{10}$/m";

        if(isset($_POST['login'])){

        $emailOrPhonenumber=filter_input(INPUT_POST,'emailOrPhonenumber',FILTER_SANITIZE_SPECIAL_CHARS);
        $password=filter_input(INPUT_POST,'password',FILTER_SANITIZE_SPECIAL_CHARS);

            if(empty($emailOrPhonenumber) || empty($password)){
                 echo "please fill out all fields";
            }

                else if(!validateEmailOrPhone($emailOrPhonenumber) || !validatePassword($password)){
                    echo "please enter valid information";
                }

                    else  if(validateEmailOrPhone($emailOrPhonenumber) && validatePassword($password)){
                    //if user enters email
                        if(preg_match_all($EmailRegex,$emailOrPhonenumber)){
                            $query="select * from users_data where email='$emailOrPhonenumber' limit 1" ;
                            $result=$conn->query($query);

                                if($result && $result->num_rows>0){

                                     if($row=$result->fetch_assoc()){

                                            if (password_verify($password,$row['password'])) {
                                                if (password_verify($password,$row['password'])) {
                                                    $cookie_userId= $row['userId'];
                                                    setcookie('userId',$cookie_userId, time() + (86400 * 30), "/");
    
                                                    if(!isset($_COOKIE[$cookie_userId])) {
                                                        $_SESSION['userId']=$row['userId'];
                                                    } 
                                                }    
                                                header("Location: users.php");
                                                die;
                                            }
                                                else{
                                                echo"wrong password";
                                                }

                                    }
                                        else{
                                            echo 'something went wrong';
                                            }

                                }
                                    else{
                                        echo 'wrong email or phone';
                                        }

                         }

                         //if user uses phone number
                         if(preg_match_all($phoneNumberRegex,$emailOrPhonenumber)){
                            $query="select * from users_data where phonenumber='$emailOrPhonenumber' limit 1" ;
                            $result=$conn->query($query);

                                if($result && $result->num_rows>0){

                                     if($row=$result->fetch_assoc()){

                                            if (password_verify($password,$row['password'])) {
                                                $cookie_userId= $row['userId'];
                                                setcookie('userId',$cookie_userId, time() + (86400 * 30), "/");
                                                
                                                if(!isset($_COOKIE[$cookie_userId])) {
                                                    $_SESSION['userId']=$row['userId'];
                                                } 

                                               
                                                header("Location:users.php");
                                                die;
                                            }
                                                else{
                                                echo"wrong password";
                                                }

                                    }
                                        else{
                                            echo 'something went wrong';
                                            }

                                }
                                    else{
                                        echo 'wrong email or phone';
                                        }

                         }
                    }
        };
    $conn->close();

    };
?>
            </span>
                <div class="form-first-sub-container">
                    <input type="text" name="emailOrPhonenumber" placeholder="email Or Phonenumber" id="emailOrPhonenumber-js">

                        <div>
                            <input type="password" name="password" placeholder="password" id="password-js">
                            <button class="show-and-hide-password" id="show-and-hide-password-js">show</button>
                        </div>
                </div>


                <div class="form-second-sub-container">
                <input type="submit" name="login" value="login" id="submit-js">
                </div>

                <div class="form-third-sub-container">
                <p>dont have an account?<a href="register.php">sign up</a></p>
                <p><a href="">forgot password?</a></p>
                </div>

            </div>

        </form>

    </div>

    <div class="title-main-container">
        <div class="title-first-sub-container">
            <p>easa</p>
        </div>

        <div class="title-second-sub-container">
        <p>enjoy your life</p>
        </div>
    </div>
</div>

</body>
</html>
<!--https://www.geeksforgeeks.org/best-approach-for-keep-me-logged-in-using-php/-->