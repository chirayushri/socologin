<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Member_model');	
	}
	
	public function index($page,$param1=NULL,$param2=NULL){
		$data = [];
		switch($page){			
			case 'member':
				check_access('view_member');
				$page_name = 'members/lists';
				break;
			case 'member_add':
				check_access('add_member');
				$page_name = 'members/add-member';
				break;
			case 'member_edit':
				check_access('edit_member');
				$data['param1'] = $param1;
				$page_name = 'members/edit-member';
				break;
			case 'role':
				check_access('view_role');
				$page_name = 'members/roles';
				break;
			case 'role_add':
				check_access('add_role');
				$page_name = 'members/add-role';
				break;
			case 'role_edit':
				check_access('edit_role');
				$data['param1'] = $param1;
				$page_name = 'members/edit-role';
				break;
			case 'packages':
				check_access('view_packages');
				$page_name = 'packages/lists';
				break;
			case 'package_add':
				check_access('add_package');
				$page_name = 'packages/add-package';
				break;
			case 'package_edit':
				check_access('edit_package');
				$data['param1'] = $param1;
				$page_name = 'packages/edit-package';
				break;
			case 'pages':
				check_access('view_page');
				$page_name = 'pages/lists';
				break;
			case 'page_add':
				check_access('add_page');
				$page_name = 'pages/add-page';
				break;
			case 'page_edit':
				check_access('edit_page');
				$data['param1'] = $param1;
				$page_name = 'pages/edit-page';
				break;
			default:
				$page_name = 'dashboard';
				break;
		}
		$this->view_page($page_name,$data);				
	}
		
	public function list(){
		$get['fields'] = '';
		$get['search_key'] = $this->input->get('search_key');
		$get['date_filter_type'] = $this->input->get('date_filter_type');
		$get['date_start'] = $this->input->get('date_start');
		$get['date_end'] = $this->input->get('date_end');
		$get['items_per_page'] = $this->input->get('items_per_page');
		$get['current_page'] = $this->input->get('current_page');
		$get['date_by'] = $this->input->get('date_by');
		$get['order_by'] = $this->input->get('order_by');
		$get['order_type'] = $this->input->get('order_type');
		$get['count'] = false;
		$get['list_count'] = false;
		$response['data'] = $this->Member_model->get($get);
		$get['count'] = true;
		$response['total_rows'] = $this->Member_model->get($get);
		$get['list_count'] = true;
		$response['total_lists'] = $this->Member_model->get($get);
		$response['status'] = 'success';
		echo $this->jsonify($response);
		die;
	}
	
	
	public function add(){
		if($_POST){
			check_access('add_member');
			$data['form_data'] = array(
									'name'		=> $this->input->post('name'),
									'email'		=> $this->input->post('email'),
									'password'	=> $this->input->post('password'),
									'role'	=> $this->input->post('role'),
									);
			
			$this->form_validation->set_rules('name', 'Name', 'trim|required');						
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_unique_check');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_valid_strong_password');
			$this->form_validation->set_rules('role', 'Role', 'trim|required');
					
			if ($this->form_validation->run()){	
					$form_data = array(
								'user_id'		=> $this->user_id,
								'name'			=> $data['form_data']['name'],
								'email'			=> $data['form_data']['email'],
								'password'		=> $data['form_data']['password'],
								'role_id'		=> $data['form_data']['role'],
								'status'		=> 1,
								'is_deleted'	=> 0,
								'deleted_at'	=> 0,
								'modified_at'	=> 0,
								'created_at'	=> time(),
								);
					  $result = $this->Member_model->add($form_data);
					  $status = 'success';
					  $message = 'Member added successfully.';
			}else{
				$status 	= 'error';
				$message 	= strip_tags(validation_errors());
			}
			$data['alert_data']['status'] = $status;			
			$data['alert_data']['message'] = $message;	
			echo $this->jsonify($data);
			die;	
		}else{
			$this->view_page('members/add-member');
		}		
	}	
	
	public function edit(){
		if($_POST){
			check_access('edit_member');
			$data['form_data'] = array(
									'name'		=> $this->input->post('name'),
									'email'		=> $this->input->post('email'),
									'role'		=> $this->input->post('role'),
									'member_id'	=> $this->input->post('member_id'),
									);
									
			$original_value = getSingleRow('app_members',array('member_id'=>$data['form_data']['member_id']))['email'];
			
			$this->form_validation->set_rules('member_id', 'Member Id', 'trim|required');						
			$this->form_validation->set_rules('name', 'Name', 'trim|required');						
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|callback_unique_check');
			$this->form_validation->set_rules('role', 'Role', 'trim|required');
					
			if ($this->form_validation->run()){	
					$form_data = array(
								'member_id'		=> $data['form_data']['member_id'],
								'name'			=> $data['form_data']['name'],
								'email'			=> $data['form_data']['email'],
								'role_id'		=> $data['form_data']['role'],
								'modified_at'	=> time(),
								);
					  $result = $this->Member_model->edit($form_data);
					  $status = 'success';
					  $message = 'Member updated successfully.';
			}else{
				$status 	= 'error';
				$message 	= strip_tags(validation_errors());
			}
			$data['alert_data']['status'] = $status;			
			$data['alert_data']['message'] = $message;	
			echo $this->jsonify($data);
			die;	
		}else{
			$this->view_page('members/edit-member');
		}		
	}
	
	public function delete(){
		if($_POST)
		{
			check_access('delete_member');
			$id = $this->input->post('id');
			if(is_array($id))
			 {
			   $data = array(
					'is_deleted'		 => 1	,	
					'deleted_at'	     =>	time(),
				);			
			   $list_name = $this->Member_model->delete($data,$id);			   
			   $status = 'success';
			   $message = 'Member deleted successfully.';
			 } else{
				$status = 'error';
				$message = 'Oops ! there is a issue to delete member.';
			 }
			 $response['status'] = $status;
			 $response['message'] = $message;
			 echo $this->jsonify($response);
			 die;
		}
	}
	
	public function status(){
		if($_POST){
			check_access('edit_member');	
			$id = $this->input->post('id');
			$status = $this->input->post('status');
			if($status==0){
				$status_msg = ' deactivated ';
			}else{								
				$status_msg = ' activated ';
			}
			if($id)
			 {
			   $this->Member_model->status($id,$status);					
			   $status = 'success';
			   $message = 'Member '.$status_msg.' successfully !';
			 } else{
				$status = 'error';
				$message ='Member '.$status_msg.' failed !';
			 }
			$data['alert_data']['status'] = $status;			
			$data['alert_data']['message'] = $message;	
			echo $this->jsonify($data);
			die;	
		}
	}	
	
	public function role_list(){
		check_access('view_role');
		$get['fields'] = '';
		$get['search_key'] = $this->input->get('search_key');
		$get['date_filter_type'] = $this->input->get('date_filter_type');
		$get['date_start'] = $this->input->get('date_start');
		$get['date_end'] = $this->input->get('date_end');
		$get['items_per_page'] = $this->input->get('items_per_page');
		$get['current_page'] = $this->input->get('current_page');
		$get['date_by'] = $this->input->get('date_by');
		$get['order_by'] = $this->input->get('order_by');
		$get['order_type'] = $this->input->get('order_type');
		$get['count'] = false;
		$get['list_count'] = false;
		$response['data'] = $this->Member_model->role_list($get);
		$get['count'] = true;
		$response['total_rows'] = $this->Member_model->role_list($get);
		$get['list_count'] = true;
		$response['total_lists'] = $this->Member_model->role_list($get);
		$response['status'] = 'success';
		echo $this->jsonify($response);
		die;
	}
	
	public function role_add(){
		if($_POST){
			check_access('add_role');
			$data['form_data'] = array(
									'title'		        => $this->input->post('title'),
									'features_data'		=> json_encode($this->input->post('features_data')),
									);
			
			$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean|callback_unique_check');
					
			if ($this->form_validation->run()){	
					$form_data = array(
								'user_id'		=> $this->user_id,
								'title'			=> $data['form_data']['title'],
								'role_features'	=> $data['form_data']['features_data'],
								'is_deleted'	=> 0,
								'deleted_at'	=> 0,
								'modified_at'	=> 0,
								'created_at'	=> time(),
								);
					  $result = $this->Member_model->role_add($form_data);
					  $status = 'success';
					  $message = 'Role added successfully.';
			}else{
				$status 	= 'error';
				$message 	= strip_tags(validation_errors());
			}
			$data['alert_data']['status'] = $status;			
			$data['alert_data']['message'] = $message;	
			echo $this->jsonify($data);
			die;	
		}else{
			$this->view_page('members/roles');
		}		
	}

	public function role_edit(){
		if($_POST){
			check_access('edit_role');
			$data['form_data'] = array(
									'role_id'	=> $this->input->post('role_id'),
									'title'	=> $this->input->post('title'),
									'features_data'	=> json_encode($this->input->post('features_data')),
									);									
			
			$this->form_validation->set_rules('role_id', 'Role Id', 'trim|required');					
			$this->form_validation->set_rules('title', 'Email', 'trim|required|xss_clean|callback_unique_check');
					
			if ($this->form_validation->run()){	
					$form_data = array(
								'role_id'		=> $data['form_data']['role_id'],
								'user_id'		=> $this->user_id,
								'title'			=> $data['form_data']['title'],
								'role_features'	=> $data['form_data']['features_data'],
								'modified_at'	=> time(),
								);
					  $result = $this->Member_model->role_edit($form_data);
					  $status = 'success';
					  $message = 'Role updated successfully.';
			}else{
				$status 	= 'error';
				$message 	= strip_tags(validation_errors());
			}
			$data['alert_data']['status'] = $status;			
			$data['alert_data']['message'] = $message;	
			echo $this->jsonify($data);
			die;	
		}else{
			$this->view_page('members/edit-role');
		}		
	}
		
	public function role_delete(){
		if($_POST)
		{
			check_access('delete_role');
			$id = $this->input->post('id');
			if(is_array($id))
			 {
			   $data = array(
					'is_deleted'		 => 1	,	
					'deleted_at'	     =>	time(),
				);			
			   $list_name = $this->Member_model->role_delete($data,$id);			   
			   $status = 'success';
			   $message = 'Role deleted successfully.';
			 } else{
				$status = 'error';
				$message = 'Oops ! there is a issue to delete role.';
			 }
			 $response['status'] = $status;
			 $response['message'] = $message;
			 echo $this->jsonify($response);
			 die;
		}
	}
		
}
