<?php
$error = ""; //Initializing error holder

include ("index.php"); //to display html elements if required

if(isset($_POST['download_zip']))
{
	$file_folder = "files/"; // folder to load files from
		
	// Checking ZIP extension is available
	if(extension_loaded('zip'))
	{	
		// Checking files are selected
		if(isset($_POST['sel_files']) and count($_POST['sel_files']) > 0)
		{	
			
			//Initiate a new instance of ZipArchive - by loading zip library
			$zip = new ZipArchive();				
			
			//Setting the value of time() as Zip name
			$zip_name = time().".zip";			
			
			/* Opening zip file to load files ; create the archive if it does not exist. */
			if($zip->open($zip_name, ZIPARCHIVE::CREATE)!==TRUE)
			{		
				$error .=  "* Sorry ZIP creation failed at this time<br/>";
			}
				
			foreach($_POST['sel_files'] as $file)
			{				
				/* addFile — Adds a file to a ZIP archive from the given path*/
				$zip->addFile($file_folder.$file); 
			}
				
			$zip->close(); // Close the zip file. 
				
			if(file_exists($zip_name))
			{	
				// push to download the zip
				header('Content-type: application/zip');
				
				// Content-Disposition - the name/value pair defining the attributes of file
				header('Content-Disposition: attachment; filename="'.$zip_name.'"');
					
				// Reads a file and writes it to the output buffer. 
				readfile($zip_name);
					
				// remove zip file is exists in temp path
				unlink($zip_name);
			}		
		}
		else { $error .= "* Please select file to zip <br/>"; }
	}
	else { $error .= "* You dont have ZIP extension<br/>"; }
}

if(!empty($error)) 
{ ?> 
	<br>    
    <p     
    style= " border:#C10000 1px solid; 
   background-color:#FFA8A8; 
    		  color:#B00000;
    		padding:8px; 
   			  width:300px; 
    		 margin:0 auto 10px;" > 
             
		<?php echo $error; ?></p>            
<?php 
} ?>
  
  