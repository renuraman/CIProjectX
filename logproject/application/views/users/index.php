<div class="container">

	<div class="row">
		<a href="<?php echo base_url(); ?>admin/" class="btn btn-xs" style="background-color:brown; color:#fff">
			<span class="glyphicon glyphicon-backward"></span> Back
		</a>
	</div>

	<div class="row">
		<center><h2>Users</h2></center>
		
		<?php 
		if($this->session->flashdata('user_inactive')){
			echo '<center><p class="bg-danger">';
			echo $this->session->flashdata('user_inactive');
			echo '</p></center>';
		} 
		?>

		<a href="<?php echo base_url(); ?>users/add"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus">Add</span></button></a>
			<table class="table table-responsive table-hovered table-striped table-bordered" id="tblUsers">
			<thead><tr>
			
				<th>User Name</th>
				<th>Password</th>
				<th>Email</th>
				<th>User Type</th>
				<th>Actions</th>

			</tr></thead>
			<tbody>

				<?php 
				foreach($users as $user){
					echo '<tr id="row'.$user->user_id.'">';
						echo '<td>';
						echo $user->username;
						echo '</td>';
						echo '<td>';
						echo $user->password;	
						echo '</td>';
						echo '<td>';
						echo $user->email;	
						echo '</td>';
						echo '<td>';
						echo $user->user_type;	
						echo '</td>';?>
						
						<td>
						<a href="<?php echo base_url(); ?>users/edit/<?php echo $user->user_id ?>"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-edit">Edit</span></button></a>
					
						
						
						<button type="button" class="btn btn-primary" id="status<?php echo $user->user_id ?>">Block</button>
						
						<script>
						$(document).ready(function() {
							$("#status<?php echo $user->user_id; ?>").click(function(){
								var check =  confirm('are you sure you want to remove this?');
								if(check == true){
								$.ajax({
									url:"<?php echo base_url(); ?>" + "users/delete", 
									data:{'user_id':"<?php echo $user->user_id; ?>" },
									method:'POST',
									dataType: 'json',				
									success: function(data){
									$('#row<?php echo $user->user_id; ?>').hide();										
									}
								});
								}else{
									return false;
								}
							});
						});
						</script> 
						</td>
						
						</tr>		
				<?php 	
				} 
				?>

			</tbody>
			</table>
	</div>	
</div>





