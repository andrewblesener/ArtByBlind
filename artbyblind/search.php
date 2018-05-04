<?php
session_start();
include('connect.php');
if(isset($_POST['search']))
{
	$q = $_POST['srch_query'];

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Art By Blind - Admin</title>

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
              <a class="nav-link" href="#">INVENTORY
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="add.php">ADD PRODUCTS</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container" style="margin-top:4em";>

      <!-- Jumbotron Header -->
      <header class="my-4 text-center">
        <h1 class="display-5">SEARCH RESULTS</h1>
        <div class="row" style="justify-content: center;">
 <form class="form-inline" method="post" action="search.php">
	<input style="border-radius:0px" class="form-control input-lg" type="text" name="srch_query" placeholder="Search here..." required>
	<input class="btn" type="submit" name="search" value="search" style="border-radius: 0px;">
</form>
<a href="add.php"><div class="btn btn-primary btn-md"  type="button" style="margin:1em;">Add Products &#43;</div></a>
     </div>
     <div class="row text-center">
<?php
$search = $db->prepare("SELECT * FROM products
						WHERE title LIKE '%$q%' OR
								shortDesc LIKE '%$q'");
	$search->execute();
	
	if($search->rowcount()==0){ echo "No match found!";}
	else
	{
		?>
	<?php foreach($search as $s)
		{
			?>
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card">
            <img class="card-img-top" src="<?php echo $s['image'];?>" alt="<?php echo $row['title'];?>">
            <div class="card-body">
              <h4 class="card-title"><?php echo $s['title'];?></h4>
              <p class="card-text"><?php echo $s['shortDesc'];?></p>
             <h4 class="card-text">$<?php echo $s['price'];?></h4>
            </div>
            <div class="card-footer">
             <div class="btn-group" role="group">
              <a href="editform.php?sku=<?php echo $s['sku']; ?>"><div type="button" class="btn btn-primary">EDIT</div></a>
              <a href="delete.php?sku=<?php echo $s['sku']; ?>"><div type="button" class="btn btn-danger">DELETE</div></a>
            </div>
			</div>
          </div>
        </div>
		<?php }
	}
} ?>
		  </div>
</div>

    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->

  </body>

</html>
	</body>
</html>