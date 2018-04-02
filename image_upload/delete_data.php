<?php
// Databse Connection 
$con = mysqli_connect("localhost", "root", "", "sindhu");

$id = $_GET['id']; //Retrieve the 'id' to be deleted

// Retrieve the 'id' to be deleted 
$query = mysqli_query($con, "SELECT * FROM amalan WHERE id='$id'");
$imageFile = mysqli_fetch_assoc($query);

//First delete the image from directory 
unlink("upload/" .$imageFile['filename']);

//Next, delete the data from the database 
mysqli_query($con,"DELETE FROM amalan WHERE id='$id'");
mysqli_close($con); //Close the Database Connection 

header("location: view_data.php");
?>