<?php

SESSION_START();
include('../phpfiles/connection.php');
include('../phpfiles/utils.php');

//userId
$currentUserId=$_SESSION['currentUserId'];
//chattingPartnerId
$chattingUserId=$_SESSION['chattingUserId'];



//first try catch of displaying message
try
{
    $query="select * from `{$_SESSION['currentUserId']}"."{$_SESSION['chattingUserId']}`";
    $result=queryResult($query,$conn2);

    if($result){

    foreach($result as $row){
    ?> 
        <!-- p for holding message-->
        <p <?php
        //add class for displaying message in leftside or right
        if($row['userId']==$currentUserId){
            //display on right
            echo"class='current-user-message-side'";
                                                    }
        else if($row['userId']== $chattingUserId){
            //display on left
             echo"class='other-user-message-side'";
        }
        ?>>
        
        <?php 
        //message
        echo $row['message'];
         ?>
         </p>
         
         <!--span for holding dates-->
        <span style="color:black">
        <?php
        //messaging time
        $time=explode(" ", $row['todaysDate']);
        $date = $time[0];
        $day=date('l', strtotime($date));
        echo $day ." ". $time[1];

        ?>
        </span>
        <?php
        

        }
    }
    else{
    ?>
    <p>
        <?php 
        //if conversation hasnt started yet it will show say hi
        echo "say hii";
        ?>
    </p>
    <?php
}



}
//perfom catch if table doesnt exist
catch( mysqli_sql_exception)
{

       //sub try catch
        try{

        $query="select * from `{$_SESSION['chattingUserId']}"."{$_SESSION['currentUserId']}`";
       $result=queryResult($query,$conn2);
       
       if($result){

        foreach($result as $row){
        ?> 
            <!-- p for holding message-->
            <p <?php
            //add class for displaying message in leftside or right
            if($row['userId']==$currentUserId){
                //display on right
                echo"class='current-user-message-side'";
                                                        }
            else if($row['userId']== $chattingUserId){
                //display on left
                 echo"class='other-user-message-side'";
            }
            ?>>
            
            <?php 
            //message
            echo $row['message'];
             ?>
             </p>
             
             <!--span for holding dates-->
            <span style="color:black">
            <?php
            //messaging time
            $time=explode(" ", $row['todaysDate']);
            $date = $time[0];
            $day=date('l', strtotime($date));
            echo $day ." ". $time[1];
    
            ?>
            </span>
            <?php
            
    
                                        }
        }
        else{
        ?>
        <p>
            <?php 
            //if conversation hasnt started yet it will show say hi
            echo "say hii";
            ?>
        </p>
        <?php
    }
    
         }
        catch(mysqli_sql_exception){
            ?>
            <p>
                <?php 
                //error
                echo "something went wrong";
                ?>
            </p>
            <?php
       
        }
}
?>
