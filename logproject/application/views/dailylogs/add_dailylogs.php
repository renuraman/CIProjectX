<div class="container" style="background-color:#d9edf7">

<div class="row">
        <a href="<?php echo base_url(); ?>dailylogs/" class="btn btn-xs" style="background-color:brown; color:#fff">
          <span class="glyphicon glyphicon-backward"></span> Back
        </a>
</div>

<form action="<?php echo base_url(); ?>dailylogs/add" method="post" class="form-horizontal">
		
	<h2><center>Add Daily Log</center></h2>
	
	<?php
	
	if($this->session->flashdata('logs_err')){
	echo '<p class="bg-danger">';
	echo $this->session->flashdata('logs_err');
	echo '</p>';
	}
	?>
		
	<div class="form-group">
        <label class="col-xs-3 control-label">Date</label>

        <div class="col-xs-5">
            <div class="input-group input-append date" id="dateRangePicker">
                <input type="text" class="form-control" name="entry_date" placeholder="Date" readonly/>
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
    </div>

	
	<div class="form-group">
		<label class="col-xs-3 control-label">Time Used</label>

		<div class="col-xs-5">
				<input type="text" class="form-control" placeholder="Time frame" name="time_used" id="txt"/>					
		</div>
	</div>

	
	<?php

	echo '<div class="form-group">';
	echo '<label class="col-xs-3 control-label">Projects</label>';
	echo '<div class="col-xs-5">';

	echo '<select name="projects" class="form-control">';
	echo '<option value="">select project</option>';

	foreach($projects as $pro){
		echo '<option value="'.$pro->pro_id.'">'.$pro->proname.'</option>';
	}	
	
	echo '</select>';
	echo '</div>';

	echo '</div>';
	
	
	echo '<div class="form-group">';
	echo '<label class="col-xs-3 control-label">Task Details</label>';
	echo '<div class="col-xs-5">';

	echo '<textarea class="form-control" rows="15" id="task_desc" placeholder="task description" name="task_desc"></textarea>';
	echo '</div>';

    echo '</div>';
	
	echo '<div class="form-group">';
	echo '<label class="col-xs-3 control-label"></label>';

	echo '<div class="col-xs-5">';
	echo '<input type="submit" name="submit" value="submit" class="btn btn-primary" id="sbmt_user">';
	echo '<a href="index"><button type="button" class="btn btn-primary" style="margin-left:10px;">Cancel</button></a>';

	echo '</div>';
	echo '</div>';

	
echo '<form>';

 ?>
 
 </div>

 
 
 <script>
        $(document).ready(function () {
            var txt = $("#txt");
            txt.mask('99:99').val('hh:mm');

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
  
