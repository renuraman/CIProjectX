<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model {

	public function get_projects(){

		$query = $this->db->get('project');
		return $query->result();

		
	}
	
	public function insert_logs($entry_date, $task_desc, $projects, $user_id, $time_used){
		
		$query =  $this->db->insert("logtbl",array(
		'entry_date' =>$entry_date,
		'task_desc'=>$task_desc,
		'pro_id'=>$projects,
		'user_id'=>$user_id,
		'time_used'=>$time_used
		));	
		return $query;
				
	}
	
	
	public function edit_project($project_id, $data){
		$this->db->where('pro_id', $project_id);
		$this->db->update('project',$data);
		return true;
	}
	
	public function get_projects_info($project_id){
		$this->db->where('pro_id', $project_id);
		$get_data = $this->db->get('project');
		return $get_data->row();

	}	
	
	public function add_project($data){
		
		$query =  $this->db->insert("project",$data);	
		return $query;
	}
	
	public function del_project($project_id){

		$this->db->where('pro_id', $project_id);		
		$query =  $this->db->delete("project");
		return $query;
	}
	
}
