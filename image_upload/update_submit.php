<?php
	if(isset($_REQUEST['submit']))
	{
		//require "edit.php"; 
		//display edit_data.php HTML elements
		
		//Open a new connection to MySQL server.
		$con = mysqli_connect("localhost", "root", "", "admin0000");
		
		$id = $_GET['id']; //Get the id of the row to be edited
		
		// Check connection 
		if (mysqli_connect_errno()) // Returns the error code 
		{
			//Return the last error description 
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		
		/*--- IMAGE NAME PART -- */
		
		/* --- Image name: should be either same name or enter new name. 
			   but, should not be empty. */
		if (empty($_REQUEST['iname']) )
		{
			echo "Image name required";
		}
		
		else
		{
			$iname = $_REQUEST['iname'];
			mysqli_query($con, "UPDATE amalan SET iname = '$iname' WHERE id = $id'");
			header("Location:view_data.php");
		}
		
		/* --- FILE PART -- */
		/* Updating new image file is not REQUIRED.
			However, if upload a new image file, it should be validated! */
		
		/* If auto-global $_FILES is TRUE: i.e. have some data,
			it shows, that a new file has been uploaded. */
		if ($_FILES)
		{
			$file = $_FILES["file"]["name"];
			$size = $_FILES["file"]["size"];
			
			/* -- File Validation -- */
			// Checking the File Size. Maximum allowed size: 500,000 bytes (500 kb)
			if($size > 500000)
			{
				echo "Image size must not greater than 500kb";
			}
			
			/* Few preperations for checking the File type (extension) */
			// Store the allowed extensions in an array 
			$allowedExts = array("gif", "jpeg", "jpg", "png", "x-png", "pjpeg", "txt");
			
			/* Using explode() function, seperate the 'File Name' and its 'Extension'
				into individual elements of an array: $temp */
			$temp = explode(".", $_FILES["file"]["name"]);
			
			/* The End() function returns the last element of an array.
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
			  else
			/* On passing all validations:
				(1) Delete the old image file from the directory
				(2) Move the new file from temporary location to the directory
				(3) Update the database */
				  
				/* To delete existing image,
				first retrieve its File name, from database based on 'id' */
			  {
				  $query = mysqli_query($con, "SELECT filename FROM amalan WHERE id = '$id'");
				  
				/* mysqli_fetch_assoc() function fetches a result row as an associative array. */
				  $imageFile = mysqli_fetch_assoc($query);
				  
				// The unlink(file name) function deletes the file.
				  unlink("upload/" .$imageFile['filename']);
				  
				// Move the new file to the directory using move_uploaded_file()
				  move_uploaded_file( $_FILES["file"]["tmp_name"],
										"upload/" . $_FILES["file"]["name"]);
				  
				// Update the 'File Name' to the database
				  mysqli_query($con, "UPDATE amalan SET filename = '$file' WHERE id = '$id'");
				  header("Location: view_data.php");
			  }}}
				mysqli_close($con); //Close the Database Connection
		//SLIDE 33
	}?>