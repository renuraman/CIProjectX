<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
	public function __construct() {
        parent:: __construct();
        // Load encryption library
        $this->load->library('encrypt');
    }
	
	public function index()
	{
		$data['main_view'] = 'login_view';
		$this->load->view('layouts/main', $data); 
	}
	
	
	public function user_type()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if($this->form_validation->run() == FALSE){
			$data = array(
			'errors' => validation_errors()
			);
			//print_r($data);
			$this->session->set_flashdata($data);
			redirect('login');
			
		} else { 
		
			$username = $this->input->post('username');
			$password = $this->input->post('password');



			$this->load->model('user_model');
			$user_id=$this->user_model->login_user($username);
			if($user_id){
				
				$user_data=array(
				'user_id' => $user_id->user_id,
				'username' => $username,
				'user_type' => $user_id->user_type,
				'loggedin' => true);

				if((md5($password)) == $user_id->password){
					$this->session->set_userdata($user_data);
					$this->session->set_flashdata('login_success', 'you are now logged in');
					
					if($user_id->user_type == 1){
						
						redirect('admin/');
						
					}else{
						
						redirect('dailylogs/');
						
					}
					
				}else{
					
					$this->session->set_flashdata('something_wrong', 'password or username not matching');
					redirect('login');
					
				}


			} else {
				
				$this->session->set_flashdata('login_failed', 'you are not a registered user... contact the Administrator');
				redirect('login');
			
			}


		}
	}
	
	public function project_name(){
		if($this->session->userdata('loggedin')){
			$user_id = $this->session->userdata('user_id');		
		}
	}
	
	
	
	
    public function reminder(){
		
		$this->load->model('reminder_model');
		$maxdate = $this->reminder_model->find_email();
		//print_r($maxdate);
	   			
		$config = Array(
		'protocol' => 'smtp',
		'smtp_host' => 'ssl://smtp.googlemail.com',
		'smtp_port' => 465,
		'smtp_user' => 'fabcodersmailer@gmail.com',
		'smtp_pass' => 'fcMail#2016',
		'mailtype'  => 'html', 
		'charset'   => 'iso-8859-1'
		);
						
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

		$this->email->from('renuraman1j@gmail.com', 'Renuka');
		$this->email->to($maxdate);

		$this->email->subject('Email Test');
		$this->email->message('Please enter the last dailyLog');

		$sent=$this->email->send();
		
		if($sent){
			$this->session->set_flashdata('email_sent', 'A reminder is sent to enter the DailyLog');
			redirect("admin/index");
		}else{
			$this->session->set_flashdata('no_email', 'Everyone has filled the DailyLog');
			redirect("admin/index");
		}
    }
	
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('login');
	} 
}
