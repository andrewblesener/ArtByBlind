<?php
if(isset($_POST['addbtn']))
{
	try
	{
		include('connect.php');
		$stmt = $db->prepare("INSERT INTO products(title,shortDesc,longDesc,price,image)VALUES(:Title,:ShortDesc,:LongDesc,:Price,:Image)");
		$stmt->execute(array(
							"Title" => $_POST['title'],
							"ShortDesc" => $_POST['shortDesc'],
							 "LongDesc" => $_POST['longDesc'],
							 "Price" => $_POST['price'],
							 "Image" => $_POST['image']
							));
		echo "Item successfully added";
	}
	catch(PDOException $e){
		echo 'ERROR: ' . $e->getMessage();
	}
}
?>
  <html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Add Products</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">



    <!-- Custom styles for this template -->
    <link href="css/heroic-features.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">ABB Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">INVENTORY
              </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="add.php">ADD PRODUCTS</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container" style="margin-top:4em;">

      <!-- Jumbotron Header -->
      <header class="my-4 text-center">
        <h1 class="display-5">ADD PRODUCTS</h1>
      </header>
      <div class="col-lg-8" style="margin:auto;">
		<form method="post" action="">
		  <div class="form-group">
			<label>Title</label>
			<input type="text" class="form-control" name="title" placeholder="Product Title">
		  </div>
		  <div class="form-group">
			<label>Short Description</label>
			<input type="text" class="form-control" name="shortDesc" placeholder="Short Description">
		  </div>
		  <div class="form-group">
			<label>Long Description</label>
			<textarea type="text" class="form-control" name="longDesc" placeholder="Long Description" rows="3"></textarea>
		  </div>
			  <div class="form-group">
			<label>Price</label>
			<input type="text" class="form-control" name="price" placeholder="Price">
		  </div>
		  <div class="form-group">
		  <label>Image</label>
			<input type="text" class="form-control" name="image" placeholder="Image">
		  </div>
		  <button type="submit" class="btn btn-primary" value="Add Item" name="addbtn">Submit</button>
		</form>
		</div>
   <div class="col-lg-4">
   	<form action="form_upload.php" method="post" enctype="multipart/form-data">
			<fieldset>
			</fieldset>
		</form>
   </div>
    </div>
     <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>
  </body>

</html>
