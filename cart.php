<?php session_start();
include('connect.php');
include('functions.php')?>
<!DOCTYPE html>
<html lang="en">
<?php include('head.php'); ?>
<body>
<?php include('nav.php');?>

	<div class="container-fluid">
	<div class="jumbotron b-tron">
	<div class="container">
	<?php cart(); ?>
	<?php 
					if(isset($_SESSION["sess_username"])){
					echo "<b>Welcome:</b>" . $_SESSION["sess_username"] . "<b>Your</b>" ;
					}
					else {
					echo "<b>Welcome Guest:</b>";
					}
					?>
					<b>Shopping Cart </b> 
					<form action="" method="post" enctype="multipart/form-data">
	<table class='table table-hover' >
		<tbody>
			<tr>
				<th> Remove </th>
				<th> Art Title </th>
				<th> Variant </th>
				<th> Price </th>
				<th> Quantity </th>
				<th> Line Subtotal</th>
			</tr>
		
		<?php 
						//if(isset($_POST['update_cart'])){
						
							//$qty = $_POST['qty'];
							
							//$prodId = $_POST['prodId'];
							//
							//$update_qty = "UPDATE cart SET qty=:Qty WHERE prod_id =:ProdId";
							
							//$run_qty = $db->prepare($update_qty);
							
							//$run_qty->execute(array( "Qty" => $qty,"ProdId" => $prodId));
							
							//$_SESSION['qty']=$qty;
							
							//$total = $total*$qty;
							
							
					//	}
		?>
		<?php 
		$total = 0;
			
		$new_total = 0;
		
		global $db; 
		
		$ip = getIp(); 
		
		$sel_price = "select * from cart where ip_add=:Ip";
		
		$run_price = $db->prepare($sel_price); 
		
		$run_price->execute(array("Ip" => $ip)); 
			
		
		
		while($p_price=$run_price->fetch()){
			
			$pro_id = $p_price['prod_id']; 
			
			$product_qty = $p_price['qty'];
			
			$pro_price = "select * from products where id=:Prod_id";
			
			$run_pro_price = $db->prepare($pro_price); 
			
			$run_pro_price->execute(array("Prod_id" => $pro_id)); 
			
			while ($pp_price = $run_pro_price->fetch()){
			
			$product_price = array($pp_price['price']);
			
			$product_title = $pp_price['title'];
			
			$product_image = $pp_price['image'];
				
			$product_variant = $pp_price['variant'];
			
			$single_price = $pp_price['price'];
				
			$prod_sub = ($single_price * $product_qty);
				
			$temp_sub = array($prod_sub);
				
			$total_sub = array_sum($temp_sub);
				
			$new_total += $total_sub;
			
			$values = array_sum($product_price); 
			
			$total += $values; 
					
				?>
		
		
	
				<tr class="record">
					<td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>"> Remove </td>
					<td><?php echo $product_title; ?></td>
					<td><?php echo $product_variant; ?></td>
					<td><?php echo $single_price; ?></td>
					<td><input type="text" size="4" name="qty" value="<?php echo $product_qty;?>"/></td>
					<input hidden type="text" name="prodId" value="<?php echo $pro_id; ?>"/>

				<?php 
						if(isset($_POST['update_cart'])){
							
							$qty = $_POST['qty'];
							
							$prod_id = $_POST['prodId'];
							
							$update_qty = "UPDATE cart SET qty=:Qty WHERE prod_id = $prod_id";
							
							$run_qty = $db->prepare($update_qty);
							
							$run_qty->execute(array( "Qty" => $qty));
							
							//$_SESSION['qty']=$qty;
							
							//$total = $total*$qty;
							
							
						}
		?>
				
						
						
					
						<td><?php echo "$" . $prod_sub; ?></td>
					</tr>
			<?php 
			} 
		}	
	?>
	<tr>
						<td colspan="5" align="right"><b>Sub Total:</b></td>
						<td><?php echo "$" . $new_total;?></td>
					</tr>
	<tr>
			<td colspan="2"> <input class="btn btn-warning" type="submit" name="update_cart" value="Update Cart"/></td>
			<td colspan="2"><input class="btn btn-info" type="submit" name="continue" value="Continue Shopping" /></td>
			<td colspan="2"><a class="btn btn-success" href=""> Check Out </a></td>
		</tr>
		</tbody>
	</table>
		</form>
		
		<?php
	function updatecart(){
		
		global $db; 
		
		$ip = getIp();
		
		if(isset($_POST['update_cart'])){
		
			foreach($_POST['remove'] as $remove_id){
			
			$delete_product = "delete from cart where prod_id=:Remove_id AND ip_add=:Ip";
			
			$run_delete = $db->prepare($delete_product); 
				
			$run_delete->execute(array("Remove_id" => $remove_id, "Ip" => $ip));
			
			if($run_delete){
			
			echo "<script>window.open('cart.php','_self')</script>";
			
			}
			
			}
		
		}
		if(isset($_POST['continue'])){
		
		echo "<script>window.open('index.php','_self')</script>";
		
		}
	
	}
	echo @$up_cart = updatecart();
	
	?>
		
		</div>
		</div>
	</div>
</body>
</html>