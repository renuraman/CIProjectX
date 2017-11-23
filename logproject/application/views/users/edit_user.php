<div class="container" style="background-color:#d9edf7">

	<div class="row">
		<a href="<?php echo base_url(); ?>users/" class="btn btn-xs" style="background-color:brown; color:#fff">
			<span class="glyphicon glyphicon-backward"></span> Back
		</a>
	</div>


	<form action="<?php echo base_url(); ?>users/edit/<?php echo $user_data->user_id;?>" method="post" class="form-horizontal">

		<h2><center>Edit User</center></h2>

		<div class="form-group">
			<label class="col-xs-3 control-label">User</label>

			<div class="col-xs-5">
				<input type="text" class="form-control" name="username" value="<?php echo $user_data->username; ?>">
			</div>
		</div>

		<div class="form-group">
			<label class="col-xs-3 control-label">Password</label>

			<div class="col-xs-5">
				<input type="password" class="form-control" name="password" value="<?php echo $user_data->password; ?>">
			</div>
		</div>


		<div class="form-group">
			<label class="col-xs-3 control-label">Email</label>

			<div class="col-xs-5">
				<input type="text" class="form-control" name="email" value="<?php echo $user_data->email; ?>">
			</div>
		</div>


		<div class="form-group">
			<label class="col-xs-3 control-label">Users</label>

			<div class="col-xs-5">
				<select name="user_type" class="form-control">
					<option value="1"<?php if($user_data->user_type == 1 ) { ?> selected="selected" <?php } ?>>Admin</option>
					<option value="0"<?php if($user_data->user_type == 0 ) { ?> selected="selected" <?php } ?>>User</option>			
				</select>
			</div>
		</div>

		<div class="form-group">
			<label class="col-xs-3 control-label"></label>

			<div class="col-xs-5">
				<input type="submit" name="submit" value="submit" class="btn btn-primary">
				<a href="<?php echo base_url(); ?>users/"><button type="button" class="btn btn-primary" style="margin-left:10px;">Cancel</button></a>
			</div>
		</div>

	</form>

</div>

