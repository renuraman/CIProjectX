<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reminder_model extends CI_Model{

	public function find_email(){	
	$prev_date="";
	$emailarr=array();

	$current   = date("m/d/y"); 	
	$day = date('l', strtotime($current)); 

	if($day == "Monday"){
		$prev_date = date('m/d/Y', strtotime($current .' -2 day'));
	} else {
		$prev_date = date('m/d/Y', strtotime($current .' -1 day'));
	}	

	$this->db->select('*');
	$query = $this->db->get('users');
	$count = $query->num_rows();

	$this->db->select('*');
	$this->db->from('users');
	$this->db->where(array(
	'user_type'=>0,
	'status'=>0
	));
	$users = $this->db->get();


	$arruser_id=array();

	foreach($users->result() as $row){		
		$arruser_id[] = $row->user_id;		
	}


	$x="";
	foreach($arruser_id as $user){

		$this->db->select('count(*) as cnt');
		$this->db->from('logtbl');
		$this->db->where(array(
		'user_id'=>$user,
		'entry_date'=>$prev_date
		));
		$query = $this->db->get();
		$cnt=$query->row()->cnt;
		//$x.=$user. "".$cnt."$prev_date<br>";

		if($cnt == 0){		
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('user_id', $user);
			$users = $this->db->get();	
			$email = $users->row()->email; 
			//$x.=$email."<br>";

			array_push($emailarr, $email);

		}

	}
	return $emailarr;
		

	}
}
	
