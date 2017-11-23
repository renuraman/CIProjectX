<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('loggedin')){
			$this->session->set_flashdata('no_access', 'sorry you are not allowed');
			redirect('login');
		}
		$this->load->helper('email');


	}
	
	public function index()
	{
		$this->load->model('user_model');
		$data['users'] = $this->user_model->get_users();
		$data['main_view'] = 'users/index';
		$this->load->view('layouts/main', $data); 
	}

public function delete()
	{
		 $user_id = $this->input->post('user_id');
		
		$this->load->model('user_model');
		$data = $this->user_model->delete_user($user_id);
		
		echo json_encode($data);
		
		
		
		/* $this->session->set_flashdata('user_inactive', 'user is made inactive');
					redirect("users/index"); */
	}
	
	
	public function add(){
	$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('conpassword', 'confirm Password', 'trim|required|min_length[3]|matches[password]');

		if($this->form_validation->run() == FALSE){
		$data=array(
		'err'=>validation_errors()
		);
		$this->session->set_flashdata($data);
		$data['main_view'] = "users/add_users";
				$this->load->view('layouts/main', $data);
		}else{
		
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$email = $this->input->post('email');
		$user_type = $this->input->post('user_type');



		$this->load->model('user_model');
		$this->user_model->create_user($username, $password, $email, $user_type);
		$this->session->set_flashdata('user_registered', 'user has been registered');
		redirect('users/index');
		}
	
	}
	
	
	public function edit($user_id)
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
		
		
		
		if($this->form_validation->run() == False){
			
				$this->load->model('user_model');
				$data['user_data'] = $this->user_model->get_user_info($user_id);

				$data['main_view'] = 'users/edit_user';
				$this->load->view('layouts/main', $data);
				
			} else {
				
			
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$email = $this->input->post('email');
				$user_type = $this->input->post('user_type');

				

				$this->load->model('user_model');
				if($this->user_model->edit_user($user_id, $username, $password, $email, $user_type)){
					$this->session->set_flashdata('project_updated', 'your project has been updated');
					redirect("users/index");
				}
			}
	}
	
	public function CheckUserExists(){
	$val = "";
	$name=$this->input->post('name');
	$this->load->model('user_model');
	$data= $this->user_model->mdl_CheckUserExists($name);
	foreach($data as $value){
	$val = $value;
	}
/*print_r($data);*/
 	$data1 = array(
	'usernameexists' => $val,
	'name'=>$name
	);
	echo json_encode($data1);  

	}
	
	public function CheckEmailExists(){
	$val = "";
	$user_email = $this->input->post('email');
	$this->load->model('user_model');
	$data=$this->user_model->mdl_CheckEmailExists($user_email);	
	
	foreach($data as $value){
	$val = $value;
	}
/*print_r($data);*/
 	$data1 = array(
	'useremailexists' => $val,
	'email'=>$user_email
	);
	echo json_encode($data1);
 	
	}
		
	
}
