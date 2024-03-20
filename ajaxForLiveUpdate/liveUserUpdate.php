<?php
SESSION_START();
include('../phpfiles/connection.php');
include('../phpfiles/utils.php');

//On page 2
$user_data=checkLogin($conn);



if(isset($user_data)){

    $query="update users_data set onlineStatus='online' where id={$user_data['id']} " ;
    $result=$conn->query($query);
}
if(!isset($user_data)){
    $query="update users_data set onlineStatus='offline' where id={$user_data['id']} " ;
    $result=$conn->query($query);
}


$query="select * from users_data where not id={$user_data['id']}";
$result=$conn->query($query);
if($result->num_rows>0){
    while($row=$result->fetch_assoc()){?>
       <div class="user-status"><div class="user-info"><div class="profile-pic-image-container"><img src="userProfiles/<?php if(isset($row['userProfile'])){echo "{$row['userProfile']}";} else{echo "profilePicture.png";} ?>" alt="wryy"></div><a href="conversations.php? id=<?php echo $row["id"]; ?>"><?php echo $row["username"];
   ?></div><span class="offline-or-online-status" <?php if($row['onlineStatus']=='online'){ echo 'style="background-color:green"';} ?>></span> </div><?php }

}
;



?>

<script>
    /**
     * 
     */
</script>