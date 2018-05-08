<?php
include('connect.php');
$id=$_GET['id'];
$result = $db->prepare("DELETE FROM products WHERE id= :id");
$result->bindParam(':id', $id);
$result->execute();
header("location: admin-products.php");


?>