<?php 

include('../phpfiles/connection.php');
include('../phpfiles/utils.php');



//gets id and sends data 
if(isset($_POST['id'])) 
    { 
    $query="select * from `users_data` where  id={$_POST['id']}";
    $result=queryResult($query,$conn);

    if($result){

    foreach($result as $row){
            
            $photo="";
            if(isset($row['userProfile'])){
                $photo=$row['userProfile'];
            } else{
                $photo="profilePicture.png";
            }

            echo "<div class='user-profile-image-container' style='width:100px;background-color:black;height:100px'>
                    <img style='width:100%;height:100%' src='./userProfiles/".$photo."' alt='wryy'>
                </div>
                <div>
                    <p>".$row['username']."</p>
                    <p>".calculateUserAgeFromSelectedDates($row['DOB'])."</p>
                    <p>bio</p>
                    </div>
                </div>";
        }
    }

} 

?>

