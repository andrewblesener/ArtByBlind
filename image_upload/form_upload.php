<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Image Upload</title>
</head>
<body>
<div id="container">
	<div class="content">
			<form action="form_upload.php" method="post" enctype="multipart/form-data">
			<fieldset>
				<table width="350" border="0" align="center">
					<legend>
						Data Entry 
						<tr>
							<td>
								<label>
									Image Name <span class="required">*</span>
								</label>
							</td>
							<td align="center"><input type="text" name="iname" placeholder="Image Name"></br></td>
						</tr>
						<tr>
							<td>
								<label for="file">Upload Picture:</label>
							</td>
							<td align="right"><input type="file" name="file" id="file"><br></td>
						</tr>
						<tr><td>&nbsp; </td></tr>
						<tr><td colspan="2" align="center"><button type="submit" name="submit">Submit</button>
						<br><br><a href="view_data.php?">View Data</a></td></tr>
						<tr><td colspan="2">&nbsp; </td></tr>
						<tr><td colspan="2" align="center">
							<?php
							//PHP part
							if(isset($_REQUEST['submit']))
							{
								// open a new connection to the MySQL server
								$con=mysqli_connect("localhost","root","","admin");
								
								// Check connection
								if (mysqli_connect_errno()) // returns the error code
								{
									//return the last error description 
									echo "Failed to connect to MySQL: " . mysqli_error();
								}
								
								$iname = $_POST['iname'];
								$file  = $_FILES["file"]["name"];
								$size  = $_FILES["file"]["size"];
								
								//Checking if 'image name' entered and 'File attachment' has been done. 
								if(empty($iname) || empty($file))
								{
									echo "<label class='err'>All field is required</label>";
								}
								
								//Checking the File Size. Maximum allowed size: 500,000 bytes (500 kb)
								elseif($size > 500000)
								{
									echo "<label class='err'> Image size must not be greater than 500kb </label>";
								}
								
								/*-- Few preperations for checking
										the file type (extension) --*/
								
								//Store the allowed extension in an array 
								$allowedExts = array("gif", "jpeg", "jpg", "png", "x-png", "pjpeg", "txt");
								
								/* using explode() functoin, seperate the 'File Name'
								and its 'Extension' into individual elements of an array: $temp */
								$temp = explode(".", $_FILES["file"]["name"]);
								
								/* The end() function returns the last element of an array.
								as per array $temp, First element: File name
													 Last element: Extension */
								$extension = end($temp);
								
								/* -- Checking the file type (extension) --*/
								if((($_FILES["file"]["type"] == "image/gif")
								 || ($_FILES["file"]["type"] == "image/jpeg")
								 || ($_FILES["file"]["type"] == "image/jpg")
								 || ($_FILES["file"]["type"] == "image/pjpeg")
								 || ($_FILES["file"]["type"] == "image/x-png")
								 || ($_FILES["file"]["type"] == "image/txt")
								 || ($_FILES["file"]["type"] == "image/png"))
								 && ($_FILES["file"]["size"] <= 500000)
								 && in_array($extension, $allowedExts))
								 /* The in_array() searches for a specific value in an array. 
								 	Here, searches for $extension value in $allowedExts array */
								  {
									/*If file is of allowed extension type, then further
										validations for file are processed */
									
									  // Checks if theres any error
									  if ($_FILES["file"]["error"] > 0)
									  {
										  echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
									  }
									  elseif (file_exists("upload/" . $_FILES["file"]["name"]))
									  {
										  echo $_FILES["file"]["name"] . "Image upload already exists. ";
									  }
									  
									  /* On passing all validations, the file is moved from temporary 
									  	Location to the directory */
									  else
									  {
										  /* The move_uploaded_file() function mives an 
										  	Uploaded file to a new location. */
										  move_uploaded_file($_FILES["file"]["tmp_name"],
															"upload/" . $_FILES["file"]["name"]);
										  
										  //Insert the "Image name" and File name to the database
										  mysqli_query($con,"INSERT INTO amalan (iname, filename)
										  									VALUES ('$iname', '$file')");
										  echo "Data Entered Successfully Saved!";
									  }
								  }
								mysqli_close($con); //Close the Database Connection
							} 
							?>
						</td></tr>
					</legend>
				</table>
			</fieldset>
		</form> 
	</div>
	
</div>
</body>
</html>