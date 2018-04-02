<?php include('connect.php'); ?>
<!doctype html>
<html>
<head>
<?php include('head.php');?>
</head>
<body>
<?php include('nav.php');?>
<?php include('admin-nav.php')?>
 
    <div class="col-lg-offset-3 col-lg-8" style="margin-top:5em;">
 
   	<div class="col-lg-9">
  <form class="form-inline" method="post" action="search.php">
	<input style="border-radius:0px" class="form-control input-lg" type="text" name="srch_query" placeholder="Search here..." required>
	<input class="btn btn-custom btn-lg" type="submit" name="search" value="search" style="border-radius: 0px;">
</form>
   	</div>
   	   	<div class="col-lg-3">
    		<div class="view-mode">
		<span id="card-icon" class="glyphicon glyphicon-th view-icon"></span>
		<span id="table-icon" class="glyphicon glyphicon-th-list view-icon"></span>
			</div>
		</div>
		</div>
   <div class="col-lg-offset-3 col-lg-8" style="margin-top:1em;">
 <div class=" card-view container-fluid text-center">
<div class="jumbotron">
<div class="container">
	<h2 id="projects" class="navTitle">INVENTORY</h2>

	<?php include 'connect.php';
	   $result = $db->prepare("SELECT * FROM products ORDER BY sku ASC LIMIT 6");
	   $result ->execute();
	
	   for($i=0; $row = $result->fetch();$i++)
	   {

	?><div class="col-lg-3 col-sm-6">
		<div class="container b-card">
		<div class="row">
			<img src="http://via.placeholder.com/200x200" class="img-thumbnail"/>
			</div>
			<div class="row">
			<h4><?php echo $row['title'];?></h4>
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
 <div class="col-lg-offset-3 col-lg-8" style="margin-top:1em;">
 <div class=" table-view container-fluid text-center" style="display: none;">
<div class="jumbotron">
<div class="container">
	<h2 id="projects" class="navTitle">INVENTORY</h2>
<table class="table text-center" >
	<thead>
		<tr>
		<th class="text-center">IMAGE</th>
		<th class="text-center">SKU</th>
		<th class="text-center">TITLE</th>
		<th class="text-center">PRICE</th>
		<th class="text-center">EDIT</th>
		</tr>
	</thead>
	<tbody>
	<?php include 'connect.php';
	   $result = $db->prepare("SELECT * FROM products ORDER BY sku ASC LIMIT 6");
	   $result ->execute();
	
	   for($i=0; $row = $result->fetch();$i++)
	   {
	?>
		<tr>
			<td><img src="http://via.placeholder.com/50x50" class="img-thumbnail"/></td>
			<td><?php echo $row['sku'];?></td>
			<td><?php echo $row['title'];?></td>
			<td>$<?php echo $row['price'];?></td>
			<td><a class="btn btn-small btn-custom" href=>EDIT</a></td>
		</tr>
<?php
	   }
	
	?>
		</tbody>
	</table>
	</div>
	 </div>
	 </div>
	</div>
<?php include('footer.php'); ?>
<script>
$('#card-icon,#table-icon').click(function(){
	$('.card-view,.table-view').toggle();
});
	</script>
</body>
</html>