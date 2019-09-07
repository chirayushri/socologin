<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_model 
{

	var $tbl_name 		= 'app_users';
	var $tbl_memebers 	= 'app_members';
	var $tbl_roles 		= 'app_roles';

	public function __construct()
	{
		parent::__construct();
	}
	
	public function check_social_user($data){
		$this->db->select('user_id');
		$this->db->from($this->tbl_name);
		$this->db->where('email',$data['email']);
		$num_row = $this->db->get()->num_rows();
		if($num_row == 0){
				// Case of User not found
				$this->db->insert($this->tbl_name, $data);
				$result = $this->db->insert_id();
				
			}else{
				$this->db->set(array('name'=>$data['name'],'picture'=>$data['picture'],'logged_type'=>$data['logged_type'],'modified_date'=>time()));		
				$this->db->where('email',$data['email']);
				$this->db->update($this->tbl_name);
			}
		return true;		
	}
	
	public function check_user($data){
		$this->db->select('user_id,status,password,status');
		$this->db->from($this->tbl_name);
		$this->db->where('email',$data['email']);
		$result = $this->db->get();
		$row = $result->row();		
		$num_row = $result->num_rows();
		if($num_row == 1){				
				if (password_verify($data['password'], $row->password)){
					if($row->status == 1){
						// Case of Success 
						return 1;
					}
					else{
						// Case of Inactive account
						return -1;
					}
				}
				else{
					// Case of Invalid Password
					return 0;
				}
			}
			else {
				// Case of User not found
				return -2;
			}	
	}

	public function register_user($data){
		$this->db->insert($this->tbl_name, $data);
		$result = $this->db->insert_id();
		if($result)
			return $result ;
		else
			return false;
	}
	
	public function forgot_user($data){
		$this->db->select('user_id');
		$this->db->from($this->tbl_name);
		$this->db->where('email', $data['email']);
		$num_row = $this->db->get()->num_rows();
		if($num_row == 1){
				// Case of User not found
				return 1;
			}
			else {
				// Case of User not found
				return 0;
			}	
	}

	public function get_role_id($email){
		$this->db->select('member_id,role_features');
		$this->db->from($this->tbl_memebers);
		$this->db->where('email',$email);
		$this->db->where($this->tbl_memebers.'.is_deleted',0);
		$this->db->where($this->tbl_roles.'.is_deleted',0);
		$this->db->join($this->tbl_roles,$this->tbl_memebers.'.role_id='.$this->tbl_roles.'.role_id','left');
					
		$result = $this->db->get();
		$row = $result->row();
		return $row->member_id;	
	}
	
	public function get_member_features($member_id){
		$this->db->select('member_id,role_features');
		$this->db->from($this->tbl_memebers);
		$this->db->where('member_id',$member_id);
		$this->db->where($this->tbl_memebers.'.is_deleted',0);
		$this->db->where($this->tbl_roles.'.is_deleted',0);
		$this->db->join($this->tbl_roles,$this->tbl_memebers.'.role_id='.$this->tbl_roles.'.role_id','left');
					
		$result = $this->db->get();
		$row = $result->row();
		return $row->role_features;	
	}
}
