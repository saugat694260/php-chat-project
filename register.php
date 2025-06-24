<?php 
session_start();
include('./phpfiles/connection.php');
include('./phpfiles/validation.php');
include('./phpfiles/utils.php');
checkLoggedoutOrNot();

?>
<!--php code to insert data-->
<?php

if($_SERVER["REQUEST_METHOD"]=="POST" ){


    if(isset($_POST["register"]) && isset($_POST["gender"])){

            $userId=randomNumbers();
echo $userId;
            $emailOrPhonenumber=filter_input(INPUT_POST,'emailOrPhonenumber',FILTER_SANITIZE_SPECIAL_CHARS);
            $username=filter_input(INPUT_POST,'username',FILTER_SANITIZE_SPECIAL_CHARS);
            $password=filter_input(INPUT_POST,'password',FILTER_SANITIZE_SPECIAL_CHARS);
            $hash=password_hash($password,PASSWORD_DEFAULT);

            $day=$_POST["day"];
            $month=$_POST["month"];
            $year=$_POST["year"];
            $dob="{$year}-{$month}-{$day}";
            $userAge=calculateUserAgeFromSelectedDates($dob);

            $gender=$_POST["gender"];

            $EmailRegex="/^([a-z]{2,24})(\d{2,5})@([a-z]{2,10}).([a-z]{2,12}).([a-z]{2,12})?$/mi";
            $phoneNumberRegex="/^[\d]{10}$/m";



        if(validateEmailOrPhone($emailOrPhonenumber) && validateUsername($username) && validatePassword($password) && validateAge($userAge) && validateGender($gender) && $userId){
        
                //if user enters email
                if(preg_match_all($EmailRegex,$emailOrPhonenumber)){
                    $query="insert into users_data(userId,email,username,password,DOB,gender) values('$userId','$emailOrPhonenumber','$username','$hash','$dob','$gender')";
                    $conn->query($query);
                    header('Location:login.php');
                    die;

                }
                //if user enters phone
                if(preg_match_all($phoneNumberRegex,$emailOrPhonenumber)){
                    $query="insert into users_data(userId,phonenumber,username,password,DOB,gender) values('$userId','$emailOrPhonenumber','$username','$hash','$dob','$gender')";
                    $conn->query($query);
                    header('Location:index.php');
                    die;
                }

        };

            $conn->close();

    };

};

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
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/shared.css">

<!--script link-->
    <script type="module" src="scripts/register.js"></script>


<title>register</title>

</head>
<body>

<div class="page-main-container">

    <div class="form-main-container">
        <form class="form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        
            <div class="form-container">
                <div class="form-first-sub-container">
                    <input type="text" id="emailOrPhonenumber-js" name="emailOrPhonenumber" placeholder="email Or Phonenumber">
                    <span id="error-message-emailOrPhonenumber-js">
                        <?php if(isset($_POST["register"]))echo emailOrPhoneErrorMessage($_POST["emailOrPhonenumber"]);?>
                    </span>

                    <input type="text" id="username-js" name="username" placeholder="username">
                    <span id="error-message-username-js">
                        <?php if(isset($_POST["register"])){echo usernameErrorMessage($_POST["username"]);}?>
                    </span>

                        <div>
                            <input type="password" id="password-js" name="password" placeholder="password">
                            <button class="show-and-hide-password" id="show-and-hide-password-js">show</button>
                        
                        </div>
                    <span id="error-message-password-js">
                        <?php if(isset($_POST["register"]))echo passwordErrorMessage($_POST["password"]);?>
                    </span>
                    </div>

                <div class="form-second-sub-container" id="form-second-sub-container-js">
                    <label >day:</label>
                    <select name="day" id="day-js">
                    </select>
    
                    <label >month:</label>
                    <select name="month" id="month-js">
                       
                    </select>
    
                    <label>year:</label>
                    <select name="year" id="year-js">
                    </select>
                 </div>
                 <span id="error-message-age-js">
                    <?php if(isset($_POST["register"]))echo validateAgeErrorMessage(calculateUserAgeFromSelectedDates(("{$_POST['year']}-{$_POST['month']}-{$_POST['day']}")));?>
                </span>
              
                 <div class="form-third-sub-container">
                    <label >male</label>
                    <input type="radio" name="gender" value="male" id="male-js">
                    <label>female</label>
                    <input type="radio" name="gender" value="female" id="female-js">
                    <label>others</label>
                    <input type="radio" name="gender" value="others" id="others-js">
                </div>
                <span id="error-message-gender-js">
                    <?php /*shows this message if ratio button is not clicked but submit is clicked*/
                    if(isset($_POST['register']) && !isset($_POST['gender'])){echo 'please select gender';};
                    ?>
                </span>
                
                <div class="form-fourth-sub-container">
                <input type="submit" name="register" value="sign up" id="submit-js">
                </div>
    
                <div class="form-fifth-sub-container">
                    <p>already have an account?<a href="index.php">login</a></p>
                    <p><a href="">forgot password?</a></p>
                </div>
    
            </div>
    
        </form>
    
    </div>
    
    <div class="title-main-container">
        <div class="title-first-sub-container">
            <p>zaza</p>
        </div>
        
        <div class="title-second-sub-container">
         <p>enjoy your life</p>
        </div>
    </div>
</div>


</body>
</html>
<!--$_COOKIEcreate table users_data(
    id int primary key AUTO_INCREMENT
  ,userId varchar(255) not null,
    email varchar(255),
    phonenumber varchar(255),
    username varchar(255) not null,
    password varchar(255) not null,
    DOB varchar(255),
    gender varchar(20),
    registeredTime timestamp
                       );-->