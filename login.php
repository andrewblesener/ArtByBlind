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
						<td><input type="password" name="password"></td>
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