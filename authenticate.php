<?php
require 'connect.php'; //Database Connection
session_start(); //Start the session

function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}

if(isset($_POST['username']))
{ $username = test_input($_POST['username']);}

if(isset($_POST['password']))
{ $password = test_input($_POST['password']);}

//Check whether the entered username/password pair exist in the Database
$q = 'SELECT * FROM person WHERE username=:username AND password=:password';
$query = $db->prepare($q);
$query->execute(array(':username' => $username, ':password' => $password));

if($query->rowCount() == 0)
{ header('Location: index.php?err=1');}
else
{//fetch the result as associative array
	$row = $query->fetch(PDO::FETCH_ASSOC);


//store the fetched details into $_SESSION
$_SESSION['sess_user_id'] = $row['id'];
$_SESSION['sess_username'] = $row['username'];
$_SESSION['sess_userrole'] = $row['access_level'];


if($_SESSION['sess_userrole'] == "admin")
{ header('Location: adminHome.php');}
else{header('Location: index.php');
	}
}
?>