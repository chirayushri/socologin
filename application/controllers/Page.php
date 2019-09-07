<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Page_model');	
	}
	
	public function index(){
		check_access('view_page');
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
		$response['data'] = $this->Page_model->page_list($get);
		$get['count'] = true;
		$response['total_rows'] = $this->Page_model->page_list($get);
		$get['list_count'] = true;
		$response['total_lists'] = $this->Page_model->page_list($get);
		$response['status'] = 'success';
		echo $this->jsonify($response);
		die;
	}
	
	public function page_add(){
		if($_POST){
			check_access('add_page');
			// echoArr($this->input->post);
			$data['form_data'] = array(
									'title'		        => $this->input->post('title'),
									'description'		=> $this->input->post('description'),
									'page_data'		=> json_encode($this->input->post('page_data')),
									);
			
			$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean|callback_unique_check');
			$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
					
			if ($this->form_validation->run()){	
					$form_data = array(
								'page_name'				=> $data['form_data']['title'],
								'user_id'				=> $this->user_id,
								'page_description'		=> $data['form_data']['description'],
								'page_data'				=> $data['form_data']['page_data'],
								'page_status'			=> 1,
								'is_deleted'			=> 0,
								'deleted_at'			=> 0,
								'modified_at'			=> 0,
								'created_at'			=> time(),
								);
					  $result = $this->Page_model->page_add($form_data);
					  $status = 'success';
					  $message = 'Page added successfully.';
			}else{
				$status 	= 'error';
				$message 	= strip_tags(validation_errors());
			}
			$data['alert_data']['status'] = $status;			
			$data['alert_data']['message'] = $message;	
			echo $this->jsonify($data);
			die;	
		}else{
			$this->view_page('pages');
		}		
	}

	public function page_edit(){
		if($_POST){
			check_access('edit_page');
			$data['form_data'] = array(
									'page_id'			=> $this->input->post('page_id'),
									'title'				=> $this->input->post('title'),
									'description'		=> $this->input->post('description'),
									'page_data'			=> json_encode($this->input->post('page_data')),
									);									
			
			$this->form_validation->set_rules('page_id', 'Page Id', 'trim|required');					
			$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean|callback_unique_check');
			$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
					
			if ($this->form_validation->run()){	
					$form_data = array(
								'user_id'			=> $this->user_id,
								'page_id'			=> $data['form_data']['page_id'],
								'page_name'			=> $data['form_data']['title'],
								'page_description'	=> $data['form_data']['description'],
								'page_data'			=> $data['form_data']['page_data'],
								'modified_at'		=> time(),
								);
					  $result = $this->Page_model->page_edit($form_data);
					  $status = 'success';
					  $message = 'Page updated successfully.';
			}else{
				$status 	= 'error';
				$message 	= strip_tags(validation_errors());
			}
			$data['alert_data']['status'] = $status;			
			$data['alert_data']['message'] = $message;	
			echo $this->jsonify($data);
			die;	
		}else{
			$this->view_page('packages/edit-page');
		}		
	}
		
	public function page_delete(){
		if($_POST)
		{
			check_access('delete_page');
			$id = $this->input->post('id');
			if(is_array($id))
			 {
			   $data = array(
					'is_deleted'		 => 1	,	
					'deleted_at'	     =>	time(),
				);			
			   $list_name = $this->Page_model->page_delete($data,$id);			   
			   $status = 'success';
			   $message = 'Page deleted successfully.';
			 } else{
				$status = 'error';
				$message = 'Oops ! there is a issue to delete page.';
			 }
			 $response['status'] = $status;
			 $response['message'] = $message;
			 echo $this->jsonify($response);
			 die;
		}
	}
		
}
