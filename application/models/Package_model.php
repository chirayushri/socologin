<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Package_model extends CI_model 
{

	var $table_name 		= 'app_packages';
	var $table_roles		= 'app_roles';

	public function __construct()
	{
		parent::__construct();
	}
	
	public function package_list($get){
		if($get['list_count']==true)
		 {
			$this->db->where('is_deleted',0);	
			// $this->db->where('user_id',$this->user_id);	
			$query = $this->db->get($this->table_name);
			$data = $query->num_rows();
		 } else { 					
					$this->db->where('is_deleted',0);	
					// $this->db->where('user_id',$this->user_id);	
					if($get['date_filter_type']=='modified')
					{
						$date_filter_type = $this->table_name.'.modified_at';
					} else {
						$date_filter_type = $this->table_name.'.created_at';
					}
					if(!empty($get['fields']))
					{
						$this->db->select($get['fields']);
					}			
					if(!empty($get['search_key']))
					{
						$this->db->like('package_name',$get['search_key']);
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
	
	
	public function package_add($data){
		$this->db->insert($this->table_name, $data);
		$result = $this->db->insert_id();
		if($result)
			return $result ;
		else
			return false;
	}
	
	public function package_delete($data,$id)
	{	
		$this->db->where_in('package_id',$id);
		$this->db->update($this->table_name,$data);
		return true;
	}

	public function package_edit($data)
	{
		$this->db->where('package_id',$data['package_id']);
		$this->db->update($this->table_name,$data);		
		return true;
	}
		
}
