<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct()
	{
		parent::__construct();		
	}
	
	public function index(){
		$this->view_page('dashboard');		
	}
	
	public function test(){		
		$this->load->model('Login_model');
		$email = 'mrcoder.premium@gmail.com';
		$result = $this->Login_model->get_role_id($email);
		print_r($result);		
	}
	
	
	public function profile(){		
		$this->view_page('profile');
	}
	
	public function sessionData(){
		echo '<pre>';
		print_r($this->session->userdata('logged_user'));		
		echo '</pre>';
	}
	
	public function get_row_data(){
		$list_type = $this->input->get('param1');
		$tables = array (
            'member'     	=> 'app_members',
            'role'     		=> 'app_roles',
            'package'     	=> 'app_packages',
            'page'     		=> 'app_pages',
        );
		if($this->input->get('param2')){
			$data 			  = json_decode($this->input->get('param2'), TRUE);
			$response['data'] = $this->Common_model->get_row_data($tables[$list_type],$data);
		}else{
			$response['data'] = $this->Common_model->get_row_data($tables[$list_type]);
		}	    
        
		$response['status'] = 'success';		
		echo $this->jsonify($response);
    }

    public function table_list($list_type){
        
        return $tables[$list_type];
    }
	
	public function get_session(){		
		if($this->input->get('session_name')){
			$session_name = $this->input->get('session_name');
			$response['data'] = $this->session->userdata($session_name);
		}
		else{			
			$response['data'] 	 	  = $this->session->userdata('logged_user');
			$response['package_data'] = ($this->session->userdata('permitted_data')['package_features']!=null)?json_decode($this->session->userdata('permitted_data')['package_features'],1):null;
			$response['team_data'] 	  = ($this->session->userdata('permitted_data')['team_features']!=null)?json_decode($this->session->userdata('permitted_data')['team_features'],1):null;
		}	
		echo $this->jsonify($response);
		die;
	}
}
