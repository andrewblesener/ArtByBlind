<?php include('connect.php'); ?>
<!doctype html>
<html>
<head>
<?php include('head.php');?>
<style>	.table>tbody>tr>td{font-size: 15px;vertical-align: middle;font-family:roboto;}
</style>
</head>
<body>
<?php include('nav.php');?>
<div class="col-lg-2" style="width:250px;">
<?php include('admin-nav.php');?>
</div>
<div class="col-lg-offset-2 col-lg-10">

	<div class=" card-view container-fluid text-center">
		<div class="jumbotron" style="margin-top:5em;">
			<div class="container">
			<a href="admin-add-products.php" class="btn btn-custom-alt" style="float: left;">Add Product +</a>
				<h2 id="projects" class="navTitle">INVENTORY</h2>
						<form class="form-inline" method="post" action="admin-search.php">
							<input style="border-radius:0px; margin:10px;" class="form-control input-lg" type="text" name="srch_query" placeholder="Search here..." required>
							<input class="btn btn-custom btn-lg" type="submit" name="search" value="search" style="border-radius: 0px;">
						</form>

								<table class="table text-center" >
									<thead>
										<tr>
											<th class="text-center">IMAGE</th>
											<th class="text-center">ID</th>
											<th class="text-center">TITLE</th>
											<th class="text-center">VARIANT</th>
											<th class="text-center">PRICE</th>
											<th class="text-center">QTY</th>
											<th class="text-center">EDIT</th>
										</tr>
								</thead>
								<tbody>

								<?php include 'connect.php';
								$result = $db->prepare("SELECT * FROM products ORDER BY id ASC");
								$result ->execute();
								for($i=0; $row = $result->fetch();$i++)
								{?>

								<tr>
									<td width="10%";><img src="<?php echo $row['image']; ?>" class="img-thumbnail";/></td>
									<td><?php echo $row['id'];?></td>
									<td><?php echo $row['title'];?></td>
									<td><?php echo $row['variant'];?></td>
									<td>$<?php echo $row['price'];?></td>
									<td><?php echo $row['quantity'];?></td>
									<td><a class="btn btn-small btn-custom" href="admin-edit-product.php?id=<?php echo $row['id'];?>">EDIT</a></td>
								</tr>

								<?php
								}?>
								</tbody>
								</table>
						</div>
					</div>
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