<?php 
	
session_start();
include('connect.php');
include('functions.php');?>
<!DOCTYPE html>
<html lang="en">
<?php include('head.php'); ?>
<body>
<?php
	//Associate array to display 2 types of error message.
	$errors = array( 1=>"Invalid user name or password, Try again",
				     2=>"Please login to access this area" );
	//Get the error_id from URL
	$error_id="0";
	if(isset($_GET['err'])){
		$error_id = $_GET['err'];
	}
	if  ($error_id == 1)
	{
		echo '<p class="text-danger">'.$errors[$error_id].'</p>';
	}
	elseif ($error_id == 2)
	{
		echo '<p class="text-danger">'.$errors[$error_id].'</p>';
	}
	elseif ($error_id == 3)
	{
		
		// remove all session variables
		session_unset();

		// destroy the session
		session_destroy();
	}
	include('nav.php');
	?> 
<div class="container-fluid">
	<div class="jumbotron b-tron-alt" style="margin-top:7em;">
	 <div class="container">
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">

        <div class="item active">
      <img src="caro3.png" alt="...">
    </div>
        <div class="item">
      <img src="caro2.png" alt="...">
    </div>
    <div class="item">
      <img src="Blind_orange.jpeg" alt="...">
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
	  </div>
	</div>
</div>

<div class="container-fluid">
<div class="jumbotron b-tron">
<div class="container">
	<h2 id="projects" class="navTitle">FEATURED PRODUCTS</h2>
	<?php include 'connect.php';
	   $result = $db->prepare("SELECT * FROM products ORDER BY id ASC LIMIT 6");
	   $result ->execute();
	   for($i=0; $row = $result->fetch();$i++)
	   {


	
	?><div class="col-lg-4 col-sm-6">
		<div class="container b-card">
		<div class="row">
			<img src="<?php echo $row['image']; ?>" class="img-thumbnail"/>
			</div>
			<div class="row">
			<form action="" method="post">
			<h4><?php echo $row['title'];?></h4>
			<p><?php echo $row['variant'];?></p>
			<h4>$<?php echo $row['price'];?></h4>
			<a class="btn btn-wide btn-custom" href=>VIEW</a>
			</br></br>
	    	<a class="btn btn-wide btn-custom" href="index.php?add_cart=<?php echo $row['id']; ?>">Add to Cart</a>
		    </form>
			</div>
		</div>
	</div>

<?php
	   }
cart();
?>
	</div>
</div>
</div>
<div class="container-fluid">
	<div class="jumbotron b-tron-alt">
		<div class="container">
	 		<h2 id="reccomended" class="navTitle">NEW ITEMS</h2>
  <?php include('connect.php');
 	   $result = $db->prepare("SELECT * FROM products ORDER BY id ASC LIMIT 8");
	   $result->execute();
	   for($i=0; $row = $result->fetch();$i++)
	   {
		
 	?>
	<div class="col-lg-3 col-sm-6">
		<div class="container b-card">
		<div class="row">
			<img src="<?php echo $row['image']; ?>" class="img-thumbnail" alt=""/>
			</div>
			<div class="row">
			<h4><?php echo $row['title'];?></h4>
			<p><?php echo $row['variant'];?></p>
			<h4>$<?php echo $row['price'];?></h4>
			<a class="btn btn-wide btn-custom" href=>VIEW</a>
			</div>
		</div>
	</div>
		   
	  <?php }
	   
			?>
	  </div>
	</div>
</div>

<?php include('footer.php'); ?>
<script> 
	//expanding skills table
$(document).ready(function(){
	
    $(".trExpand1").click(function(){
        $(".trHide1").slideToggle(function(){
			if ($(this).is(':visible')) {
             $(".btnExpand1").text("--");                
        } else {
             $(".btnExpand1").text('+');                
        }   
		});
    });
	    $(".trExpand2").click(function(){
        $(".trHide2").slideToggle(function(){
			if ($(this).is(':visible')) {
             $(".btnExpand2").text("--");                
        } else {
             $(".btnExpand2").text('+');                
        }   
		});
    });
	    $(".trExpand3").click(function(){
        $(".trHide3").slideToggle(function(){
			if ($(this).is(':visible')) {
             $(".btnExpand3").text("--");                
        } else {
             $(".btnExpand3").text('+');                
        }   
		});
    });
});
</script>

<script>
	//navigation scrolling
	$('.nav-link').click(function(){
    $('html, body').animate({
        scrollTop: $( $(this).attr('href') ).offset().top
    }, 500);
    return false;
});</script>

<script>
$(document).ready(function(){
    $(".dropdown-toggle").dropdown();
});
</script>

	</body>
</html>
