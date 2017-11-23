<?php 

if($this->session->flashdata('email_sent')){
	echo '<p class="bg-success">';
		echo $this->session->flashdata('email_sent');
	echo '</p>';
}

if($this->session->flashdata('no_email')){
	echo '<p class="bg-success">';
		echo $this->session->flashdata('no_email');
	echo '</p>';
}

?>

<div class="container-fluid">

	<div class="row">
		<h2>Admin</h2>
		<div>
			<a href="<?php echo base_url();?>users/"><button type="button" class="btn btn-primary">Users</button></a>
			<a href="<?php echo base_url();?>projects/"><button type="button" class="btn btn-primary">Projects</button></a>
			<a href="<?php echo base_url();?>reports"><button type="button" id="reports" class="btn btn-primary">Reports</button></a>
			<a href="<?php echo base_url(); ?>login/reminder"><button type="button" class="btn btn-primary">Send Reminder</button></a>
		</div>
	</div>

</div>







