<html>
<link href="style.css" rel="stylesheet" type="text/css">
<style type="text/css"></style>
<body>
<?php
	// Database Connection 
	$con = mysqli_connect("localhost", "root", "", "sindhu");
		
	// Get the id of the row to be edited
	$id = $_GET['id'];
	
	// Retrieve the data from the database table 
	$query = mysqli_query($con, "SELECT * FROM amalan WHERE id = $id");
	
	/* mysqli_fetch_assoc() fetches a result row as an associative array. */
	for($i=0; $get_data = mysqli_fetch_assoc($query); $i++)
	{ ?>
		<div id="container">
			<div class="content">
				<form action="update_submit.php?id=<?php echo $get_data['id']; ?>"
						method="post" enctype="multipart/form-data">
							<fieldset>
								<table width="420" border="0" align="center">
									<legend>UPDATE DATA
										<tr>
											<td>
												Current Image Name
											</td>
											<td width="229">
												<input type="text" name="iname" 
													   value="<?php echo $get_data['iname']; ?>"/></br>
											</td>
										</tr>
										
										<tr>
											<td colspan="2"><br><br>
												Current Image
											</td>
										</tr>
										
										<tr>
											<td colspan="2" align="center">
												<img src="upload/<?php echo $get_data['filename']; ?>"
														width="150" height="150" >
											</td>
										</tr>
										
										<tr>
											<td>
												<br>Replace with new Image:
											</td>
											<td align="right"><br>
												<input type="file" name="file" id="file">
												<br>
											</td>
										</tr>
											
										<tr><td>&nbsp;
											
										</td></tr>
										
										<tr>
											<td colspan="2" align="center">
												<button name="submit">Submit</button>
											

												<?php } mysqli_close($con); //Close the Database Connection
												?>
												<br><br>
													<a href="view_data.php?">View Data</a>
												<br>

													<a href="upload_form.php">Add New Data</a>
											</td>
										</tr>
									</legend>
								</table>
							</fieldset>
						</form>
			</div>
		</div>
</body>
</html>