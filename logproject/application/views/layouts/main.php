<!DOCTYPE html>
<html lang="en">
<head>
<title>Page Title</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--bootstrap files-->
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<!--bootstrap files-->
 
<!-- bootstrap clockpicker -->  
<script src="<?php echo base_url();?>assets/js/bootstrap-clockpicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-clockpicker.min.css">
<!--<link rel="stylesheet" type="text/css" href="assets/css/github.min.css">-->
<!-- bootstrap clockpicker -->

<!-- time mask -->
<script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
<!-- time mask -->


<!-- jq datatables -->
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/pdfmake-0.1.27/dt-1.10.15/b-1.3.1/b-colvis-1.3.1/b-flash-1.3.1/b-html5-1.3.1/b-print-1.3.1/r-2.1.1/se-1.2.2/datatables.min.js"></script>
<script src="http://cdn.datatables.net/plug-ins/1.10.15/api/sum().js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/pdfmake-0.1.27/dt-1.10.15/b-1.3.1/b-colvis-1.3.1/b-flash-1.3.1/b-html5-1.3.1/b-print-1.3.1/r-2.1.1/se-1.2.2/datatables.min.css"/>
<!-- jqdatatables-->

<!-- datepicker -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<link rel="http://stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
<!-- datepicker-->


<script>
$(document).ready(function(){

$('#dateRangePicker').datepicker({
        format: 'mm/dd/yyyy',
        endDate: '+0d',
        autoclose: true
    });
	



$('.clockpicker').clockpicker({
        twelvehour: false,
		placement: 'bottom' // clock popover placement
	});
	

		
		$('#startDate').datepicker({
	format: 'mm/dd/yyyy',
	autoclose: true,
	}).on('changeDate', function (selected) {
	var startDate = new Date(selected.date.valueOf());
	$('#endDate').datepicker('setStartDate', startDate);
	}).on('clearDate', function (selected) {
	$('#endDate').datepicker('setStartDate', null);
	});
$("#endDate").datepicker({
	format: 'mm/dd/yyyy',
	autoclose: true,
	}).on('changeDate', function (selected) {
	var endDate = new Date(selected.date.valueOf());
	$('#startDate').datepicker('setEndDate', endDate);
	}).on('clearDate', function (selected) {
	$('#startDate').datepicker('setEndDate', null);
	});



});
</script>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
	  <?php 
	   if($this->session->userdata('user_type') == 0){
		   $url="dailylogs/";
	  }else{
		  $url="admin/";
	  }
	  ?>
      <a class="navbar-brand" href="<?php echo base_url().$url ?>" style="padding:0"><img src="<?php echo base_url() ?>assets/img/fab_logo.png" style="max-width:30% ; padding:0"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	  
      <!--<ul class="nav navbar-nav navbar-right">-->
	  <ul class="nav navbar-nav navbar-right" data-hover="dropdown" data-animations="fadeInDown fadeInRight fadeInUp fadeInLeft">
	  <?php if($this->session->userdata('loggedin')){?>
	  <li><a style="color:brown">Welcome <?php echo strtoupper($this->session->userdata('username')); ?></a></li>
        <li><a href="<?php echo base_url(); ?>login/logout">logout</a></li>
		<?php } else { ?>
		<li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-log-in"></span> login</a></li>
		<?php } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>




<div class="container-fluid">
  <div class="row">
    <div class="container">
	<?php $this->load->view($main_view); ?>
	</div>
	</div>
</div>

</body>
</html>



