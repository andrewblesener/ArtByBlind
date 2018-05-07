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
    <?php
				
							if(isset($_REQUEST['adduser']))
							{
								try{
								
								$first = $_POST["first"];
								$last = $_POST["last"];
								$address = $_POST["address"];
								$phone = $_POST["phone"];
								$email = $_POST["email"];
								$access = $_POST['access'];
								$username = $_POST['username'];
								$password = $_POST['password'];
								
							 
											$stmt = $db->prepare("INSERT INTO users(first,last,address,phone,email,access,username,password)VALUES(:first, :last,:address,:phone,:email,:access,:username,:password)");
											$stmt->execute(array
										   (
												"first" => $first,
												"last" => $last,
												"address" => $address,
												"phone" => $phone,
												"email" => $email,
												"access" => $access,
												"username" => $username,
												"password" => $password
											));
									  }

							catch(PDOException $e){echo 'ERROR: ' . $e->getMessage();
						}
					}
					
?>
      <!-- Jumbotron Header -->
			<h2 style="text-align: center;">ADD USER</h2>
				<form method="post" action="admin-add-products.php" enctype="multipart/form-data">
			  	<div class="col-lg-6">
				  <div class="form-group">
					<label>First</label>
					<input type="text" class="form-control" name="first" placeholder="First name">
				  </div>
				  <div class="form-group">
					<label>Last</label>
					<input type="text" class="form-control" name="last" placeholder="last name">
				  </div>
				  <div class="form-group">
					<label>Address</label>
					<input type="text" class="form-control" name="address" placeholder="Address">
				  </div>
					  <div class="form-group">
					<label>Phone</label>
					<input type="text" class="form-control" name="phone" placeholder="Phone">
					</div>
				  <div class="form-group">
				  	<label>Quantity</label>
				  	<input type="number" class="form-control" name="quantity" placeholder="quantity" style="width:25%">
				  </div>
					</div>
					
				  <div class="col-lg-12">
				  <button type="submit" class="btn btn-custom btn-lg" value="Add Item" name="addbtn">Submit</button>
				  </div>
				</form>
			</div>
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