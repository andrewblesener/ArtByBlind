<?php
//configuration
include('connect.php');

//new data
$sku = $_POST['sku'];
$title = $_POST['title'];
$shortDesc = $_POST['shortDesc'];
$longDesc = $_POST['longDesc'];
$price = $_POST['price'];
$image = $_POST['image'];

//query
$sql = "UPDATE products
		SET title=?, shortDesc=?, longDesc=?, price=?, image=? WHERE sku=?";
// '?' Question mark represents "Parametized Query".

$q = $db->prepare($sql);
$q->execute(array($title, $shortDesc, $longDesc, $price, $image, $sku));
header("location: index.php"); ?>