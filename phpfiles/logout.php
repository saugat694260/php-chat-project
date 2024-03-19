<?php
session_start();
include('connection.php');
include('utils.php');
$user_data=checkLogin($conn);

if(isset($_SESSION['userId']))
{
	//set status offline after logging out
$query="update users_data set onlineStatus='offline' where id={$user_data['id']} " ;
$result=$conn->query($query);
		unset($_SESSION['userId']);
}

header("Location: ../login.php");
die;?>