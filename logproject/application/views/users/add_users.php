<div class="container" style="background-color:#d9edf7">

	<div class="row">
		<a href="<?php echo base_url(); ?>users/" class="btn btn-xs" style="background-color:brown; color:#fff">
			<span class="glyphicon glyphicon-backward"></span> Back
		</a>
	</div>



	<?php
	echo '<p class="bg-danger">';
	if($this->session->flashdata('login_failed')){
		echo $this->session->flashdata('login_failed');
	}
	echo '</p>';

	if($this->session->flashdata('err')){
		echo $this->session->flashdata('err');
	}?>


	<form action="<?php echo base_url(); ?>users/add/" method="post" class="form-horizontal">

	<h2><center>Add Users</center></h2>

	<div class="form-group">
		<label class="col-xs-3 control-label">Username</label>

		<div class="col-xs-5">
			<input type="text" class="form-control" name="username" placeholder="Name" id="txtUserName">
			<div id="divoutput"></div>
		</div>
	</div>	


	<div class="form-group">
		<label class="col-xs-3 control-label">Password</label>

		<div class="col-xs-5">
			<input type="password" class="form-control" name="password" placeholder="Password">
		</div>
	</div>


	<div class="form-group">
		<label class="col-xs-3 control-label">Confirm Password</label>

		<div class="col-xs-5">
			<input type="password" class="form-control" name="conpassword" placeholder="Confirm Password">
		</div>
	</div>


	<div class="form-group">
		<label class="col-xs-3 control-label">Email</label>

		<div class="col-xs-5">
			<input type="text" class="form-control" name="email" placeholder="Email" id="txtUserEmail">
			<div id="emailoutput"></div>
		</div>
	</div>	



	<div class="form-group">
		<label class="col-xs-3 control-label">Users</label>
		<div class="col-xs-5">
			<select name="user_type" class="form-control">
				<option value="1">Admin</option>
				<option value="0">User</option>
			</select>
		</div>
	</div>


	<div class="form-group">
		<label class="col-xs-3 control-label"></label>

		<div class="col-xs-5">
			<input type="submit" name="submit" value="Register" class="btn btn-primary" id="sbmt_user">
			<a href="<?php echo base_url(); ?>users/"><button type="button" class="btn btn-primary" style="margin-left:10px;">Cancel</button></a>
		</div>
	</div>

	</form>

</div>

<script type="text/javascript">

	$(document).ready(function() {
		
<!---------------- username keyup validation ------------------------->
		$("#txtUserName").keyup(function(){
			
			var username = $(this).val();
			if(username.length > 2){
				$.ajax({
					url:"<?php echo base_url(); ?>" + "users/CheckUserExists",
					data:{"name":username},
					method:"post",
					dataType:'json',
					success:function(data){
						var op = $("#divoutput");
						if(data.usernameexists==0){
							op.text(username+" is available");
							op.css('color', 'green');
							$('#sbmt_user').removeAttr('disabled', false);
						}else{
							op.text(username+" is in use");
							op.css('color', 'red');
							$('#sbmt_user').attr('disabled', 'disabled');			
						}			
					}		
				}); 
			}else{
				$("#divoutput").text('');
			}
			
		});//end keyup	
<!-------------- username keyup validation ------------------------->


<!-------------- email blur validation ------------------------->
		$('#txtUserEmail').blur(function(){
			var useremail = $(this).val();
			$.ajax({
				url:"<?php echo base_url(); ?>" + "users/CheckEmailExists",
				data:{"email":useremail},
				method:"post",
				dataType:'json',
				success:function(data){
					if(data.useremailexists==0){
						$("#emailoutput").text(useremail+" is available");
						$("#emailoutput").css('color', 'green');
						$('#sbmt_user').removeAttr('disabled', false);
					}else{
						$("#emailoutput").text(useremail+" is in use");
						$("#emailoutput").css('color', 'red');
						$('#sbmt_user').attr('disabled', 'disabled');			
					}
				}
			}); 
		}); // end blur
<!----------------- email blur validation ------------------------->


	});//end ready
</script>
