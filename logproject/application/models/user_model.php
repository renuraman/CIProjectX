<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function login_user($username){

		$this->db->where('username', $username);
		$query = $this->db->get('users');
		return $query->row();
		
	}


	public function create_user($username, $password, $email, $user_type){

		$query = $this->db->insert('users', array(
		'username' => $username,
			'password' => MD5($password),
			'email' => $email,
			'user_type' => $user_type
		)
		);
		return $query;

	}
	

	public function get_users(){
		$query = $this->db->query('select * from users where status != 1');
		return $query->result();		
	}
	
	public function getOnlyUsers(){
		$this->db->where(array(
		'user_type'=>0,
		'status'=>0
		)
		);	
		$query = $this->db->get('users');	
		return $query->result();		
	}
	
	
	public function delete_user($user_id){

		$query = $this->db->query('update users set status=1 where user_id='.$user_id);
		return $query;
	
		
	}
	
	
	public function get_user_info($user_id){
		$this->db->where('user_id', $user_id);
		$get_data = $this->db->get('users');
		return $get_data->row();
	}
	
	public function edit_user($user_id, $username, $password, $email, $user_type){
		
		$data = array(
			'username' => $username,
			'password' => MD5($password),
			'email' => $email,
				   'user_type' => $user_type
			);
		$this->db->where('user_id', $user_id);
		$this->db->update('users', $data);
		return true;
	
	}
	
	 	

	public function mdl_CheckUserExists($name)
	{	
		$stored_procedure = "CALL spUserNameExists(?)";
		$query = $this->db->query($stored_procedure,array('name'=>$name));		
		return $query->row();

	}
	
	
	public function mdl_CheckEmailExists($user_email){
		$stored_procedure = "CALL spUserEmailExists(?)";
		$query = $this->db->query($stored_procedure,array('email'=>$user_email));
		return $query->row();

	}

}
