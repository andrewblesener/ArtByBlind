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
			<a href="admin-add-products.php" class="btn btn-custom-alt" style="float: left;">ADD USER +</a>
				<h2 id="projects" class="navTitle">USERS</h2>
						<form class="form-inline" method="post" action="admin-search.php">
							<input style="border-radius:0px; margin:10px;" class="form-control input-lg" type="text" name="srch_query" placeholder="Search here..." required>
							<input class="btn btn-custom btn-lg" type="submit" name="search" value="search" style="border-radius: 0px;">
						</form>

								<table class="table text-center" >
									<thead>
										<tr>
											<th class="text-center">ID</th>
											<th class="text-center">FIRST</th>
											<th class="text-center">LAST</th>
											<th class="text-center">ADDRESS</th>
											<th class="text-center">EMAIL</th>
											<th class="text-center">PHONE</th>
											<th class="text-center">ACCESS</th>
											<th class="text-center">USERNAME</th>
											<th class="text-center">PASSWORD</th>
											<th class="text-center">EDIT</th>
										</tr>
								</thead>
								<tbody>

								<?php 
								$result = $db->prepare("SELECT * FROM person ORDER BY perID ASC");
								$result ->execute();
								for($i=0; $row = $result->fetch();$i++)
								{?>

								<tr>
									<td><img src="<?php echo $row['image']; ?>" class="img-thumbnail" style="height:100px";/></td>
									<td><?php echo $row['perID'];?></td>
									<td><?php echo $row['first_name'];?></td>
									<td><?php echo $row['last_name'];?></td>
									<td><?php echo $row['address'];?></td>
									<td><?php echo $row['phone_number'];?></td>
									<td><?php echo $row['email'];?></td>
									<td><?php echo $row['access_level'];?></td>
									<td><?php echo $row['user_name'];?></td>
									<td><?php echo $row['phone_number'];?></td>
									<td><?php echo $row['email'];?></td>
									<td><a class="btn btn-small btn-custom" href="admin-edit-person.php?id=<?php echo $row['perID'];?>">EDIT</a></td>
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