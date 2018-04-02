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
	<div id="container">
		<div class="con2">
			<?php 
				//Database Connection
				$con = mysqli_connect("localhost", "root", "", "sindhu");
			
				// Retrieve the data from the database table
				$query = mysqli_query($con, "SELECT * FROM amalan");
			
				// mysqli_fetch_assoc() fetches a result row as an associative array 
				$get_pic = mysqli_fetch_assoc($query);
			?>
			
			<!-- Create HTML table to display image -->
			<table align="" cellspacing="0" width="300" border="0">
				
		<?php do { ?>
		
			<!-- Display image from directory, by calling its name --> 
			<tr bordercolor="#FFFFFF" > <td colspan="2" align="">
			<?php echo '<img src="upload/'.$get_pic['filename'].'
						"width ="200" height="175">'; ?>
			</td></tr>
			<td>
				<button>
						<a href="edit_data.php?id=<?php echo $get_pic[2]['id']; ?>"
						style="text-decoration:none"> Edit 
						</a>
				</button>
				<br><br> 
				<button><a href="delete_data.php?id=<?php echo $get_pic[1]['id']; ?>"
							style="text-decoration:none"> Delete </a>
				</button>
			</td>
			
			
			<!-- Display the Image Name, entered by user while uploading the image -->
			<tr><td colspan="2" align="center"><h2><font face="Jokerman">
			<?php echo strtoupper($get_pic['iname']); ?></font></h2>
			</td></tr>
			
		<?php } while ($get_pic = mysqli_fetch_assoc($query));
				
				mysqli_close($con); //Close the Database connection 
				?>
			</table>
			<center>
				<h2><a href="upload_form.php"> Back to Data Entry </a></h2>
			</center>
		</div>
	</div>
</body>
</html>