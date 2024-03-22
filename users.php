<?php 
session_start();
include('./phpfiles/connection.php');
include('./phpfiles/utils.php');

$user_data=checkLogin($conn);
$_SESSION['currentUserId']=$user_data['id'];

?>


<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>peoples</title>
<link rel="stylesheet" href="css/shared.css?v=<?php /* for forced load of css */ echo time(); ?>">
<link rel="stylesheet" href="css/users.css?v=<?php echo time(); ?>">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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
                              
                                <form class="profile-upload-form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                                <label for="profile-upload" class="profile-upload-label">
        Upload profile
                                       </label>
                                <input id="profile-upload" type="file" accept="image/*" name="profileImage">
                                <input type="submit" name="uploadProfile" value="&#x2b06">
                                </form>
                                <p>

                                <?php 
// upload profile

 
$statusMsg = ''; 
 
// File upload directory 
$targetDir = "userProfiles/"; 
 
if(isset($_POST["uploadProfile"])){ 
    if(!empty($_FILES["profileImage"]["name"])){ 
        $fileName = $_FILES["profileImage"]["name"]; 
        $tempname = $_FILES["profileImage"]["tmp_name"];//for storing on folder
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION); 
  
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg'); 
        if(in_array($fileType, $allowTypes)){ 
            // Upload file to server 
            if(move_uploaded_file($tempname,$targetFilePath)){ 
                // Insert image file name into database 
                $insert = $conn->query("UPDATE `users_data` SET `userProfile` = '$fileName' WHERE `id` = {$user_data['id']};"); 
                if($insert){ 
                    $statusMsg = "success"; 
                    header('refresh:0');
                }else{ 
                    $statusMsg = "File upload failed, please try again."; 
                }  
            }else{ 
                $statusMsg = "Sorry, there was an error uploading your file."; 
            } 
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select a file to upload.'; 
    } 
} 
 
// Display status message 
echo $statusMsg; 
?>
                                </p>
                                <p><a href="edit.php">add bio</a></p>
                                <p><a href="edit.php">edit</a></p>
                        <p><a href="./phpfiles/logout.php">logout</a></p>
                        <p><a href="edit.php">delete account</a></p>
                    </div>
                </div>
                <div class="user-profile-container user-profile-container-js">
                    <button id="close-profile-container" style="position:absolute:z-index:1001;width:40px;height:40px">x</button>
  <div class="user-profile-sub-container">
<div class="user-profile-image-container" style="width:100px;background-color:black;height:100px">

</div>
<div class="close-profile-information-container">

</div>
  </div>

            </div>

            <div class="user-list-sub-container" id="user-list-sub-container">
            

                

            </div>
        </div>
    </div>
</div>
<!--script link-->
<script  >
      

$(document).ready(function(){

    
 $("#close-profile-container").on('click',()=>{

    let profileContainer=document.querySelector('.user-profile-container-js');
    profileContainer.classList.remove('show-element');
    
 })
    setInterval(() => {
        
        
        $("#user-list-sub-container").load('ajaxForLiveUpdate/liveUserUpdate.php'
        );
        
   
        
    

    
      
 
   
    }, 500);
}
);
//beacouse of the script loading before html it gave null to element so it had to be wrapped i function and called with onload

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
   
    /**
     * 
     */

    
 
    
</script>
     
</script>
</body>
</html>