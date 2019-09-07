<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model{
    
	public function get_row_data($table_name,$data=null){
        $this->table_name = $table_name;		
		if($data!=null){
			$this->table_data = $data;	
		} 				
		$this->output = array();		
        $this->set_conditions();	
		$query = $this->db->get($this->table_name);
		$data =  $query->row();		
		return $data;
    }
    
    private function set_conditions(){
		
		if($this->table_name=='app_members'){
			$this->db->where('user_id',$this->user_id);
			$this->db->where('member_id',$this->table_data['member_id']);
			$this->db->where('is_deleted',0);						 
		}
		
		elseif($this->table_name=='app_roles'){
			$this->db->where('user_id',$this->user_id);			
			$this->db->where('role_id',$this->table_data['role_id']);
			$this->db->where('is_deleted',0);			
		}
		elseif($this->table_name=='app_packages'){		
			$this->db->where('package_id',$this->table_data['package_id']);
			$this->db->where('is_deleted',0);			
		}
		elseif($this->table_name=='app_pages'){		
			$this->db->where('page_id',$this->table_data['page_id']);
			$this->db->where('is_deleted',0);			
		}else{
			$this->db->where('user_id',$this->user_id);
			$this->db->where('is_deleted',0);
		}
	}
	
	public function check_unique($get){
		$this->db->where('user_id',$get['user_id']);
		
		if($get['table_type']=='member'){
			$this->db->where('email',$get['str_name']);
			$tableCheck = 'app_members';			
		}else if($get['table_type']=='role'){
			$this->db->where('title',$get['str_name']);
			$tableCheck = 'app_roles';	
		}else if($get['table_type']=='package'){
			$this->db->where('title',$get['str_name']);
			$tableCheck = 'app_packages';	
		}else{
			$this->db->where('name',$get['str_name']);
			$tableCheck = 'app_members';	
		}
		
		$this->db->where('is_deleted',0);
		
		if(isset($get['member_id'])){
			$this->db->where_not_in('member_id', $get['member_id']);
		}
		if(isset($get['role_id'])){
			$this->db->where_not_in('role_id', $get['role_id']);
		}
		
		$query = $this->db->get($tableCheck);
		$data =  $query->num_rows();
		return $data;		
	}
	
}
