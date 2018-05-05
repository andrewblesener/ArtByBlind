<?php
include('connect.php');
$id=$_GET['id'];
?>
<!doctype html>
<html>
<head>
<?php include('head.php');?>
<style>input[type="file"] {
    display: none;
}
	.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
}
	.btn-custom-alt{
background-color:#FFAC35;
font-family: roboto;
text-transform: uppercase;
letter-spacing: 1px;
font-weight: bold;
color:#fff;
border:none;
box-shadow: 3px 3px #000;
}
</style>
</head>
<body>
<?php include('nav.php');?>
<?php include('admin-nav.php');?>
<div class="col-lg-offset-3 col-lg-8" style="margin-top:5em;">
		<div class="jumbotron">
			<div class="container">
  			
      <!-- Jumbotron Header -->
      <?php 
			//include('connect.php');
			$result = $db->prepare("SELECT * FROM products WHERE id = '$id'");
			$result ->execute();
			for($i=0; $row = $result->fetch();$i++){ ?>
			<h2 style="text-align: center;">EDIT PRODUCTS</h2>
			  <form method="post" action="admin-edit-product.php" enctype="multipart/form-data">
			  	<div class="col-lg-6">
			  	<input type="hidden" name="id" value="<?php echo $row['id'];?>">
				  <div class="form-group">
					<label>Title</label>
					<input type="text" class="form-control" name="title" placeholder="Product Title" value="<?php echo $row['title'];?>">
				  </div>
				  <div class="form-group">
					<label>Variant</label>
					<input type="text" class="form-control" name="variant" placeholder="Variant" value="<?php echo $row['variant'];?>">
				  </div>
				  <div class="form-group">
					<label>Description</label>
					<textarea type="text" class="form-control" name="description" placeholder="Description" rows="6" value="<?php echo $row['description'];?>"></textarea>
				  </div>
					  <div class="form-group">
					<label>Price</label>
					 <div class="input-group">
					  <div class="input-group-addon">$</div>
					<input type="text" class="form-control" name="price" placeholder="Price" value="<?php echo $row['price'];?>">
				  </div>
					</div>
				  <div class="form-group">
				  	<label>Quantity</label>
				  	<input type="number" class="form-control" name="quantity" placeholder="quantity" style="width:25%" value="<?php echo $row['quantity'];?>">
				  </div>
					</div>
					<div class="col-lg-6">
					<div class="form-group">
				  <label>Image</label><br/>
					<label for="file" class="custom-file-upload btn-custom-alt">Upload Image</label>
					<input id="file" name="file" type="file"/><div class="row">
						<img id="myImg" src="<?php echo $row['image'];?>" class="img-thumbnail" style="height:200px;"/>
					</div>
				  </div>
				  </div>
				  <div class="col-lg-12">
				  <button type="submit" class="btn btn-custom btn-lg" value="Edit Item" name="editbtn">Edit</button><br/><br/>
				  <button type="submit" class="btn btn-custom btn-lg" value="Delete Item" name="delbtn" style="background-color:red;">Delete</button>
				  
				  </div>
				</form>
			</div> 
			<?php 
			} 
			?>
			 <?php
						$id = $_POST['id'];
			
						if(isset($_REQUEST['delbtn']))
						{
							try{
								$sql = $db->prepare("DELETE FROM products WHERE id= '$id'");
								$sql->execute();
								
								}
							catch(PDOException $e){echo 'ERROR: ' . $e->getMessage();

						}
						}
				
						if(isset($_REQUEST['editbtn']))
							{
								try{
								//include('connect.php');
								$file  = $_FILES["file"]["name"];
								$size  = $_FILES["file"]["size"];
								$title = $_POST["title"];
								$variant = $_POST["variant"];
								$description = $_POST["description"];
								$price = $_POST["price"];
								$quantity = $_POST["quantity"];
								
								
								
							 
								
								//Checking if 'image name' entered and 'File attachment' has been done. 
								if(empty($file))
								{
									echo "<label class='err'>All field is required</label>";
								}
								
								//Checking the File Size. Maximum allowed size: 500,000 bytes (500 kb)
								elseif($size > 500000)
								{
									echo "<label class='err'> Image size must not be greater than 500kb </label>";
								}
								
								/*-- Few preperations for checking
										the file type (extension) --*/
								
								//Store the allowed extension in an array 
								$allowedExts = array("gif", "jpeg", "jpg", "png", "x-png", "pjpeg");
								
								/* using explode() functoin, seperate the 'File Name'
								and its 'Extension' into individual elements of an array: $temp */
								$temp = explode(".", $_FILES["file"]["name"]);
								
								/* The end() function returns the last element of an array.
								as per array $temp, First element: File name
													 Last element: Extension */
								$extension = end($temp);
								
								/* -- Checking the file type (extension) --*/
								if((($_FILES["file"]["type"] == "image/gif")
								 || ($_FILES["file"]["type"] == "image/jpeg")
								 || ($_FILES["file"]["type"] == "image/jpg")
								 || ($_FILES["file"]["type"] == "image/pjpeg")
								 || ($_FILES["file"]["type"] == "image/x-png")
								 || ($_FILES["file"]["type"] == "image/png")
								   )
								 && ($_FILES["file"]["size"] <= 500000)
								 && in_array($extension, $allowedExts))
							
								  {
								
									  if ($_FILES["file"]["error"] > 0)
									  {
										  echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
									  }
									 else
									  {
										  move_uploaded_file($_FILES["file"]["tmp_name"],"images/" . $_FILES["file"]["name"]);
										  $image_path = "images/" . $_FILES["file"]["name"];
										  //Insert the "Image name" and File name to the database
										 $sql = "UPDATE products SET title=?,variant=?,description=?,price=?,quantity=?,image=? WHERE id=?";
										$stmt = $db->prepare($sql);
										$stmt->execute([$title,$variant,$description,$price,$quantity,$image_path,$id]);
										 
									  }

									} 
								}	
							catch(PDOException $e){echo 'ERROR: ' . $e->getMessage();
						 }
					}
?>
		</div>
	</div>
</div>
<script>$(function () {
    $(":file").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });
});

function imageIsLoaded(e) {
    $('#myImg').attr('src', e.target.result);
};</script>
<?php include('footer.php'); ?>
</body>
</html>