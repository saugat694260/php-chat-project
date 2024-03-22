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
if(isset($_POST['show-profile-button'])){
    header('location:users.php');
}

$query="select * from users_data where not id={$user_data['id']}";
$result=$conn->query($query);
if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
        
        ?>

       <div class="user-status"><div class="user-info"><button name="show-profile-button" class="profile-pic-image-container see-profile-js" data-profile-id="<?php echo $row['id']?>">
        <img  src="userProfiles/<?php if(isset($row['userProfile'])){echo "{$row['userProfile']}";} else{echo "profilePicture.png";} ?>" alt="wryy">
       </button>
       <a href="conversations.php? id=<?php echo $row["id"]; ?>"><?php echo $row["username"];
   ?>
   <span style="position:absolute;left:0px;">



<?php
   try
               {
                 
                $query2="select * from `{$user_data['id']}"."{$row['id']}` order by id desc limit 1";
                $result2=$conn2->query($query2);
                    if($result2->num_rows>0){
                     
                        while($row2=$result2->fetch_assoc()){
                          
                            
                            ?><span style="width:50px ;position:absolute;right:0px;text-align: right;">
                           
                            <?php
                        
                            if($user_data['id']==$row2['userId']){ 
                                
                                echo 'sent';
                            }
                            else{
                                echo 'recived';
                              
                            }
                            
                            ?>
                           
                            </span><span style="<?php
                            
                            if($user_data['id']==$row2['userId']){ 
                                
                                echo "color:black;font-weight:normal;position:absolute;right:0px;";
                            }
                            else{
                              
                                echo "color:black;font-weight:bold;position:absolute;right:0px;";
                            }
                            ?>"><?php
                           ?>

                            
                            <?php
                                 echo $row2['message'];
                           
                        }
                           ?> </span><?php
                      
                     
                  }
                  else{
                  
                  }
      
                }
               catch( mysqli_sql_exception)
               {
           
                   //second try catch
               try{
           
                $query2="select * from `{$row['id']}"."{$user_data['id']}` order by id desc limit 1";
                $result2=$conn2->query($query2);
                    if($result2->num_rows>0){
                     
                        while($row2=$result2->fetch_assoc()){
                          
                            
                            ?><span style="width:50px ;position:absolute;right:0px;text-align: right;">
                            <?php
                            if($user_data['id']==$row2['userId']){ 
                                
                                echo 'sent';
                            }
                            else{
                                echo 'recived';
                              
                            }
                            
                            ?>
                           
                            </span><span style="<?php
                            
                            
                            if($user_data['id']==$row2['userId']){ 
                                
                                echo "color:black;font-weight:normal;position:absolute;right:0px;";
                            }
                            else{
                                
                                echo "color:black;font-weight:bold;position:absolute;right:0px;";
                            }
                            
                            ?>"<?php
                         ?>
                            
                            ><?php
                           echo $row2['message'];
                            }
                            ?></span><?php
                           
                      
                     
                  }
                  else{
                  
                  }
      
                       }catch(mysqli_sql_exception){
           
                      } }
                      
                      
               ?></span>








</span></a>
</div><span class="offline-or-online-status" <?php if($row['onlineStatus']=='online'){ echo 'style="background-color:green"';} ?>></span> </div><?php }

}
;



?>
<script>
   
 




   $(document).ready(function(){

//'ajaxForLiveUpdate/userData.php'





    document.querySelectorAll('.see-profile-js').forEach((e)=>{
    
    e.addEventListener('click',(event)=>{
    
      




        $.post('ajaxForLiveUpdate/userdata.php', { 
        id: e.dataset.profileId
    }, (response) => { 
        // response from PHP back-end 
        $('.user-profile-sub-container').html(response)
    });       
            



       
        let profileContainer=document.querySelector('.user-profile-container-js');
        profileContainer.classList.add('show-element');
        
       
       }
       
    )
       });
   })
   
    

</script>

