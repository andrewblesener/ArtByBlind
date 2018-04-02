<?php
include('connect.php');
$sku=$_GET['sku'];
$result = $db->prepare("SELECT * FROM products WHERE sku= :skuID");
$result ->bindParam(':skuID', $sku);
$result ->execute();
for($i=0; $row = $result->fetch();$i++){
?>

<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Edit Product</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">




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
            <li class="nav-item">
              <a class="nav-link" href="add.php">ADD PRODUCTS</a>
            </li>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container" style="margin-top:4em;">

      <!-- Jumbotron Header -->
      <header class="my-4 text-center">
        <h1 class="display-5">EDIT PRODUCT</h1>
      </header>
      <div class="col-lg-6" style="margin:auto;">
		<form method="post" action="edit.php">
		  <div class="form-group">
			<input type="hidden" class="form-control" name="sku" value="<?php echo $sku?>">
		  </div>
		  <div class="form-group">
			<label>Title</label>
			<input type="text" class="form-control" name="title" value="<?php echo $row['title']?>">
		  </div>
		  <div class="form-group">
			<label>Short Description</label>
			<input type="text" class="form-control" name="shortDesc" value="<?php echo $row['shortDesc']?>">
		  </div>
		  <div class="form-group">
			<label>Long Description</label>
			<textarea type="text" class="form-control" name="longDesc" value="<?php echo $row['longDesc']?>"></textarea>
		  </div>
			  <div class="form-group">
			<label>Price</label>
			<input type="text" class="form-control" name="price" value="<?php echo $row['price']?>">
		  </div>
		  <div class="form-group">
			<label>Image File Path</label>
			<input type="text" class="form-control" name="price" value="<?php echo $row['image']?>">
			<small class="text-muted">for example "images/example.jpg" </small>
		  </div>
		  <button type="submit" class="btn btn-primary" value="save">Submit</button>
		</form>
		</div>
   <?php } ?>
    </div>
     <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>
  </body>

</html>