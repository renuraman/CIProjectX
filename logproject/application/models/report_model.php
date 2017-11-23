<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {
			
	public function getLogData($name,$proName,$entDate){
	
		if($name==-1)
		{
			$name="";
		}
		
		if($proName==-1)
		{
			$proName="";
		}
		
		if($entDate==-1)
		{
			$entDate="";
		}
		
		
		$stored_pocedure = "CALL spLogData(?,?,?)";
		$query = $this->db->query($stored_pocedure,array('project'=>$proName,'devname'=>$name,'date'=>$entDate));		
		return $query->result_array();
		
	}
		
				
}
