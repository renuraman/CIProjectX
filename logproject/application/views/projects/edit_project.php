<div class="container" style="background-color:#d9edf7">

<div class="row">
        <a href="<?php echo base_url(); ?>projects/" class="btn btn-xs" style="background-color:brown; color:#fff">
          <span class="glyphicon glyphicon-backward"></span> Back
        </a>
</div>


<form action="<?php echo base_url(); ?>projects/edit/<?php echo $project_data->pro_id;?>" method="post" class="form-horizontal">

<h2><center>Edit Project</center></h2>

	<div class="form-group">
        <label class="col-xs-3 control-label">Project</label>

        <div class="col-xs-5">
			<input type="text" class="form-control" name="proname" value="<?php echo $project_data->proname; ?>">
		</div>
	</div>
	
	
	<div class="form-group">
        <label class="col-xs-3 control-label">Client</label>

        <div class="col-xs-5">
			<input type="text" class="form-control" name="clientname" value="<?php echo $project_data->clientname; ?>">
		</div>
	</div>
	
	<div class="form-group">
        <label class="col-xs-3 control-label">Start Date</label>

        <div class="col-xs-5">
            <div class="input-group input-append date" id="startDate">
                <input type="text" class="form-control" name="startdate" value="<?php echo $project_data->start_date; ?>" readonly/>
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
    </div>

	
	<div class="form-group">
        <label class="col-xs-3 control-label">End Date</label>

        <div class="col-xs-5">
            <div class="input-group input-append date" id="endDate">
                <input type="text" class="form-control" name="enddate" value="<?php echo $project_data->end_date; ?>"/>
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
    </div>


	<div class="form-group">
		<label class="col-xs-3 control-label"></label>

		<div class="col-xs-5">
			<input type="submit" name="submit" value="submit" class="btn btn-primary">
			<a href="<?php echo base_url(); ?>projects/"><button type="button" class="btn btn-primary" style="margin-left:10px;">Cancel</button></a>
		</div>
	</div>
	
</div>




