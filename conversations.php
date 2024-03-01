<?php
SESSION_START();
include('./phpfiles/connection.php');
include('./phpfiles/validation.php');
include('./phpfiles/utils.php');
$current_user_data=checkLogin($conn);?>
    


    
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>message</title>
<link rel="stylesheet" href="css/shared.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="css/conversations.css?v=<?php echo time(); ?>">
</head>
<body>
<div class="page-main-container">


<div class="user-messages-main-container">
    <!--display selected user info-->
    <p style="color:white"><?php  $query="select * from users_data where id='{$_GET['id']}' limit 1";
        $result=$conn->query($query);
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    echo $row['username'];
                }}?></p>         
<div class="">
<div class="user-messages-sub-container">
     <!--display smessages-->
<?php 
//update message in realtime
if(!isset($_POST['send-message'])){
    try
    {
        $query="select * from `{$_GET ['id']}"."{$current_user_data['id']}`";
        $result=$conn->query($query);
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                ?> <p <?php if($row['userId']==$current_user_data['id']){echo"class='current-user-message-side'";}
                 else if($row['userId']==$_GET['id']){
                    echo"class='other-user-message-side'";
                }?>><?php echo "{$row['userName']}: "."{$row['message']}";?></p><?php
                }
             }

    }
    catch( mysqli_sql_exception)
    {

        //second try catch
    try{

        $query="select * from `{$current_user_data['id']}"."{$_GET ['id']}`";
        $secondResult=$conn->query($query);
            if($secondResult->num_rows>0){
                while($row=$secondResult->fetch_assoc()){
                    ?> <p><?php echo "{$row['userName']}: "."{$row['message']}";?></p><?php
                }
            }

            }catch(mysqli_sql_exception){

                ?> <p><?php echo "say hi";?></p><?php
            }
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
$result=$conn->query($query);

}
    catch( mysqli_sql_exception)
    {

        try{
                //check if the database exist ot not
                $query="select * from `{$current_user_data['id']}"."{$id}`";
                $secondResult=$conn->query($query);
            }

            catch(mysqli_sql_exception){
                //create a database if one doesnt exist
                $query="create table `{$id}"."{$current_user_data['id']}`(
                id int primary key AUTO_INCREMENT,userId varchar(255),userName varchar(255), message varchar(255),todaysDate date ,currentTime time);";
                $result=$conn->query($query);
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
            $conn->query($query);
            //refresh page
            header("Refresh:0");
            $_POST['input-message']=null;

        }
        catch( mysqli_sql_exception)
            {
//checks table
            try{
            
                $query="insert into `{$id}"."{$current_user_data['id']}` (userId,userName,message) values('{$current_user_data['id']}','{$current_user_data['username']}','$message')";
                $conn->query($query);
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

<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>" method='post'>
<input name="input-message" type="text" autocomplete="off" >
<input name="send-message" type='submit' value='send'>
</form>


</div>
</div>
</div>
</div>

</body>
</html>





