<?php include('connect.php'); ?>
<!doctype html>
<html>
<head>
<?php include('head.php');?>

</head>
<body>
<?php include('nav.php');?>
<?php include('admin-nav.php');?>
    <div class="col-lg-offset-3 col-lg-8" style="margin-top:5em;">
 <div class="container-fluid text-center">
<div class="jumbotron">
<div class="container">
	<h2 id="projects" class="navTitle">INVENTORY</h2>
	<?php include 'connect.php';
	   $result = $db->prepare("SELECT * FROM products ORDER BY sku ASC LIMIT 6");
	   $result ->execute();
	
	   for($i=0; $row = $result->fetch();$i++)
	   {


	
	?><div class="col-lg-4 col-sm-6">
		<div class="container b-card">
		<div class="row">
			<img src="http://via.placeholder.com/200x200" class="img-thumbnail"/>
			</div>
			<div class="row">
			<h4><?php echo $row['title'];?></h4><p><?php echo $row['shortDesc'];?></p>
			<h4>$<?php echo $row['price'];?></h4>
			<a class="btn btn-wide btn-custom" href=>VIEW</a>
			</div>
		</div>
	</div>
<?php
	   }
	
	?>
	</div>
</div>
</div>
</div>

<?php include('footer.php'); ?>
</body>
</html>