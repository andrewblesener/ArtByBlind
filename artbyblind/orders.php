<?php session_start();
include('connect.php');?>

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
              <a class="nav-link" href="index.php">INVENTORY
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="add.php">ADD PRODUCTS</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="orders.php">ORDERS</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container" style="margin-top:4em";>

      <!-- Jumbotron Header -->
      <header class="my-4 text-center">
        <h1 class="display-5">ORDERS</h1>
        <div class="row" style="justify-content: center;">
 <form class="form-inline" method="post" action="search.php">
	<input style="border-radius:0px" class="form-control input-lg" type="text" name="srch_query" placeholder="Search here..." required>
	<input class="btn" type="submit" name="search" value="search" style="border-radius: 0px;">
</form>
<a href="add.php"><div class="btn btn-primary btn-md"  type="button" style="margin:1em;">Add Products &#43;</div></a>
     </div>
      </header>

<table class="table">
<thead>
	<tr>
		<th>OrderID</th>
		<th>CustID</th>
		<th>Date</th>
		<th>Total</th>
		<th>Fulfilled?</th>
	</tr>
	</thead>
	<tbody>
		<?php include 'connect.php';
	   $result = $db->prepare("SELECT * FROM orders ORDER BY orderID ASC");
	   $result ->execute();
	   for($i=0; $row = $result->fetch();$i++)
	   { ?>
        <tr>
        	<td><?php echo $row['orderID'];?></td>
        	<td><?php echo $row['custID'];?></td>
        	<td><?php echo $row['orderDate'];?></td>
        	<td>$<?php echo $row['total'];?></td>
        	
        	<?php $fulfil = $row['fulfilled'];
			if($fulfil == 1)
			{
				echo "<td class='bg-success'>YES</td>";
			}
			elseif($fulfil == 0)
			{
      			echo "<td class='bg-danger'>NO</td>";
			}
			?>
       	
        	
        </tr>
        <?php } ?>
	</tbody>
</table>

      </div>
      <!-- /.row -->

    </div>

  </body>

</html>
