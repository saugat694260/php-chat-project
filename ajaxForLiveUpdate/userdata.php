<?php 

include('../phpfiles/connection.php');
include('../phpfiles/utils.php');


  
// Checking, if post value is 
// set by user or not 
if(isset($_POST['id'])) 
{ 
    $query="select * from `users_data` where  id={$_POST['id']}";
    $result=$conn->query($query);
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            $photo="";
            if(isset($row['userProfile'])){$photo=$row['userProfile'];} else{$photo="profilePicture.png";}

            echo "<div class='user-profile-image-container' style='width:100px;background-color:black;height:100px'>
            <img style='width:100%;height:100%' src='./userProfiles/".$photo."' alt='wryy'>
</div>
<div class='close-profile-information-container'>
<p>".$row['username']."</p>
<p>".calculateUserAgeFromSelectedDates($row['DOB'])."</p>
<p>bio</p>
</div>
  </div>";
        }}
    
} 

?>

