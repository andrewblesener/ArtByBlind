<?php session_start();
include('connect.php');?>
<!DOCTYPE html>
<html lang="en">
<?php include('head.php'); ?>
<body>
<?php include('nav.php');?>
<?php
	//Associate array to display 2 types of error message.
	$errors = array( 1=>"Invalid user name or password, Try again",
				     2=>"Please login to access this area" );
	//Get the error_id from URL
	$error_id="0";
	$error_id = $_GET['err'];
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
		unset($_SESSION['sess_user_id']);
		unset($_SESSION['sess_username']);
		unset($_SESSION['sess_userrole']);
		header('Location: index.php');
	}
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
			<h4><?php echo $row['title'];?></h4>
			<p><?php echo $row['variant'];?></p>
			<h4>$<?php echo $row['price'];?></h4>
			<a class="btn btn-wide btn-custom" href=>VIEW</a>
			</div>
		</div>
	</div>
<?php
	   }
	
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
<div class="container-fluid">
	<div class="jumbotron b-tron">
	 <div class="container">
	<div class="b-modal hide">
	 <div class="b-modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">LOG IN</h4>
		  </div>
		  <div class="modal-body">
			<form method="POST" action="authenticate.php">
				<table class="table table-hover">
					<tr>
						<td>Username</td>
						<td><input type="text" name="username"></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="text" name="password"></td>
					</tr>
					<tr>
						<td></td>
						<td><input class="btn btn-success" type="submit" name="log_submit" value="Log In"></td>
						
						 
					</tr>
				</table>
			</form>
		  </div>
		  
		</div>
	</div>
	
	</div>
		</div>
</div>
<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Welcome!</h4>
		  </div>
		  <div class="modal-body">
			<form method="POST" action="">
				<h3>Register User</h3>
				<table class="table table-hover">
					<tr>
						<td>First Name</td>
						<td><input type="text" name="f_name"></td>
					</tr>
					<tr>
						<td>Last Name</td>
						<td><input type="text" name="l_name"></td>
					</tr>
					<tr>
						<td>Username</td>
						<td><input type="text" name="u_sername"></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="text" name="p_assword"></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><input type="text" name="a_ddress"></td>
					</tr>
					<tr>
						<td>Phone Number</td>
						<td><input type="text" name="p_number"></td>
					</tr>
					<tr>
						<td>Email Address</td>
						<td><input type="text" name="e_address"></td>
					</tr>
					<tr>
						<td></td>
						<td><input class="btn btn-success" type="submit" name="addbtn" value="Register"></td>
					</tr>
				</table>
			</form>
		  </div>
		  
		</div>
	</div>
	
	</div>
		
<?php
if(isset($_POST['addbtn']))
{
	try{
		include('connect.php');
		$stmt = $db->prepare("INSERT INTO person(first_name,last_name,access_level,username,password,address, phone_number, email)
										VALUES(:Fname,:Lname,:Access_level,:Username,:Password,:Address,:Phone_number, :Email)");
		$stmt->execute(array("Fname" => $_POST['f_name'], "Lname" => $_POST['l_name'],"Access_level" => 'user', "Username" => $_POST['u_sername'],"Password" => $_POST['p_assword'], "Address" => $_POST['a_ddress'], "Phone_number" => $_POST['p_number'], "Email" => $_POST['e_address']));
		header("location: index.php");
	}
	catch(PDOException $e)
	{
		echo 'ERROR: ' . $e->getMessage();
	}
}
?>
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
	//resume modal for log in
$(document).ready(function(){
	$(".modalBtn").click(function(){
		$(".b-modal").addClass("appear").removeClass("hide");
	});
	$(".close").click(function(){
		$(".b-modal").addClass("hide").removeClass("appear");
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
