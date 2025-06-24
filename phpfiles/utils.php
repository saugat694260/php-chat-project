<?php




$day=date('j');
$month=date('n');
$year=date('Y');


//to prevent the same function naming error
    if (!function_exists('calculateUserAgeFromSelectedDates')) { 
        function calculateUserAgeFromSelectedDates($dob){
            $year = (date('Y') - date('Y',strtotime($dob)));
             return $year;
        };
    } 

    if (!function_exists('seprateTheDates')) { 
        function seprateTheDates($dob){
            $sepratedDate=explode("-", $dob);
            return $sepratedDate;
        };
    } 

    if(!function_exists('randomNumbers')){
        function randomNumbers(){
            $text='';
            $text .= rand(0,1).rand(0,2).rand(0,3).rand(0,4).rand(0,5).rand(0,6).rand(0,7).rand(0,8).rand(0,9).time().floor(microtime(true)).date('d').date('n').date('Y');
                return $text;
        }
    }

//check if the user is logged in or not
if(!function_exists('checkLogin')){
    function checkLogin($conn){
        if(isset($_SESSION['userId'])){
          $userId=$_SESSION['userId'];
          $query="select * from users_data where userId='$userId' limit 1";  
          $result=$conn->query($query);

            if($result->num_rows>0){
                $user_data=$result->fetch_assoc();
                return $user_data;
            };
            
        }

        header("Location: index.php");
        die;
    };
}

//doesnt let to exit page with out loggingout
if(!function_exists('checkLoggedoutOrNot')){
    function checkLoggedoutOrNot(){
        if(isset($_SESSION['userId'])) {
            header("Location:index.php"); // redirects them to homepage
            die; 
        }
    }
}

//for queries
if(!function_exists('queryResult')){
    function queryResult($query,$connection){

       
        $data = array();
        $result=$connection->query($query);

       
          if($result->num_rows>0){
            while($row =$result->fetch_assoc())
            {
                $data[] = $row;
            }
    
            return $data;
          }
        
         

    };
}


?>

