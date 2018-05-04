<?php 
include('connect.php'); 
if(isset($_POST['search']))
{
	$q = $_POST['srch_query'];?>
<!doctype html>
<html>
<head>
<?php include('head.php');?>
</head>
<body>
<?php include('nav.php');?>
<div class="col-lg-2" style="width:250px;">
<?php include('admin-nav.php');?>
</div>
<div class="col-lg-offset-2 col-lg-10">

	<div class=" card-view container-fluid text-center">
		<div class="jumbotron">
			<div class="container">
				<h2 id="projects" class="navTitle">INVENTORY</h2>

						<form class="form-inline" method="post" action="admin-search.php">
							<input style="border-radius:0px" class="form-control input-lg" type="text" name="srch_query" placeholder="Search here..." required>
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
					<?php
					$search = $db->prepare("SELECT * FROM products
											WHERE title 
											LIKE '%$q%' 
											OR variant LIKE '%$q'");
						$search->execute();

						if($search->rowcount()==0){ echo "No match found!";}
						else
						{
							?>
						<?php foreach($search as $s)
							{
								?>
								<tr>
									<td><img src="<?php echo $s['image']; ?>" class="img-thumbnail" style="height:100px";/></td>
									<td><?php echo $s['id'];?></td>
									<td><?php echo $s['title'];?></td>
									<td><?php echo $s['variant'];?></td>
									<td>$<?php echo $s['price'];?></td>
									<td><?php echo $s['quantity'];?></td>
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
		<?php }
	}?>
<script>
$('#card-icon,#table-icon').click(function(){
	$('.card-view,.table-view').toggle();
});
</script>
</body>
</html>