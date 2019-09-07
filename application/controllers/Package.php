<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Package_model');	
	}
	
	public function index(){
		check_access('view_package');
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
		$response['data'] = $this->Package_model->package_list($get);
		$get['count'] = true;
		$response['total_rows'] = $this->Package_model->package_list($get);
		$get['list_count'] = true;
		$response['total_lists'] = $this->Package_model->package_list($get);
		$response['status'] = 'success';
		echo $this->jsonify($response);
		die;
	}
	
	public function package_add(){
		if($_POST){
			check_access('add_package');
			$data['form_data'] = array(
									'title'		        => $this->input->post('title'),
									'price'		        => $this->input->post('price'),
									'description'		=> $this->input->post('description'),
									'features_data'		=> json_encode($this->input->post('features_data')),
									);
			
			$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean|callback_unique_check');
			$this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean');
			$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
					
			if ($this->form_validation->run()){	
					$form_data = array(
								'package_name'			=> $data['form_data']['title'],
								'package_price'			=> $data['form_data']['price'],
								'package_description'	=> $data['form_data']['description'],
								'package_data'			=> $data['form_data']['features_data'],
								'package_status'		=> 1,
								'is_deleted'			=> 0,
								'deleted_at'			=> 0,
								'modified_at'			=> 0,
								'created_at'			=> time(),
								);
					  $result = $this->Package_model->package_add($form_data);
					  $status = 'success';
					  $message = 'Package added successfully.';
			}else{
				$status 	= 'error';
				$message 	= strip_tags(validation_errors());
			}
			$data['alert_data']['status'] = $status;			
			$data['alert_data']['message'] = $message;	
			echo $this->jsonify($data);
			die;	
		}else{
			$this->view_page('packages');
		}		
	}

	public function package_edit(){
		if($_POST){
			check_access('edit_package');
			$data['form_data'] = array(
									'package_id'		=> $this->input->post('package_id'),
									'title'				=> $this->input->post('title'),
									'price'		        => $this->input->post('price'),
									'description'		=> $this->input->post('description'),
									'features_data'		=> json_encode($this->input->post('features_data')),
									);									
			
			$this->form_validation->set_rules('package_id', 'Role Id', 'trim|required');					
			$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean|callback_unique_check');
			$this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean');
			$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
					
			if ($this->form_validation->run()){	
					$form_data = array(
								'package_id'			=> $data['form_data']['package_id'],
								'package_name'			=> $data['form_data']['title'],
								'package_price'			=> $data['form_data']['price'],
								'package_description'	=> $data['form_data']['description'],
								'package_data'			=> $data['form_data']['features_data'],
								'modified_at'			=> time(),
								);
					  $result = $this->Package_model->package_edit($form_data);
					  $status = 'success';
					  $message = 'Package updated successfully.';
			}else{
				$status 	= 'error';
				$message 	= strip_tags(validation_errors());
			}
			$data['alert_data']['status'] = $status;			
			$data['alert_data']['message'] = $message;	
			echo $this->jsonify($data);
			die;	
		}else{
			$this->view_page('packages/edit-package');
		}		
	}
		
	public function package_delete(){
		if($_POST)
		{
			check_access('delete_package');
			$id = $this->input->post('id');
			if(is_array($id))
			 {
			   $data = array(
					'is_deleted'		 => 1	,	
					'deleted_at'	     =>	time(),
				);			
			   $list_name = $this->Package_model->package_delete($data,$id);			   
			   $status = 'success';
			   $message = 'Package deleted successfully.';
			 } else{
				$status = 'error';
				$message = 'Oops ! there is a issue to delete package.';
			 }
			 $response['status'] = $status;
			 $response['message'] = $message;
			 echo $this->jsonify($response);
			 die;
		}
	}
		
}
