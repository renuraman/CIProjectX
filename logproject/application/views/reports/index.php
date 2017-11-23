<div class="container">

	<div class="row">
		<p>
			<a href="<?php echo base_url(); ?>admin/" class="btn btn-xs" style="background-color:brown; color:#fff">
			<span class="glyphicon glyphicon-backward"></span> Back</a>
		</p>
	</div>



<div class="row panel-info" style="background:#d9edf7;">

	<div class="form-group col-md-4">

		<label>Users:</label>
		<select name="users" class="form-control" id="users">
			<option value="-1">select User</option>
			<?php
			foreach($users as $user){
			echo '<option value="'.$user->user_id.'">'.$user->username.'</option>';
			}
			?>	
		</select>
		<button type="button" id="btnReset" class="btn btn-md btn-primary" style="margin-top:10px">Reset</button>
		
	</div>

	<div class="form-group col-md-4">
		<label>Projects:</label>
		<select name="projects" class="form-control" id="projects">
			<option value="-1">select project</option>
			<?php
			foreach($projects as $pro){
			echo '<option value="'.$pro->pro_id.'">'.$pro->proname.'</option>';
			}
			?>	
		</select>
	</div>

	<div class="form-group col-md-4">
		<label class="control-label">Entry Date:</label>  
		<div class="input-group input-append date" id="dateRangePicker">
			<input type="text" class="form-control" id="txtDate" name="entry_date" placeholder="Date"/>
			<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
		</div>
	</div>
	
</div>


<div class="row">
	<div id="show">
		<table id="tblreport" class="table table-responsive table-hovered table-striped table-bordered">
			<thead>
				<tr>
				<th>Entry Date</th>
				<th>User Name</th>
				<th>Project Name</th>
				<th>Task Details</th>
				<th>Time used</th>
				</tr>
			</thead>
			<tbody>

			</tbody>	

			<p><div id="tot_time" class="btn btn-md btn-default"></div></p>
		
		</table>
	</div>
</div>

</div>


<script type="text/javascript">
	$(document).ready(function() {
		var userName=-1;
		var projName=-1;
		var entryDate="";


		report(userName,projName,entryDate);

		$("#btnReset").click(function(){
			$('#users').val('-1');
			$('#projects').val('-1');
			$('#txtDate').val('');

			var userName=-1;
			var projName=-1;
			var entryDate="";

			report(userName,projName,entryDate);
		});//end btn click

		$('#users').change(function(){
			userName=$(this).val();
			projName=$('#projects').val();
			entryDate=$('#txtDate').val();

			if(userName==-1)
			{
				userName=-1;
			}

			if(projName==-1)
			{
				projName=-1;
			}
			if(entryDate.length==0)
			{
				entryDate=-1;
			}

			report(userName,projName,entryDate);
		});//end change user

		$('#projects').change(function(){

			projName=$(this).val();
			userName=$('#users').val();
			entryDate=$('#txtDate').val();

			if(userName==-1)
			{
			userName=-1;
			}

			if(projName==-1)
			{
			projName=-1;
			}
			if(entryDate.length==0)
			{
			entryDate=-1;
			}

			report(userName,projName,entryDate);
		});//end proName change

		$('#txtDate').change(function(){

			entryDate=$(this).val();
			userName=$('#users').val();
			projName=$('#projects').val();

			if(userName==-1)
			{
			userName=-1;
			}

			if(projName==-1)
			{
			projName=-1;
			}
			if(entryDate.length==0)
			{
			entryDate=-1;
			}

			report(userName,projName,entryDate);
		});//end date user


		function report(userName,projName,entryDate)
		{	
			$.ajax({
				url:"<?php echo base_url(); ?>" + "reports/SelectLogDataAjax", 
				data:{'name':userName,'proName':projName,'entDate':entryDate},
				method:'POST',
				dataType: 'json',	
				success: function(data){

					$("#tblreport").dataTable({
						destroy: true,
						data:data,
						dom: 'Blfrtip',
						columns:[
						{'data':'entry_date'},
						{'data':'username'},
						{'data':'proname'},
						{'data':'task_desc'},
						{'data':'time_used'},
						],						
						buttons: [
						'copy', 
						{
							extend: 'csv',
							text: 'export to csv',
							extension: '.csv',
							exportOptions: {
							modifier: {
							page: 'current'
							}
							},
							title: 'table'
						},
						{
							extend: 'pdf',
							text: 'export to pdf',
							extension: '.pdf',
							exportOptions: {
							modifier: {
							page: 'current'
							}
							},
							title: 'table'
						},
						'print'
						]

					});	

					var table =  $('#tblreport').DataTable();
					var sum = table.column(4, {page:'current'}).data().sum(); 
					$("#tot_time").text('Total Time Used is '+ sum + " mins" );
				},

				error:function(err){
				alert(err);
				}

			});//end ajax

		}//end report func
	});//end ready
</script>


