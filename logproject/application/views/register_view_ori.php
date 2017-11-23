<?php
echo '<p class="bg-danger">';
if($this->session->flashdata('login_failed')){
echo $this->session->flashdata('login_failed');
}
echo '</p>';

if($this->session->flashdata('err')){
echo $this->session->flashdata('err');
}
/* echo form_open('users/register');


echo '<div>';
echo form_label('Username');
$data = array(
 'class'=>'form-control',
 'name'=>'username',
 'placeholder'=>'Enter your name'
);
echo form_input($data);
echo '</div>'; 


echo '<div>';
echo form_label('Password');
$data = array(
 'class'=>'form-control',
 'name'=>'password',
 'placeholder'=>'Enter your Password'
);
echo form_password($data);
echo '</div>'; 


echo '<div>';
echo form_label('Confirm Password');
$data = array(
 'class'=>'form-control',
 'name'=>'conpassword',
 'placeholder'=>'Confirm Password'
);
echo form_password($data);
echo '</div>'; 


echo '<div>';
echo form_label('Email');
$data = array(
 'class'=>'form-control',
 'name'=>'email',
 'placeholder'=>'Email'
);
echo form_input($data);
echo '</div>';

echo '<div>';
$data = array(
 'class'=>'btn btn-primary',
 'value'=>'Register',
 'name'=>'submit'
);
echo form_submit($data);
echo '</div>';


echo form_close();
 */?>


	     <div class="container">    

        <div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Sign Up</div>
                            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
                        </div>  
                        <div class="panel-body" >
                            <form id="signupform" class="form-horizontal" role="form">
                                
                                <div id="signupalert" style="display:none" class="alert alert-danger">
                                    <p>Error:</p>
                                    <span></span>
                                </div>
                                    
                                
                                  
                                
                                    
                                <div class="form-group">
                                    <label for="firstname" class="col-md-3 control-label">First Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="firstname" placeholder="First Name">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label for="firstname" class="col-md-3 control-label">First Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="firstname" placeholder="First Name">
                                    </div>
                                </div>

								
                                <div class="form-group">
                                    <label for="email" class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="email" placeholder="Email Address">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="conpassword" placeholder="Password">
                                    </div>
                                </div>
                                    


                                <div class="form-group">
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-9">
                                        <button id="btn-signup" type="button" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
                                       <!-- <span style="margin-left:8px;">or</span>-->  
                                    </div>
                                </div>
                                
                                
                                
                                
                                
                            </form>
                         </div>
                    </div>

               
               
                
         </div> 
         </div> 

 
 
