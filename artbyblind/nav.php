<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class=" skew navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand skew hidden-sm hidden-xs" href="index.php">ART BY BLIND</a>
    </div>
    <a href="index.php"><img class="logo" src="images/logo.png"></a>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
		 <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">ART<span class="caret"></span></a>
      <ul class="dropdown-menu">
      <?php
		  include('connect.php');
 	   $result = $db->prepare("SELECT * FROM products ORDER BY id ASC LIMIT 6");
	   $result->execute();
	   for($i=0; $row = $result->fetch();$i++)
	   	{
 		?>
        <li>
        	<a href="#"><?php echo $row['title'];?></a>
        </li> 
        <?php } ?>               
      </ul>
    </li>
        <li><a class="nav-link" href="#about">ABOUT</a></li>
        <li><a class="nav-link" href="#donate">DONATE</a></li>
        <li><a class="nav-link" href="#contact">CONTACT</a></li>
        <li class=""><a><span class="glyphicon glyphicon-cart"></span>CART</a></li>
        <li class="modalBtn"><a><span class="glyphicon glyphicon-user"></span>LOGIN</a></li>
        <li><a href="admin-products.php"><span class="glyphicon glyphicon-lock"></span>ADMIN</a></li>
      </ul>
    </div>
  </div>
</nav>