<?php 
include("connect.php");
 // getting the user IP address
  function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}
  
  
//creating the shopping cart
function cart(){

if(isset($_GET['add_cart'])){

	global $db; 
	
	$ip = getIp();
	
	$prod_id = $_GET['add_cart'];

	$check_pro = "select * from cart where ip_add=:Ip AND prod_id=:Prod_id";
	
	$run_check = $db->prepare($check_pro); 
	
	$run_check->execute(array("Ip" => $ip, "Prod_id" => $prod_id));
		
	$count = $run_check->rowCount();
	
	if($count>0){	
		
	echo "";
	
	}
	else {
		
	$new_qty = 1 ;
	
	$insert_pro = "INSERT INTO cart (ip_add, prod_id, qty) VALUES (:Ip, :Prod_id, :Qty)";
	
	$run_pro = $db->prepare($insert_pro); 
		
	$run_pro->execute(array("Ip" => $ip, "Prod_id" => $prod_id, "Qty" => $new_qty));
	
	echo "<script>window.open('index.php','_self')</script>";
	}
	echo $count;
}

}
 // getting the total added items
 
 function total_items(){
 
	if(isset($_GET['add_cart'])){
	
		global $db; 
		
		$ip = getIp(); 
		
		$get_items = "select * from cart where ip_add=:Ip";
		
		$run_items = $db->prepare($get_items); 
		
		$run_items->execute(array("Ip" => $ip));
		
		$count_items = $run_items->rowCount();
		
		}
		
		else {
		
		global $db; 
		
		$ip = getIp(); 
		
		$get_items = "select * from cart where ip_add=:Ip";
		
		$run_items = $db->prepare($get_items); 
		
		$run_items->execute(array("Ip" => $ip));
		
		$count_items = $run_items->rowCount();
		
		}
	
	echo $count_items;
	}
  
// Getting the total price of the items in the cart 
	
	function total_price(){
	
		$total = 0;
		
		global $db; 
		
		$ip = getIp(); 
		
		$sel_price = "select * from cart where ip_add=:Ip";
		
		$run_price = $db->prepare($sel_price); 
		
		$run_price->execute(array("Ip" => $ip));
		
		while($p_price=$run_price->fetch()){
			
			$pro_id = $p_price['prod_id']; 
			
			$pro_price = "select * from products where id=:Prod_id";
			
			$run_pro_price = $db->prepare($pro_price); 
			
			$run_pro_price->execute(array("Prod_id" => $pro_id));
			
			while ($pp_price = $run_pro_price->fetch()){
			
			$product_price = array($pp_price['price']);
			
			$values = array_sum($product_price);
			
			$total +=$values;
			
			}
		
		
		}
		
		echo "$" . $total;
		
	
	}

//getting the categories

function getCats(){
	
	global $con; 
	
	$get_cats = "select * from categories";
	
	$run_cats = mysqli_query($con, $get_cats);
	
	while ($row_cats=mysqli_fetch_array($run_cats)){
	
		$cat_id = $row_cats['cat_id']; 
		$cat_title = $row_cats['cat_title'];
	
	echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
	
	
	}


}

//getting the brands

function getBrands(){
	
	global $con; 
	
	$get_brands = "select * from brands";
	
	$run_brands = mysqli_query($con, $get_brands);
	
	while ($row_brands=mysqli_fetch_array($run_brands)){
	
		$brand_id = $row_brands['brand_id']; 
		$brand_title = $row_brands['brand_title'];
	
	echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
	
	
	}
}

function getPro(){

	if(!isset($_GET['cat'])){
		if(!isset($_GET['brand'])){

	global $db; 
	
	$get_pro = "select * from products order by RAND() LIMIT 0,6";

	$run_pro = $db->prepare($get_pro); 
			
	$run_pro->execute();
	
	while($row_pro=$run_pro->fetch()){
	
		$pro_id = $row_pro['id'];
		$pro_cat = $row_pro['product_cat'];
		$pro_brand = $row_pro['product_brand'];
		$pro_title = $row_pro['title'];
		$pro_price = $row_pro['price'];
		$pro_image = $row_pro['image'];
		$pro_variat = $row_pro['variant'];
	
		echo "
				<div id='single_product'>
				
					<h3>$pro_title</h3>
					
					<img src='admin_area/product_images/$pro_image' width='180' height='180' />
					
					<p><b> Price: $ $pro_price </b></p>
					
					<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
					
					<a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to Cart</button></a>
				
				</div>
		
		
		";
	
	}
	}
}

}

function getCatPro(){

	if(isset($_GET['cat'])){
		
		$cat_id = $_GET['cat'];

	global $con; 
	
	$get_cat_pro = "select * from products where product_cat='$cat_id'";

	$run_cat_pro = mysqli_query($con, $get_cat_pro); 
	
	$count_cats = mysqli_num_rows($run_cat_pro);
	
	if($count_cats==0){
	
	echo "<h2 style='padding:20px;'>No products where found in this category!</h2>";
	
	}
	
	while($row_cat_pro=mysqli_fetch_array($run_cat_pro)){
	
		$pro_id = $row_cat_pro['product_id'];
		$pro_cat = $row_cat_pro['product_cat'];
		$pro_brand = $row_cat_pro['product_brand'];
		$pro_title = $row_cat_pro['product_title'];
		$pro_price = $row_cat_pro['product_price'];
		$pro_image = $row_cat_pro['product_image'];
	
		echo "
				<div id='single_product'>
				
					<h3>$pro_title</h3>
					
					<img src='admin_area/product_images/$pro_image' width='180' height='180' />
					
					<p><b> $ $pro_price </b></p>
					
					<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
					
					<a href='index.php?pro_id=$pro_id'><button style='float:right'>Add to Cart</button></a>
				
				</div>
		
		";
		
	
	}
	
}

}


function getBrandPro(){

	if(isset($_GET['brand'])){
		
		$brand_id = $_GET['brand'];

	global $con; 
	
	$get_brand_pro = "select * from products where product_brand='$brand_id'";

	$run_brand_pro = mysqli_query($con, $get_brand_pro); 
	
	$count_brands = mysqli_num_rows($run_brand_pro);
	
	if($count_brands==0){
	
	echo "<h2 style='padding:20px;'>No products where found associated with this brand!!</h2>";
	
	}
	
	while($row_brand_pro=mysqli_fetch_array($run_brand_pro)){
	
		$pro_id = $row_brand_pro['product_id'];
		$pro_cat = $row_brand_pro['product_cat'];
		$pro_brand = $row_brand_pro['product_brand'];
		$pro_title = $row_brand_pro['product_title'];
		$pro_price = $row_brand_pro['product_price'];
		$pro_image = $row_brand_pro['product_image'];
	
		echo "
				<div id='single_product'>
				
					<h3>$pro_title</h3>
					
					<img src='admin_area/product_images/$pro_image' width='180' height='180' />
					
					<p><b> $ $pro_price </b></p>
					
					<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
					
					<a href='index.php?pro_id=$pro_id'><button style='float:right'>Add to Cart</button></a>
				
				</div>
		
		";
		
	
	}
	
}
}


?>