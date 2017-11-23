<div class="container" style="background-color:#d9edf7">

<div class="row">
        <a href="<?php echo base_url(); ?>projects/" class="btn btn-xs" style="background-color:brown; color:#fff">
          <span class="glyphicon glyphicon-backward"></span> Back
        </a>
</div>


<?php 
$attributes = array('id'=>'create_form', 'class' => 'form-horizontal');
echo form_open('projects/add', $attributes);
?>

	<h2><center>Add Project</center></h2>
	
	<?php
	
	if($this->session->flashdata('pro_err')){
	echo '<p class="bg-danger">';
	echo $this->session->flashdata('pro_err');
	echo '</p>';
	}
	?>
	
	<div class="form-group">
        <label class="col-xs-3 control-label">Project</label>

        <div class="col-xs-5">
			<input type="text" class="form-control" name="proname" placeholder="Project Name">
		</div>
	</div>
	
	
	<div class="form-group">
        <label class="col-xs-3 control-label">Client</label>

        <div class="col-xs-5">
			<input type="text" class="form-control" name="clientname" placeholder="Client Name">
		</div>
	</div>
    
	
	<div class="form-group">
        <label class="col-xs-3 control-label">Start Date</label>

        <div class="col-xs-5">
            <div class="input-group input-append date" id="startDate">
                <input type="text" class="form-control" name="startdate" placeholder="Start Date" readonly/>
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
    </div>

	
	<div class="form-group">
        <label class="col-xs-3 control-label">End Date</label>

        <div class="col-xs-5">
            <div class="input-group input-append date" id="endDate">
                <input type="text" class="form-control" name="enddate" placeholder="End Date" readonly/>
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
    </div>
<?php

	echo '<div class="form-group">';
	echo '<label class="col-xs-3 control-label"></label>';

	echo '<div class="col-xs-5">';
	echo '<input type="submit" name="submit" value="submit" class="btn btn-primary">';
	echo '<a href="index"><button type="button" class="btn btn-primary" style="margin-left:10px;">Cancel</button></a>';

	echo '</div>';
	echo '</div>';

	echo form_close();
	
?>

</div>


