<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends CI_Controller {

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
		$this->load->model('project_model');
		$data['projects'] = $this->project_model->get_projects();
		$data['main_view'] = 'projects/index';
		$this->load->view('layouts/main', $data); 
	}


	public function edit($project_id)
	{
	$this->form_validation->set_rules('proname', 'Project Name', 'trim|required');
	$this->form_validation->set_rules('clientname', 'Client Name', 'trim|required');
	$this->form_validation->set_rules('startdate', 'Start Date', 'trim|required');
	

		if($this->form_validation->run() == False){
			
				$this->load->model('project_model');
				$data['project_data'] = $this->project_model->get_projects_info($project_id);

				$data['main_view'] = 'projects/edit_project';
				$this->load->view('layouts/main', $data);
				
			} else {
				
				$data = array(
				'proname' => $this->input->post('proname'),
				'clientname' => $this->input->post('clientname'),
				'start_date' => $this->input->post('startdate'),
				'end_date' => $this->input->post('enddate')

				);

				$this->load->model('project_model');
				if($this->project_model->edit_project($project_id, $data)){
					$this->session->set_flashdata('project_updated', 'The Project is Updated');
					redirect("projects/index");
				}
			}
	}


	public function add(){

		$this->form_validation->set_rules('proname', 'Project Name', 'trim|required');
		$this->form_validation->set_rules('clientname', 'Client Name', 'trim|required');
		$this->form_validation->set_rules('startdate', 'Start Date', 'trim|required');

		if($this->form_validation->run() == False){
			$data=array(
			'pro_err'=>validation_errors()
			);
			$this->session->set_flashdata($data);
			$data['main_view'] = 'projects/add_project';
			$this->load->view('layouts/main', $data);
			
		} else {

			$data = array(
			'proname' => $this->input->post('proname'),
			'clientname' => $this->input->post('clientname'),
			'start_date	' => $this->input->post('startdate'),
			'end_date' => $this->input->post('enddate')
			);

			$this->load->model('project_model');
			if($this->project_model->add_project($data)){
				$this->session->set_flashdata('project_added', 'The project is Added');
				redirect("projects/index");
			}

		}		
	}


	public function delete($project_id)
	{
		$this->load->model('project_model');
		if($this->project_model->del_project($project_id)){
			$this->session->set_flashdata('project_deleted', 'your project has been deleted');
			redirect("projects/index");		
		}
	}
	
	
}
