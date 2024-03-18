<?php
SESSION_START();
include('./phpfiles/connection.php');
include('./phpfiles/validation.php');
include('./phpfiles/utils.php');
$current_user_data=checkLogin($conn);
$_SESSION['chattingUserId']=$_GET['id'];


?>
    


    
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>message</title>
<link rel="stylesheet" href="css/shared.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="css/conversations.css?v=<?php echo time(); ?>">
<script src="scripts/conversations.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body onload="runOnLoad()">
<div class="page-main-container">


<div class="user-messages-main-container">
    <!--display selected user info-->
    <div>
    <p style="color:white"><?php  $query="select * from users_data where id='{$_GET['id']}' limit 1";
        $result=$conn->query($query);
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    echo $row['username'];
                }}?></p> 
               <input type="submit" name="delete-Conversations" value="delete" form="input-message-form">
    </div>        
<div class="">
<div class="user-messages-sub-container" id="user-messages-sub-container-js">
     <!--display smessages-->
<?php 

//delete message
if(isset($_POST['delete-Conversations'])){
    $id = $_GET ['id'];
    $_POST['delete-Conversations']=null;
    try
    {
        $query="DELETE FROM `{$current_user_data['id']}"."{$id}`";
        $conn2->query($query);
        
        $_POST['delete-Conversations']=null;
        ?> <p><?php echo "deleted";?></p><?php

    }
    catch( mysqli_sql_exception)
        {
//checks table
        try{
        
            $query="DELETE FROM `{$id}"."{$current_user_data['id']}`";
            $conn2->query($query);
            
            $_POST['delete-Conversations']=null;
            ?> <p><?php echo "deleted";?></p><?php


        }
        
            catch(mysqli_sql_exception){

                ?> <p><?php echo "couldnt send message something went wrong";?></p><?php
            }
        }


}

     //send message
     if($_SERVER['REQUEST_METHOD']=='POST'){
        
                if(empty('delete-Conversations')){
               
        
                    header('location:jiuhrog.pjp');
        
                }
        
        
            }



?>


<?php /*id of the clicked user */ if(isset($_GET['id'])) {
$id = $_GET ['id'];
//create table if doesnt exist

try
{
    //check if the database exist ot not
$query="select * from `{$id}"."{$current_user_data['id']}`";
$result=$conn2->query($query);

}
    catch( mysqli_sql_exception)
    {

        try{
                //check if the database exist ot not
                $query="select * from `{$current_user_data['id']}"."{$id}`";
                $secondResult=$conn2->query($query);
            }

            catch(mysqli_sql_exception){
                //create a database if one doesnt exist
                $query="create table `{$id}"."{$current_user_data['id']}`(
                id int primary key AUTO_INCREMENT,userId varchar(255),userName varchar(255), message varchar(255),todaysDate date ,currentTime time);";
                $result=$conn2->query($query);
                    if(!$result){
                        ?> <p><?php echo "something went wrong, try again later";?></p><?php  
                    }
                        else{
                        ?> <p><?php echo "you can now message each other";?></p><?php
                        }
            }
    }

}
?>

<?PHP
    //send message
    if($_SERVER['REQUEST_METHOD']=='POST'){
//message to send
        $message=filter_input(INPUT_POST,'input-message',FILTER_SANITIZE_SPECIAL_CHARS);
        
        if(isset($_POST['send-message']) && !empty($message)){

        try
        {
            $query="insert into `{$current_user_data['id']}"."{$id}`(userId,userName,message) values('{$current_user_data['id']}','{$current_user_data['username']}','$message')";
            $conn2->query($query);
            //refresh page
            header("Refresh:0");
            $_POST['input-message']=null;

        }
        catch( mysqli_sql_exception)
            {
//checks table
            try{
            
                $query="insert into `{$id}"."{$current_user_data['id']}` (userId,userName,message) values('{$current_user_data['id']}','{$current_user_data['username']}','$message')";
                $conn2->query($query);
                //refresh page
                header("Refresh:0");
                $_POST['input-message']=null;


            }
            
                catch(mysqli_sql_exception){

                    ?> <p><?php echo "couldnt send message something went wrong";?></p><?php
                }
            }

        }


    }


?>
</div>
<div class="messages-input-container">

<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>" method='post' id="input-message-form">
<input name="input-message" type="text" autocomplete="off" >
<input name="send-message" type='submit' value='send'>
</form>


</div>
</div>
</div>
</div>

<script>

$(document).ready(function(){
    
    setInterval(() => {
        
        
        $("#user-messages-sub-container-js").load('ajaxForLiveUpdate/liveMessageUpdate.php'
        );
    }, 500);
}
);

</script>

</body>
</html>





