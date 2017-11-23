<div class="container-fluid">




           <div class="row">

        <a href="<?php echo base_url(); ?>admin/" class="btn btn-xs" style="background-color:brown; color:#fff">
          <span class="glyphicon glyphicon-backward"></span> Back
        </a>
      </div>
      

<div class="row">
    
	 <center><h2>Projects</h2></center>
	 
<?php

	if($this->session->flashdata('project_updated')){
		echo '<center><p class="bg-success">';
		echo $this->session->flashdata('project_updated');
		echo '</p></center>';
	}
	
	if($this->session->flashdata('project_added')){
		echo '<center><p class="bg-success">';
		echo $this->session->flashdata('project_added');
		echo '</p></center>';
	}
	
	?>

	<a href="<?php echo base_url(); ?>projects/add"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus">Add</span></button></a>
	<table class="table table-responsive table-hovered table-striped table-bordered">
	<thead><tr>
	<th>Project Name</th>
	<th>Client Name</th>
	<th>Start Date</th>
	<th>End Date</th>
	<th>Actions</th>

	</tr></thead>
	<tbody>

	<?php foreach($projects as $pro){
		echo '<tr><td>';
		echo $pro->proname;
		echo '</td>';
		echo '<td>';
		echo $pro->clientname;	
		echo '</td>';
		echo '<td>';
		echo $pro->start_date;	
		echo '</td>';
		echo '<td>';
		echo $pro->end_date;	
		echo '</td>';?>
	
<td>
	<a href="<?php echo base_url(); ?>projects/edit/<?php echo $pro->pro_id ?>"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-edit">Edit</span></button></a>

	<?php 						
		echo '</td></tr>';		
	} ?>

	</tbody>
	
	</table>

	
  </div>
</div>


