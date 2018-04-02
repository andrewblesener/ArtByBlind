<?php
include('connect.php');
$id=$_GET['sku'];
$result = $db->prepare("DELETE FROM products WHERE sku= :memid");
$result->bindParam(':memid', $id);
$result->execute();
header("location: index.php");


?>