<?php 
include ("connect.php");
$query = $db->prepare("SELECT * FROM upload");
$query->execute();  ?>

<!-- HTML FORM PART -->
<!DOCTYPE html><html lang="en"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Download As Zip</title></head>
<body><center><font face="Andalus" size="+2" color="#0033FF"><b><h1>Create Zip</h1></b></font></center>   <form name="zips" method="post" action="zip_download.php"> 
<table width="300" border="1" align="center" cellpadding="10" cellspacing="0" 
	style="border:#ccc 1px solid; 
    border-radius:5px;">
  <tr>
    <td width="33" align="center">*</td>
    <td width="382"><b>File Name</b></td>
  </tr>
<?php //Fetch Data from Database, and dsiplay it to download.
	while($row1=$query->fetch(PDO::FETCH_ASSOC))
	{
		$name=$row1['name']; ?>
  	
   	 <tr><td align="center"><input type="checkbox" 
         name="sel_files[]" value="<?php echo $name ;?>" /></td>
   		 <td><?php echo $name ;?></td></tr>        
<?php } ?>
<tr><td colspan="2" align="center">    

<input type="submit" name="download_zip"

	style = "border:0px; 
 background-color:#06F; 
			color:#FFF; 
		  padding:10px; 
		   cursor:pointer; 
	  font-weight:bold; 
	border-radius:5px;" 
    
value="Download as ZIP"/>

&nbsp;

<input type="reset" name="reset"  

	style =  "border:0px; 
	background-color:#D3D3D3; 
			   color:#000; 
		 font-weight:bold; 
			 padding:10px; 
			  cursor:pointer; 
	   border-radius:5px;" 

value="Reset" /> 

</td></tr></table> </form></body></html>
 <!-- HTML FORM PART ENDS --> 

