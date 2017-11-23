<div class="container-fluid">
  <div class="row">
    <center><h2>User Log Entry</h2></center>

<?php	if($this->session->flashdata('DailyLog_added')){
		echo '<center><p class="bg-success">';
		echo $this->session->flashdata('DailyLog_added');
		echo '</p></center>';
	}
	
	?>
	
	<a href="<?php echo base_url(); ?>dailylogs/add"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus">Add</span></button></a>
	<table class="table table-responsive table-hovered table-striped table-bordered">
	<thead><tr>
	<th>Task description</th>
	<th>Project Name</th>
	<th>Entry Date</th>
	<th>Time Used</th>
	<th>Actions</th>
	</tr></thead>
	<tbody>

	<?php foreach($dailylogs as $row){
		echo '<tr><td>';
		echo $row->task_desc;
		echo '</td>';
		echo '<td>';
		echo $row->proname;	
		echo '</td>';
		echo '<td>';
		echo $row->entry_date;	
		echo '</td>';
		echo '<td>';
		echo $row->time_used;	
		echo '</td>';


		echo '<td>';?>
		
			<a href="<?php echo base_url(); ?>dailylogs/edit/<?php echo $row->log_id ?>"><button type="button" class="btn btn-primary">
			<span class="glyphicon glyphicon-edit">Edit</span></button></a>
	<a onclick="return confirm('Are you sure you want to delete this record?')" href="<?php echo base_url(); ?>dailylogs/delete/<?php echo $row->log_id ?>">
	<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash">Delete</span></button></a>


		
		<?php
		echo '</td></tr>';		
	} ?>

	</tbody>
	
	<table>
    <p><?php echo $links; ?></p>

  </div>
</div>


