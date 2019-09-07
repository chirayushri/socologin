<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Member_model extends CI_model 
{

	var $table_users 		= 'app_users';
	var $table_name 		= 'app_members';
	var $table_roles		= 'app_roles';

	public function __construct()
	{
		parent::__construct();
	}
	
	public function get($get){
		if($get['list_count']==true)
		 {
			$this->db->where('is_deleted',0);	
			$this->db->where('user_id',$this->user_id);	
			$query = $this->db->get($this->table_name);
			$data = $query->num_rows();
		 } else { 					
					$this->db->where($this->table_name.'.is_deleted',0);	
					$this->db->where($this->table_name.'.user_id',$this->user_id);	
					if($get['date_filter_type']=='modified')
					{
						$date_filter_type = $this->table_name.'.modified_at';
					} else {
						$date_filter_type = $this->table_name.'.created_at';
					}
					
					$this->db->select($this->table_name.'.member_id,'.$this->table_name.'.name,'.$this->table_name.'.status,'.$this->table_name.'.email,'.$this->table_name.'.role_id,'.$this->table_name.'.created_at,');
					$this->db->select($this->table_roles.'.title as role_title');
					
					if(!empty($get['search_key']))
					{
						$this->db->like($this->table_name.'.name',$get['search_key']);
					}
					if(!empty($get['date_start']))
					{
						$this->db->where($date_filter_type.' >=',$get['date_start']);
					}
					if(!empty($get['date_end']))
					{
						$this->db->where($date_filter_type.' <=',$get['date_end']);
					}
					if(!empty($get['order_by']) && !empty($get['order_type']))
					{
						$this->db->order_by($this->table_name.'.'.$get['order_by'],$get['order_type']);					
					}
					
					$this->db->join($this->table_roles,$this->table_name.'.role_id='.$this->table_roles.'.role_id','left');
					
					if($get['count']==true)
					{
						$query = $this->db->get($this->table_name);
						$data = $query->num_rows();
					} else {
						$query = $this->db->get($this->table_name,$get['items_per_page'],$get['items_per_page'] * ($get['current_page']) );
						$data =  $query->result();					
					}
		 }

		return $data;

	}
	
	
	public function delete($data,$id)
	{	
		$this->db->where_in('member_id',$id);
		$this->db->update($this->table_name,$data);
		return true;
	}
	
	public function add($data){
		$this->db->insert($this->table_name, $data);
		$member_id = $this->db->insert_id();
		if($member_id){
			$member_data = array(
								'parent_id'		=> $this->user_id,								
								'package_id'	=> $this->session->userdata('logged_user')['package_id'],
								'name'			=> $data['name'],
								'email'			=> $data['email'],
								'password'		=> password_hash($data['password'],PASSWORD_DEFAULT),
								'status'		=> 1,
								'is_deleted'	=> 0,
								'modified_date'	=> 0,
								'created_date'	=> time(),
								);
			$this->db->insert($this->table_users, $member_data);
			$member_id = $this->db->insert_id();
			return true ;		
		}else{
			return false;
		}
			
	}
	
	public function edit($data)
	{
		$this->db->where('member_id',$data['member_id']);
		$this->db->update($this->table_name,$data);		
		return true;
	}
	
	public function status($id,$status){
		$this->db->set('status',$status);		
		$this->db->where('member_id', $id);
		$this->db->update($this->table_name);
		return true;
	}

	public function role_list($get){
		if($get['list_count']==true)
		 {
			$this->db->where('is_deleted',0);	
			$this->db->where('user_id',$this->user_id);	
			$query = $this->db->get($this->table_roles);
			$data = $query->num_rows();
		 } else { 					
					$this->db->where('is_deleted',0);	
					$this->db->where('user_id',$this->user_id);	
					if($get['date_filter_type']=='modified')
					{
						$date_filter_type = $this->table_roles.'.modified_at';
					} else {
						$date_filter_type = $this->table_roles.'.created_at';
					}
					if(!empty($get['fields']))
					{
						$this->db->select($get['fields']);
					}			
					if(!empty($get['search_key']))
					{
						$this->db->like('title',$get['search_key']);
					}
					if(!empty($get['date_start']))
					{
						$this->db->where($date_filter_type.' >=',$get['date_start']);
					}
					if(!empty($get['date_end']))
					{
						$this->db->where($date_filter_type.' <=',$get['date_end']);
					}
					if(!empty($get['order_by']) && !empty($get['order_type']))
					{
						$this->db->order_by($this->table_roles.'.'.$get['order_by'],$get['order_type']);					
					}
					if($get['count']==true)
					{
						$query = $this->db->get($this->table_roles);
						$data = $query->num_rows();
					} else {
						$query = $this->db->get($this->table_roles,$get['items_per_page'],$get['items_per_page'] * ($get['current_page']) );
						$data =  $query->result();
					}
		 }

		return $data;

	}
	
	
	public function role_add($data){
		$this->db->insert($this->table_roles, $data);
		$result = $this->db->insert_id();
		if($result)
			return $result ;
		else
			return false;
	}
	
	public function role_delete($data,$id)
	{	
		$this->db->where_in('role_id',$id);
		$this->db->update($this->table_roles,$data);
		return true;
	}

	public function role_edit($data)
	{
		$this->db->where('role_id',$data['role_id']);
		$this->db->update($this->table_roles,$data);		
		return true;
	}
		
}
