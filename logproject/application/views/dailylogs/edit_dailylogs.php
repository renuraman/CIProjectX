<div class="container" style="background-color:#d9edf7">

<div class="row">
	<a href="<?php echo base_url(); ?>dailylogs/" class="btn btn-xs" style="background-color:brown; color:#fff">
		<span class="glyphicon glyphicon-backward"></span> Back
	</a>
</div>	


<form action="<?php echo base_url(); ?>dailylogs/edit/<?php echo $log_data->log_id;?>" method="post" class="form-horizontal">

	
	<h2><center>Edit Daily Log</center></h2>
	
		
	<div class="form-group">
        <label class="col-xs-3 control-label">Date</label>

        <div class="col-xs-5">
            <div class="input-group input-append date" id="dateRangePicker">
                <input type="text" class="form-control" name="entry_date" value="<?php echo $log_data->entry_date; ?>" readonly/>
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
    </div>

	
	<div class="form-group">
		<label class="col-xs-3 control-label">Time Used</label>

		<div class="col-xs-5">
				<input type="text" class="form-control" value="<?php echo $log_data->time_used ?>" name="time_used" id="txt"/>			
			
		</div>
	</div>
	
	
	
	
	
<?php

//echo $log_data->pro_id;
	echo '<div class="form-group">';
	echo '<label class="col-xs-3 control-label">Projects</label>';

	echo '<div class="col-xs-5">';

	echo '<select name="projects" class="form-control">';
	foreach($pro_name as $pro){?>
	
		<option value=<?php echo $pro->pro_id;		
		if($pro->pro_id == $log_data->pro_id) { ?> selected="selected" <?php } ?>>
		<?php echo $pro->proname; ?>
		
		</option>
		
	<?php }		
	echo '</select>';
	echo '</div>'; 
	echo '</div>'; 
	
		
	echo '<div class="form-group">';
	echo '<label class="col-xs-3 control-label">Task Details</label>';
	echo '<div class="col-xs-5">';

	echo '<textarea class="form-control" rows="5" id="task_desc" name="task_desc" >'.$log_data->task_desc.'</textarea>';
	echo '</div>';

    echo '</div>';

	
	echo '<div class="form-group">';
	echo '<label class="col-xs-3 control-label"></label>';

	echo '<div class="col-xs-5">';
	echo '<input type="submit" name="submit" value="submit" class="btn btn-primary" id="sbmt_user">';?>
	<a href="<?php echo base_url(); ?>dailylogs/"><button type="button" class="btn btn-primary" style="margin-left:10px;">Cancel</button></a>

	<?php 
	echo '</div>';
	echo '</div>';
	
echo '<form>';
?>
</div>

    <script>
        $(document).ready(function () {
            var txt = $("#txt");
            txt.mask('99:99').val('<?php echo $log_data->time_used ?>');

            $("#txt").blur(function () {
                var txtTime = $(this).val();
                var hrs = txtTime.substr(0, 2);
				//alert(hrs);
                var min = txtTime.substr(3, 4);
				//alert(min);

                //following code validates hours and minutes 
				if(hrs != 'hh' || min != 'mm'){
					if (parseInt(hrs) > 24 || parseInt(min) > 60){
						alert("Please enter valid hours (00-24) and valid mins (00-60)");
						$('#sbmt_user').attr('disabled', 'disabled');
						
					}else{
						$('#sbmt_user').removeAttr('disabled', false);
					}						
				}else{
					$('#sbmt_user').removeAttr('disabled', false);
				}


            }); //end blur

        });//end ready
    </script>

