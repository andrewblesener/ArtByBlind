
<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" style="margin-right: 2em;" data-dismiss="modal">&times;</button>
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
						<td><input type="password" name="p_assword"></td>
					</tr>
					<tr>
						<td> Re-Enter Password</td>
						<td><input type="password" name="p_assword2"></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><input type="textarea" name="a_ddress"></td>
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
function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}

if(isset($_POST['addbtn']))
{
	
	try
	{
		// define variables and set to empty values
		$fname = $lname = $username = $password = $address = $phone_number = $email = "";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		  $fname = test_input($_POST["f_name"]);
		  $lname = test_input($_POST["l_name"]);
		  $username = test_input($_POST["u_sername"]);
		  $password = test_input($_POST["p_assword"]);
		  $address = test_input($_POST["a_ddress"]);
		  $phone_number = test_input($_POST["p_number"]);
		  $email = test_input($_POST["e_address"]);
		}

		
		include('connect.php');
		$stmt = $db->prepare("INSERT INTO person(first_name,last_name,access_level,username,password,address, phone_number, email)
										VALUES(:Fname,:Lname,:Access_level,:Username,:Password,:Address,:Phone_number, :Email)");
		$stmt->execute(array("Fname" => $fname, "Lname" => $lname,"Access_level" => 'user', "Username" => $username,"Password" => $password, "Address" => $address, "Phone_number" => $phone_number, "Email" => $email));

	}
	catch(PDOException $e)
	{
		echo 'ERROR: ' . $e->getMessage();
	}
	
	
}
?>