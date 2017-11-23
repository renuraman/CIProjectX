<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dailylogs extends CI_Controller {

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
			$this->session->set_flashdata('no_access', 'Please Sign In');
			redirect('login');
		}
	}
	
	public function index()
	{
		$id = $this->session->userdata('user_id');
		$config = array();
		$config["base_url"] = base_url() . "dailylogs/index";
		
		$this->load->model('dailylogs_model');
		
		$config["total_rows"] = $this->dailylogs_model->record_count($id);
		$config["per_page"] = 4;
		$config["uri_segment"] = 3;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = round($choice);
		
		$currentPage = floor(($this->uri->segment(3)/$config['per_page']) + 1);  
		
		$this->load->library("pagination");
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$data["dailylogs"] = $this->dailylogs_model->get_dailylogs($config["per_page"], $page, $id);
		$data["links"] = $this->pagination->create_links();
		
		$data['main_view'] = 'dailylogs/index';
		$this->load->view('layouts/main', $data); 
	}
	
	
	public function add()
	{
		
		
		$this->form_validation->set_rules('entry_date', 'Entry Date', 'trim|required');
		$this->form_validation->set_rules('projects', 'Project Name', 'trim|required');
		$this->form_validation->set_rules('task_desc', 'Task description', 'trim|required');
		$this->form_validation->set_rules('time_used', 'Time Frame', 'trim|required');

		if($this->form_validation->run() == False){
	
			$data=array(
			'logs_err'=>validation_errors()
			);
			$this->session->set_flashdata($data);
			
			$this->load->model('project_model');
		    $data['projects'] = $this->project_model->get_projects();
			
			$data['main_view'] = 'dailylogs/add_dailylogs';
			$this->load->view('layouts/main', $data);
			
		} else {

			if($this->session->userdata('loggedin')){
				$id = $this->session->userdata('user_id');
			}

			$entry_date = $this->input->post('entry_date');
			$projects = $this->input->post('projects');
			$task_desc = $this->input->post('task_desc');
			$time_used = $this->input->post('time_used');
			
			
			/* $this->load->model('project_model');
		    $data['projects'] = $this->project_model->get_projects(); */
			

			$this->load->model('dailylogs_model');			
			if($this->dailylogs_model->add_dailylogs($entry_date, $task_desc, $projects, $id, $time_used)){
				$this->session->set_flashdata('DailyLog_added', 'Your DailyLog is Added');
				redirect("dailylogs/index");
			}

				
	}	

	}

	
	
	public function delete($log_id)
	{
		$this->load->model('dailylogs_model');
		if($this->dailylogs_model->del_log($log_id)){
			$this->session->set_flashdata('log_deleted', 'record has been deleted');
			redirect("dailylogs/index");		
		}
	}
	
	
	
	
	public function edit($log_id)
	{

		$this->load->model('project_model');
		$data['pro_name'] = $this->project_model->get_projects();

		$this->form_validation->set_rules('entry_date', 'Entry Date', 'trim|required');
		$this->form_validation->set_rules('task_desc', 'Task Description', 'trim|required');
		$this->form_validation->set_rules('time_used', 'Time Used', 'trim|required');


		if($this->form_validation->run() == False){

		$this->load->model('dailylogs_model');
		$data['log_data'] = $this->dailylogs_model->get_logs_info($log_id);

		$data['main_view'] = 'dailylogs/edit_dailylogs';
		$this->load->view('layouts/main', $data);

		} else {
				$time_used = $this->input->post('time_used');
				$check = strpos($time_used, 'mins');
				if ($check == true){
					$time_used;
				} else {
					$parts = explode(":", $time_used);
					$hours = intval($parts[0]);
					$minutes = intval($parts[1]);
					$time_used= $hours * 60 + $minutes;
					$time_used = $time_used." mins";				
				}


			
			

		 $data = array(
			'time_used' => $time_used,
			'task_desc' => $this->input->post('task_desc'),
			'entry_date' => $this->input->post('entry_date'),
			'pro_id' => $this->input->post('projects'),
			);


			 $this->load->model('dailylogs_model');
			

			if($this->dailylogs_model->edit_logs($log_id, $data)){	
			$this->session->set_flashdata('log_updated', 'log details has been updated');
			redirect("dailylogs/index"); 
			}  
		}
		
	}

}
