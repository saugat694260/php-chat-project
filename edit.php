<?php

session_start();
include('./phpfiles/connection.php');
include('./phpfiles/validation.php');
include('./phpfiles/utils.php');
$user_data=checkLogin($conn);

$separetedDateForEdit=seprateTheDates($user_data['DOB']);


?>
<?php

if($_SERVER["REQUEST_METHOD"]=="POST" ){


    if(isset($_POST["update"]) && isset($_POST["gender"])){

           
            $email=filter_input(INPUT_POST,'email',FILTER_SANITIZE_SPECIAL_CHARS);
            $phonenumber=filter_input(INPUT_POST,'phonenumber',FILTER_SANITIZE_SPECIAL_CHARS);
            $username=filter_input(INPUT_POST,'username',FILTER_SANITIZE_SPECIAL_CHARS);
            $password=filter_input(INPUT_POST,'password',FILTER_SANITIZE_SPECIAL_CHARS);
            $hash=password_hash($password,PASSWORD_DEFAULT);

            $day=$_POST["day"];
            $month=$_POST["month"];
            $year=$_POST["year"];
            $dob="{$year}-{$month}-{$day}";
            $userAge=calculateUserAgeFromSelectedDates($dob);

            $gender=$_POST["gender"];


        if(validateEmail($email)  && validateUsername($username) && validatePassword($password) && validateAge($userAge) && validateGender($gender)
||
validatePhone($phonenumber)  && validateUsername($username) && validatePassword($password) && validateAge($userAge) && validateGender($gender)
        ){
        
            
                   
                    
                
                   $query=" UPDATE users_data
                   SET email = '$email', 
                   phonenumber= '$phonenumber',
                   username= '$username',
                   `password`= '$password',
                   DOB= '$dob',
                   gender= '$gender'

                   
                   WHERE id={$user_data['id']}";
                    $conn->query($query);
                    header('refresh:0');
                    die;
                    }
                }
                else{
                    echo "something went wrong";
                }
               

       

            $conn->close();

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
                    <input type="text" id="email-js" name="email" placeholder="email">
                    <span id="error-message-emailOrPhonenumber-js"><?php if(isset($_POST["update"]))echo emailErrorMessage($_POST["email"]);?></span>

                    <input type="text" id="phonenumber-js" name="phonenumber" placeholder="Phonenumber">
                    <span id="error-message-emailOrPhonenumber-js"><?php if(isset($_POST["update"]))echo phoneErrorMessage($_POST["phonenumber"]);?></span>
                    <input type="text" id="username-js" name="username" placeholder="username">
                    <span id="error-message-username-js"><?php if(isset($_POST["update"])){echo usernameErrorMessage($_POST["username"]);}?></span>

                        <div>
                            <input type="password" id="password-js" name="password" placeholder="password">
                            <button class="show-and-hide-password" id="show-and-hide-password-js">show</button>
                        
                        </div>
                    <span id="error-message-password-js"><?php if(isset($_POST["update"]))echo passwordErrorMessage($_POST["password"]);?></span>
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
                 <span id="error-message-age-js"><?php if(isset($_POST["update"]))echo validateAgeErrorMessage(calculateUserAgeFromSelectedDates(("{$_POST['year']}-{$_POST['month']}-{$_POST['day']}")));?></span>
              
                 <div class="form-third-sub-container">
                    <label >male</label>
                    <input type="radio" name="gender" value="male" id="male-js">
                    <label>female</label>
                    <input type="radio" name="gender" value="female" id="female-js">
                    <label>others</label>
                    <input type="radio" name="gender" value="others" id="others-js">
                </div>
                <span id="error-message-gender-js"><?php /*shows this message if ratio button is not clicked but submit is clicked*/if(isset($_POST['update']) && !isset($_POST['gender'])){echo 'please select gender';};?></span>
                
                <div class="form-fourth-sub-container">
                <input type="submit" name="update" value="update" id="submit-js">
                </div>
    
                <div class="form-fifth-sub-container">
                    <p>already have an account?<a href="">login</a></p>
                    <p><a href="">forgot password?</a></p>
                </div>
    
            </div>
    
        </form>
    
    </div>
    
   
</div>

<script>
let email=document.getElementById('email-js');
let phonenumber=document.getElementById('phonenumber-js');
let username=document.getElementById('username-js');
let password=document.getElementById('password-js');
let day=document.getElementById('day-js');
let month=document.getElementById('month-js');
let year=document.getElementById('year-js');
let radioButton=document.getElementById('<?php echo $user_data['gender']?>-js');

email.value="<?php echo $user_data['email']?>".trim();
phonenumber.value=" <?php echo $user_data['phonenumber']?> ".trim();
username.value="<?php echo $user_data['username']?>".trim();
password.value=" <?php echo $user_data['password']?> ".trim();
day.value="<?php echo $separetedDateForEdit[2]?>".trim();
month.value="<?php echo $separetedDateForEdit[1]?>".trim();
year.value="<?php echo $separetedDateForEdit[0]?>".trim();
radioButton.checked=true;



</script>
    
</body></html>
