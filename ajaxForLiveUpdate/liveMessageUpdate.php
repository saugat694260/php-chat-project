<?php
SESSION_START();
include('../phpfiles/connection.php');
include('../phpfiles/utils.php');

//On page 2
 $currentUserId=$_SESSION['currentUserId'];
       $chattingUserId=$_SESSION['chattingUserId'];




               try
               {
                   $query="select * from `{$_SESSION['currentUserId']}"."{$_SESSION['chattingUserId']}`";
                   $result=$conn2->query($query);
                   
                       if($result->num_rows>0){
                        
                           while($row=$result->fetch_assoc()){
                           ?> <p <?php if($row['userId']==$currentUserId){echo"class='current-user-message-side'";}
                            else if($row['userId']== $chattingUserId){
                               echo"class='other-user-message-side'";
                           }?>><?php 
                            
                           echo $row['message'];
                          
                    ?></p><?php
                      }
                     
                  }
                  else{
                   ?><p <?php
                  
                       ?>><?php  echo "say hii";?></p><?php
                  }
      
                  }catch(mysqli_sql_exception){
      
                      ?> <p><?php echo "say hi";?></p><?php
               }
               catch( mysqli_sql_exception)
               {
           
                   //second try catch
               try{
           
                $query="select * from `{$_SESSION['chattingUserId']}"."{$_SESSION['currentUserId']}`";
                $result=$conn2->query($query);
                    if($result->num_rows>0){
                     
                        while($row=$result->fetch_assoc()){
                            ?> <p <?php if($row['userId']==$currentUserId){echo"class='current-user-message-side'";}
                             else if($row['userId']== $chattingUserId){
                                echo"class='other-user-message-side'";
                            }?>><?php 
                            
                                echo $row['message'];
                               
                         ?></p><?php
                           }
                          
                       }
                       else{
                        ?><p <?php
                       
                            ?>><?php  echo "say hii";?></p><?php
                       }
           
                       }catch(mysqli_sql_exception){
           
                           ?> <p><?php echo "say hi";?></p><?php
                       }
               }?>
        
    

</script>