<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dailylogs_model extends CI_Model {

		
	public function get_dailylogs($limit, $start, $id){
		
		$this->db->select('task_desc, proname, time_used, entry_date, log_id');
		$this->db->from('logtbl');
		$this->db->join('project', 'logtbl.pro_id = project.pro_id');
		$this->db->where('user_id', $id);
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query->result();		
	} 
	
	
	public function record_count($id) {
		$this->db->select('*');
		$this->db->from('logtbl');
		$this->db->join('project', 'logtbl.pro_id = project.pro_id');
		$this->db->where('user_id', $id);
		$query = $this->db->get();
		return $query->num_rows();
    }
	
	public function add_dailylogs($entry_date, $task_desc, $projects, $id, $time_used){
		
		$twelvehrs  = date("g:i a", strtotime($time_used));
		//$time_in_24_hour_format  = date("H:i", strtotime("1:30 PM"));


		$parts = explode(":", $twelvehrs);
		$hours = intval($parts[0]);
		$minutes = intval($parts[1]);
		$time_used= $hours * 60 + $minutes;
		
		$query =  $this->db->insert("logtbl",array(
		'entry_date' =>$entry_date,
		'task_desc'=>$task_desc,
		'pro_id'=>$projects,
		'user_id'=>$id,
		'time_used'=>$time_used." mins"
		));	
		return $query;				
	}
	
	

	
	public function get_logs_info($log_id){
		$this->db->where('log_id', $log_id);
		$get_data = $this->db->get('logtbl');
		return $get_data->row();

	}
	
	
	
	
	public function edit_logs($log_id, $data){
		$this->db->where('log_id', $log_id);
		$this->db->update('logtbl',$data);
		return true;
	}
	
	
	public function del_log($log_id){
		$this->db->where('log_id', $log_id);		
		$query =  $this->db->delete("logtbl");	
		return $query;
	}


}
