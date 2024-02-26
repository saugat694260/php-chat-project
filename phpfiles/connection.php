<?php

$db_server="localhost";
$db_user="root";
$db_password="";
$db_name="project";
$conn="";


    try
    {
        $conn=new mysqli($db_server,$db_user,$db_password,$db_name);
        echo "connected to database successfully";
    }
    catch( mysqli_sql_exception)
    {
       
        echo "couldnt connect to database";
    }


?>