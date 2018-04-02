<?php include('connect.php'); ?>
<!doctype html>
<html>
<head>
<?php include('head.php');?>
</head>
<body>
<?php include('nav.php');?>
   <div class="side-menu">
    
    <nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <div class="brand-wrapper">

 
    <!-- Main Menu -->
    <div class="side-menu-container">
        <ul class="nav navbar-nav">

                       <!-- Dropdown-->
            <li class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" href="#dropdown-lvl1">
                    <span class="glyphicon glyphicon-user"></span>PRODUCTS<span class="caret"></span>
                </a>

                <!-- Dropdown level 1 -->
                <div id="dropdown-lvl1" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="nav navbar-nav">
                           <li><a href="admin/index.php">VIEW</a></li>
							<li><a href="admin/add.php">ADD</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li><a href="#"><span class="glyphicon glyphicon-fire"></span>ORDERS</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-fire"></span>CUSTOMERS</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-cloud"></span>USERS</a></li>
        </ul>
    </div>
		</div>
		</div>
</nav>
    </div>
 
    <div class="container">
    	<div class="row">
    		    <div class="view-mode">
		<span id="card-icon" class="glyphicon glyphicon-th view-icon"></span>
		<span id="table-icon" class="glyphicon glyphicon-th-list view-icon"></span>
    </div>
    	<form class="form-inline" method="post" action="search.php">
	<input style="border-radius:0px" class="form-control input-lg" type="text" name="srch_query" placeholder="Search here..." required>
	<input class="btn btn-custom btn-lg" type="submit" name="search" value="search" style="border-radius: 0px;">
</form>
    	</div>
    </div>
   <div class="col-lg-offset-3 col-lg-8" style="margin-top:5em;">
 <div class=" card-view container-fluid text-center">
<div class="jumbotron">
<div class="container">
	<h2 id="projects" class="navTitle">INVENTORY</h2>

	<?php include 'connect.php';
	   $result = $db->prepare("SELECT * FROM products ORDER BY sku ASC LIMIT 6");
	   $result ->execute();
	
	   for($i=0; $row = $result->fetch();$i++)
	   {

	?><div class="col-lg-3 col-sm-6">
		<div class="container b-card">
		<div class="row">
			<img src="http://via.placeholder.com/200x200" class="img-thumbnail"/>
			</div>
			<div class="row">
			<h4><?php echo $row['title'];?></h4>
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
</div>
 <div class="col-lg-offset-3 col-lg-8" style="margin-top:5em;">
 <div class=" table-view container-fluid text-center" style="display: none;">
<div class="jumbotron">
<div class="container">
	<h2 id="projects" class="navTitle">INVENTORY</h2>
<table class="table text-center" >
	<thead>
		<tr>
		<th class="text-center">IMAGE</th>
		<th class="text-center">SKU</th>
		<th class="text-center">TITLE</th>
		<th class="text-center">PRICE</th>
		<th class="text-center">EDIT</th>
		</tr>
	</thead>
	<tbody>
	<?php include 'connect.php';
	   $result = $db->prepare("SELECT * FROM products ORDER BY sku ASC LIMIT 6");
	   $result ->execute();
	
	   for($i=0; $row = $result->fetch();$i++)
	   {
	?>
		<tr>
			<td><img src="http://via.placeholder.com/50x50" class="img-thumbnail"/></td>
			<td><?php echo $row['sku'];?></td>
			<td><?php echo $row['title'];?></td>
			<td>$<?php echo $row['price'];?></td>
			<td><a class="btn btn-small btn-custom" href=>EDIT</a></td>
		</tr>
<?php
	   }
	
	?>
		</tbody>
	</table>
	</div>
	 </div>
	 </div>
	</div>
<?php include('footer.php'); ?>
<script>
$('#card-icon,#table-icon').click(function(){
	$('.card-view,.table-view').toggle();
});
	</script>
</body>
</html>