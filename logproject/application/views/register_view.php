<?php
echo '<p class="bg-danger">';
if($this->session->flashdata('login_failed')){
echo $this->session->flashdata('login_failed');
}
echo '</p>';

if($this->session->flashdata('err')){
echo $this->session->flashdata('err');
}
echo form_open('users/register');


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
 
 
 ?>