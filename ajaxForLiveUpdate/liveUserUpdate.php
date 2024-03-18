<?php
SESSION_START();
include('../phpfiles/connection.php');
include('../phpfiles/utils.php');

//On page 2
$user_data=checkLogin($conn);


       
$query="select * from users_data where not id={$user_data['id']}";
$result=$conn->query($query);
if($result->num_rows>0){
    while($row=$result->fetch_assoc()){?>
        <p ><a href="conversations.php? id=<?php echo $row["id"]; ?>"><?php echo $row["username"];
    }}
;
?>

<script>
    /**
     * 
     */
</script>