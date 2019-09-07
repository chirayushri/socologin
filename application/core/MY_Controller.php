<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->db->query("SET sql_mode='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION'");	
		$this->not_login();		
		$this->user_id = $this->session->userdata('logged_user')['id'];		
		$this->load->model('Common_model');		
		$this->load->helper('security');
		$this->load->helper('app_db');			
		$this->load->helper('app_features');			
	}
	
	public function jsonify($array){
		header('Content-Type: application/json');
		return json_encode($array);
	}
	
	public function not_login(){
		if($this->session->userdata('logged_user')['id']==''){
			redirect('login');
		}
	}
	
	public function view_page($page,$data=NULL){
		$this->load->view('header');
		$this->load->view($page,$data);
		$this->load->view('footer');
	}
	
	public function valid_strong_password($password = '')
    {
        $password = trim($password);
        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';
        if (empty($password))
        {
            $this->form_validation->set_message('valid_strong_password', 'The {field} field is required.');
            return FALSE;
        }
        if (preg_match_all($regex_lowercase, $password) < 1)
        {
            $this->form_validation->set_message('valid_strong_password', 'The {field} field must be at least one lowercase letter.');
            return FALSE;
        }
        if (preg_match_all($regex_uppercase, $password) < 1)
        {
            $this->form_validation->set_message('valid_strong_password', 'The {field} field must be at least one uppercase letter.');
            return FALSE;
        }
        if (preg_match_all($regex_number, $password) < 1)
        {
            $this->form_validation->set_message('valid_strong_password', 'The {field} field must have at least one number.');
            return FALSE;
        }
        if (preg_match_all($regex_special, $password) < 1)
        {
            $this->form_validation->set_message('valid_strong_password', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));
            return FALSE;
        }
        if (strlen($password) < 5)
        {
            $this->form_validation->set_message('valid_strong_password', 'The {field} field must be at least 5 characters in length.');
            return FALSE;
        }
        if (strlen($password) > 32)
        {
            $this->form_validation->set_message('valid_strong_password', 'The {field} field cannot exceed 32 characters in length.');
            return FALSE;
        }
        return TRUE;
    }
  
	public function unique_check($str){
			$req['str_name'] = $str;
			$req['user_id'] = $this->user_id;
			
			
			if($this->input->post('name')){
				$req['table_type'] = 'member';			
			}else if($this->input->post('title')){
				$req['table_type'] = 'role';				
			}else{
				$req['table_type'] = 'member';
			}
			
			
			if($this->input->post('member_id')){
				$req['member_id'] = $this->input->post('member_id');			
			}
			
			if($this->input->post('role_id')){
				$req['role_id'] = $this->input->post('role_id');			
			}
			
			
			$response = $this->Common_model->check_unique($req);
		    if ($response>0){
					$this->form_validation->set_message('unique_check', ucfirst($req['table_type']).' already added in your account.');
					return FALSE;
			}
			else
			{
					return TRUE;
			}
		}

	// Function Created By Chirayu Shrivastav For Security Reasons
	public function zingoCrypt ($string, $action = 'e' ) {
    // you may change these values to your own
    $secret_key  = 	'MZ_123456_CS';
    $secret_iv	 = 	'MZ_123456_IV';
 
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
 
    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
	}
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
 
    return $output;
	}
}
