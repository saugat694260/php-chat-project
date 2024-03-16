<?php
SESSION_START();
include('./phpfiles/connection.php');
include('./phpfiles/utils.php');

//On page 2
$user_data=checkLogin($conn);

 $currentUserId=$_SESSION['currentUserId'];
       $chattingUserId=$_SESSION['chattingUserId'];
       
$query="select * from users_data where not id={$user_data['id']}";
$result=$conn->query($query);
if($result->num_rows>0){
    while($row=$result->fetch_assoc()){?>
        <p ><a href="conversations.php? id=<?php echo $row["id"]; ?>"><?php echo $row["username"];  ?><span><?php
        
        //update message in realtime


}
?>
        
        
        </span></a></p>
    <?php
    }
;
?>
?>
<script>
    /**
     *  try
    {
        $query="select * from `{$row["id"]}"."{$user_data['id']}` ORDER BY id DESC limit 1;";
        $result=$conn2->query($query);
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    if($row['id']==$user_data['id']){echo 'sent:';}
                    else {echo 'recived:';}
                 echo "{$row['message']}";
                }
  
             }

    }
    catch( mysqli_sql_exception)
    {

        //second try catch
    try{

        $query="select * from `{$user_data['id']}"."{$row["id"]}` ORDER BY id DESC limit 1;";
        $secondResult=$conn2->query($query);
            if($secondResult->num_rows>0){
                while($row=$secondResult->fetch_assoc()){
                    if($row['id']==$user_data['id']){echo 'sent:';}
                    else {echo 'recived:';}
                    echo "{$row['message']}";
                    
                }
            }

            }catch(mysqli_sql_exception){

               echo "";
            }
    }
     */
</script>