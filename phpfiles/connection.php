<?php

$db_server="localhost";
$db_user="root";
$db_password="";
$db_name="project";
$conn="";


    try
    {
        $conn=new mysqli($db_server,$db_user,$db_password,$db_name);
        
    }
    catch( mysqli_sql_exception)
    {
       
        echo "couldnt connect to database";
    }


?>
<?php

$db_server="localhost";
$db_user="root";
$db_password="";
$db_name="users_conversations";
$conn2="";


    try
    {
        $conn2=new mysqli($db_server,$db_user,$db_password,$db_name);
        
    }
    catch( mysqli_sql_exception)
    {
       
        echo "couldnt connect to database";
    }


?>