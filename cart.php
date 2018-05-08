<?php session_start();
include('connect.php');?>
<!DOCTYPE html>
<html lang="en">
<?php include('head.php'); ?>
<body>
<?php include('nav.php');?>

<body>
<?php
	session_start();?>
	<div class="container-fluid">
	<div class="jumbotron b-tron">
	<div class="container">
	<table class='table table-hover' >
		<tbody>
			<tr>
				<th> Art Title </th>
				<th> Variant </th>
				<th> Price </th>
				<th> Quantity </th>
				<th></th>
			</tr>
		
		
		<?php
	try{
	include 'connect.php';
	   $result = $db->prepare("SELECT * FROM cart WHERE sess_id = :Sess_id ORDER BY id ASC");
	   $result ->execute(array("Sess_id" => session_id()));
	   $cart_string = ".";
	   for($i=0; $row = $result->fetch();$i++)
	   {
		   $cart_string .=$row['prod_id'].'.'; 
		   
	   }
		$cart_array = explode(".",$cart_string);
		foreach($cart_array as $item)
		{?>
			
			<?php include('connect.php');
			$result = $db->prepare("SELECT * FROM products WHERE id = :Id");
			$result->execute(array("Id" => $item));
			for($x=0; $row = $result->fetch(); $x++)
			{
				?>
				<tr class="record">
					<td><?php echo $row['title']; ?></td>
					<td><?php echo $row['variant']; ?></td>
					<td><?php echo $row['price']; ?></td>
					<td></td>
					<td><a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>"> delete </a></td>

				</tr>
			<?php } 
		}?>
		
		
		<?php	
	}catch(PDOException $e)
	{
		echo 'ERROR: ' . $e->getMessage();
	}
	
	?>
	<tr>
			<td colspan="2"><center><a class="btn btn-info" href="index.php"> Continue Shopping </a></center></td>
			<td colspan="2"><center><a class="btn btn-success" href=""> Check Out </a></center></td>
		</tr>
		</tbody>
	</table>
		</div>
		</div>
	</div>
</body>
</html>