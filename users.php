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
<!--css-->
<link rel="stylesheet" href="css/shared.css?v=<?php /* for forced load of css */ echo time(); ?>">
<link rel="stylesheet" href="css/users.css?v=<?php echo time(); ?>">
<!--script-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>
<body >

<div class="page-main-container">




 
  <div class="user-list-main-container">

    <p style="color:white;font-size:20px;margin-right:8px;padding:4px">USERS</p>
  <div class="user-list-container">

  <!-- div that appears after clicking upload profile button-->
<div id="profile-upload-div" style="width:100%;height:80%;background-color:green;color:white;position:absolute;top:10%;z-index:2000;display:grid;justify-content:center;row-gap:0px;display:none">
 
  <div style="width:80%;height:60%">
    <img style="width:100%;height:100%;padding:16px" id="display-selected-image" src="userProfiles/<?php if(isset($user_data['userProfile'])){echo "{$user_data['userProfile']}";} else{echo "profilePicture.png";}?>" alt="your image" />
  </div>

  <div style="width:200px;height:100px;position:absolute;top:80%;left:25%;">
    <!-- form to upload image-->
    <form style="display:flex;align-items:center;" class="profile-upload-form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
      
      <button id="close-profile-upload-div-button">
        cancil
      </button>                        

      <label style="display:flex;width:100%;height:100%;text-wrap:nowrap;overflow: hidden;" id="selected-image-info-label" for="profile-upload" class="profile-upload-label">
        select an image
      </label>

      <input id="profile-upload" type="file" accept="image/*" name="profileImage">
      <input type="submit" name="uploadProfile" value="&#x2b06">

    </form>

  </div>


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
              $insert = $conn->query("UPDATE `users_data` SET `userProfile` ='$fileName' WHERE `id` = {$user_data['id']};"); 
              if($insert){ 
                $statusMsg = "success"; 
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
  
    </div>


    <!-- side bar html-->

    <div class="sidebar-main-container">
    <!--open sidebar button-->
    <button class="main-Button"><img class="sidebar-image" src="icons/menu.png"></button>
    <div class="container">

    <button class="close-Button"><img class="sidebar-image" src="icons/close.png"></button>

    <div class="sub-container">
    <!--user info-->
    <div class="option">
    <div>
    <img class="sidebar-image" src="icons/profile.png">
    </div>
    <?php echo $user_data['username']; ?>
    </div>

    <!--upload pic-->
    <div class="option">
    <div>
    <img class="sidebar-image" src="icons/profile.png">
    </div>
    <button id="open-profile-upload-div-button">upload profile</button>
    </div>

    <!--edit profile-->
    <div class="option">
    <div>
    <img class="sidebar-image" src="icons/profile.png">
    </div>
    <a href="edit.php">edit</a>
    </div>

    <!--logout-->
    <div class="option">
    <div>
    <img class="sidebar-image" src="icons/profile.png">
    </div>
    <a href="./phpfiles/logout.php">logout</a>
    </div>

    <!--delete-->
    <div class="option">
    <div>
    <img class="sidebar-image" src="icons/profile.png">
    </div>
    <a href="edit.php">delete account</a>
    </div>



    </div>



    </div>


    </div>

    <!--pop up div that appears after clicking profile upload button-->
    <div class="user-profile-container user-profile-container-js">
    <!--close the pop up div-->
    <button id="close-profile-container" style="position:absolute:z-index:1001;width:40px;height:40px">x</button>
    <!--info here-->
    <div class="user-profile-sub-container">

    </div>

    </div>
    <!--display users list-->
        <div class="user-list-sub-container" id="user-list-sub-container">
        </div>

    </div>
    
  </div>
</div>



<!--script-->
<script>

//show selected image section
imgInput=document.getElementById('profile-upload');
displaySelectedImage=document.getElementById('display-selected-image');
selectedImageInfoLabel=document.getElementById('selected-image-info-label');

imgInput.onchange = evt => {
  const [file] = imgInput.files
  if (file) {
    selectedImageInfoLabel.textContent=`${file.name}`;
    displaySelectedImage.src=URL.createObjectURL(file);
  }
}


//open profile upload div after clicking upload button
const closeProfileUploadDivButton=document.getElementById('close-profile-upload-div-button');
const openProfileUploadDivButton=document.getElementById('open-profile-upload-div-button');//profile-upload-div
const profileUploadDiv=document.getElementById('profile-upload-div');

let openProfileUploadDivButtonClicked=false;
//open
openProfileUploadDivButton.addEventListener('click',()=>{
if(openProfileUploadDivButtonClicked==false){

  profileUploadDiv.style.display="initial";
  openProfileUploadDivButtonClicked=true;
}

});
//close
closeProfileUploadDivButton.addEventListener('click',(e)=>{
e.preventDefault();
if(openProfileUploadDivButtonClicked==true){
  profileUploadDiv.style.display="none";
  openProfileUploadDivButtonClicked=false;
  }

});






//side bar section
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

                           
      

$(document).ready(function(){

//close pop up user profile container
  $("#close-profile-container").on('click',()=>{

    let profileContainer=document.querySelector('.user-profile-container-js');
    profileContainer.classList.remove('show-element');

  })

  //refresh users every 500ms
    setInterval(() => {


      $("#user-list-sub-container").load('ajaxForLiveUpdate/liveUserUpdate.php'
      );

    }, 500);
  }
);
  
     
</script>

</body>
</html>