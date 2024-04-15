<?php
SESSION_START();
include('../phpfiles/connection.php');
include('../phpfiles/utils.php');

//getting user data from session
$user_data=checkLogin($conn);


//if session exist the status will be shown onlise else offline
if(!isset($user_data)){
    $query="update users_data set onlineStatus='offline' where id={$user_data['id']} " ;
    $result=$conn->query($query);
}
if(isset($user_data)){
    $query="update users_data set onlineStatus='online' where id={$user_data['id']} " ;
    $result=$conn->query($query);
}

if(isset($_POST['show-profile-button'])){
    header('location:users.php');
}

//display users
$query="select * from users_data where not id={$user_data['id']}";
$result=queryResult($query,$conn);

    if($result){

    foreach($result as $row){

        ?>
        <!-- div for holding all data of users list-->
        <div class="user-status">

                <div class="user-info">
                    <!-- button that displays user profile-->
                    <button name="show-profile-button" class="profile-pic-image-container see-profile-js" data-profile-id="<?php echo $row['id']?>">

                        <img  src="userProfiles/<?php if(isset($row['userProfile'])){echo "{$row['userProfile']}";} else{echo "profilePicture.png";} ?>" alt="wryy">
                    
                    </button>
                    <!-- link to conversations-->
                    <a href="conversations.php? id=<?php echo $row["id"]; ?>">
                        <?php
                            echo $row["username"];
                        ?>
                        <!--span for displaying last sent or recived message-->
                        <span style="position:absolute;left:0px;">

                        <?php
                        try
                        {

                            $query2="select * from `{$user_data['id']}"."{$row['id']}` order by id desc limit 1";
                            $result2=$conn2->query($query2);

                            if($result2->num_rows>0){

                                while($row2=$result2->fetch_assoc()){

                                    //shows whether the message is sent or recived
                                    ?>
                                    <span style="width:50px ;position:absolute;right:0px;text-align: right;">

                                        <?php

                                        if($user_data['id']==$row2['userId']){ 
                                            echo 'sent';
                                        }
                                        else{
                                            echo 'recived';

                                        }

                                        ?>

                                    </span>

                                    <span style="<?php
                                    //css for sent and revived message
                                    if($user_data['id']==$row2['userId']){ 
                                        echo "color:black;font-weight:normal;position:absolute;right:0px;";
                                    }
                                    else{
                                        echo "color:black;font-weight:bold;position:absolute;right:0px;";
                                    }
                                    ?>">
                                        <?php
                                        //displays the last message
                                        echo $row2['message'];
                                        }
                                        ?> 
                                    </span>
                                    <?php


                            }
                            else{
                                //do nothing
                            }

                            }
                        catch( mysqli_sql_exception)
                        {

                            //sub try catch
                            try{

                            $query2="select * from `{$row['id']}"."{$user_data['id']}` order by id desc limit 1";
                            $result2=queryResult($query2,$conn2);

                            if($result2){

                                foreach($result2 as $row2){

                                    //shows whether the message is sent or recived
                                    ?>
                                    <span style="width:50px ;position:absolute;right:0px;text-align: right;">

                                        <?php

                                        if($user_data['id']==$row2['userId']){ 
                                            echo 'sent';
                                        }
                                        else{
                                            echo 'recived';

                                        }

                                        ?>

                                    </span>

                                    <span style="<?php
                                    //css for sent and revived message
                                    if($user_data['id']==$row2['userId']){ 
                                        echo "color:black;font-weight:normal;position:absolute;right:0px;";
                                    }
                                    else{
                                        echo "color:black;font-weight:bold;position:absolute;right:0px;";
                                    }
                                    ?>">
                                        <?php
                                        //displays the last message
                                        echo $row2['message'];
                                        }
                                        ?> 
                                    </span>
                                    <?php


                            }
                            else{
                                //do nothing
                            }

                            }
                            catch(mysqli_sql_exception){
                        //do nothing
                            } 
                        }
                            ?>


                        </span>


                    </a>

                </div>
            <!--span for displaying whether the user is online or not-->
                <span class="offline-or-online-status" 
            <?php
            if($row['onlineStatus']=='online'){
                    echo 'style="background-color:green"';
                                                }
            ?>>

                </span> 

        </div>

        <?php
                                    }

                        };

?>




<!-- script-->
<script>

    $(document).ready(function(){

        //'ajaxForLiveUpdate/userData.php'
        //selecting see profile button and adding event listner
        document.querySelectorAll('.see-profile-js').forEach((e)=>{

            e.addEventListener('click',(event)=>{
                //send user id using ajax amd get data of the clicked user
                $.post('ajaxForLiveUpdate/userdata.php', { 
                id: e.dataset.profileId
                }, (response) => { 
                    // response from PHP back-end 
                    $('.user-profile-sub-container').html(response)
                });       
            //displays div after clicking button
            let profileContainer=document.querySelector('.user-profile-container-js');
                profileContainer.classList.add('show-element');


            })
        });
        
    });

</script>

