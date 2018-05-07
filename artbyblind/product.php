<?php include('connect.php'); 
$id = $_GET['id'];
?>
<!doctype html>
<html>
<head>
<?php include('head.php');?>
<style>
	.jumbotron{border-right:1px solid #e7e7e7;}
</style>
</head>
<body>
<?php include('nav.php');?>

<?php
	$result = $db->prepare("SELECT * FROM products WHERE id = '$id'");
	$result ->execute();
			for($i=0; $row = $result->fetch();$i++){ ?>
<div class="container"  style="margin-top:5em;">
	<div class="jumbotron">
		<div class="container">
		<div class="col-lg-6 b-card"><img src="<?php echo $row['image'];?>" height="300px"></div>
			<div class="col-lg-4">
				<div class="container" style="margin:4em;">
					<div class="col-lg-12 text-center"><h1><?php echo $row['title'];?></h1></div>
					<div class="col-lg-12 text-center"><h2><em><?php echo $row['variant'];?></em></h2></div>
					<div class="col-lg-12 text-center"><h3>$<?php echo $row['price'];?></h3></div>
					<div class="col-lg-12 text-center" style="margin-top:3em;"><button class="btn btn-custom-alt btn-lg">Add to Cart</button></div>
				</div>
			</div>
		</div>
		<div class="jumbotron">
			<p><?php echo $row['description'];?></p>
		</div>
	</div>
</div>
<?php } ?>
</body>
</html>