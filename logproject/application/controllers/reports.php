<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

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
	}
		
	public function index()
	{
		
		// project data
		$this->load->model('project_model');
		$data['projects'] = $this->project_model->get_projects();
		
		//user data
		$this->load->model('user_model');
		$data['users'] = $this->user_model->getOnlyUsers();
		
		
		$data['main_view'] = 'reports/index'; 
		$this->load->view('layouts/main', $data);

	}

	public function SelectLogDataAjax()
	{
		$name=$this->input->post('name');
		$proName=$this->input->post('proName');	
		$entDate=$this->input->post('entDate');	
		

		$this->load->model('report_model');
		$data=$this->report_model->getLogData($name,$proName,$entDate);
		echo json_encode($data);   
	}
	
}
