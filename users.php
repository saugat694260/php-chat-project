<?php 
session_start();
include('./phpfiles/connection.php');
include('./phpfiles/utils.php');
include('conversations.php');
$user_data=checkLogin($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>peoples</title>
<link rel="stylesheet" href="css/shared.css?v=<?php /* for forced load of css */ echo time(); ?>">
<link rel="stylesheet" href="css/users.css?v=<?php echo time(); ?>">

</head>
<!-- calling function on onload-->
<body >

<div class="page-main-container">




    <!-- user list html-->
    <div class="user-list-main-container">
        <p style="color:white;font-size:20px;margin-right:8px;padding:4px">USERS</p>
        <div class="user-list-container">
        
                                <!-- side bar html-->
                <div class="sidebar-main-container">
                <button class="main-Button"><img class="sidebar-image" src="icons/menu.png"></button>
                    <div class="container">
                        <button class="close-Button"><img class="sidebar-image" src="icons/close.png"></button>
                            <div class="sub-container">
                                <div class="option">
                                    <div><img class="sidebar-image" src="icons/profile.png"></div>
                                        <?php echo $user_data['username']; ?>
                                    </div>
                                </div>
                        <p><a href="./phpfiles/logout.php">logout</a></p>
                    </div>
                </div>

            <div class="user-list-sub-container">
            

                <?php
                $query="select * from users_data where not id={$user_data['id']}";
                $result=$conn->query($query);
                if($result->num_rows>0){
                    while($row=$result->fetch_assoc()){?>
                        <p ><a href="conversations.php? id=<?php echo $row["id"]; ?>"><?php echo $row["username"]; ?><span><?php
                        
                        //update message in realtime

    try
    {
        $query="select * from `{$row["id"]}"."{$user_data['id']}` ORDER BY id DESC limit 1;";
        $result=$conn2->query($query);
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    if($row['userId']==$user_data['id']){echo 'sent:';}
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
                    if($row['userId']==$user_data['id']){echo 'sent:';}
                    else {echo 'recived:';}
                    echo "{$row['message']}";
                }
            }

            }catch(mysqli_sql_exception){

               echo "";
            }
    }
}
?>
                        
                        
                        </span></a></p>
                    <?php
                    }
                ;
            ?>

            </div>
        </div>
    </div>
</div>
<!--script link-->
<script  >//beacouse of the script loading before html it gave null to element so it had to be wrapped i function and called with onload

    const mainButton=document.querySelector(".main-Button");
    const closeButton=document.querySelector(".close-Button");
    const container=document.querySelector(".container");
    const html=document.querySelector("html");
    //
    let clicked=false;
    mainButton.addEventListener('click',()=>{
      open();
      openSecondOption();
    
    });
    closeButton.addEventListener('click',close);
    
    function open() {
      container.classList.add("js-container");
      container.classList.remove("animation-2");
      container.classList.add("animation-1");
      html.classList.add("blur-Background");
    }
    
    function close() {
      
      container.classList.remove("animation-1");
      container.classList.remove("js-container");
      html.classList.remove("blur-Background");
    }
    
    function openSecondOption(){
      if(!clicked){
        container.classList.add("js-container");
        container.classList.remove("animation-2");
        container.classList.add("animation-1");
        html.classList.add("blur-Background");
        clicked=true;
      
      }
      else{
        clicked=false;
        container.classList.remove("animation-1");
        container.classList.remove("js-container");
        html.classList.remove("blur-Background");
      }
    }
     
</script>
</body>
</html>