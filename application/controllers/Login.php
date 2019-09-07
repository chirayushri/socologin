<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();				
		$this->load->config('soc_config');
		$this->load->model('Login_model');
		$this->load->helper('app_db');
	}
	
	public function index()
	{
		$this->is_login();
		if($_POST){
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$data['form_data'] = array(
									'email'		=> $this->input->post('email'),
									'password'	=> $this->input->post('password'),
									);
		
			if ($this->form_validation->run()){
				  $result = $this->Login_model->check_user($data['form_data']);
				  if($result == 0){
						$status 	= 'error';
						$message = "Invalid Login Details !";
					}
				  elseif ($result == - 1){
						$status 	= 'error';
						$message = "Please verify your account to login!";
					}
				  elseif ($result == - 2){
						$status 	= 'error';
						$message = "Your account is not registered, Please signup your account !";
					}
				  else{
					    $result = getSingleRow('app_users',array('email'=>$this->input->post('email')));
						$this->login_user($result);				
						redirect('dashboard');
				   }
				}
			  else
				{
					$status 	= 'error';
					$message 	= strip_tags(validation_errors());
				}	
				$data['alert_data']['status'] = $status;			
				$data['alert_data']['message'] = $message;			
				$this->load->view('login',$data);
		}else{
			$data['form_data'] = array(
									'email'		=> '',
									'password'	=> '',
									);	
			$this->load->view('login',$data);
		}
	}
	
	public function signup()
	{
		$this->is_login();
		if($_POST){
			$data['form_data'] = array(
									'name'		=> $this->input->post('name'),
									'email'		=> $this->input->post('email'),
									'password'	=> $this->input->post('password'),
									);
			
			$this->form_validation->set_rules('name', 'Name', 'trim|required');						
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[app_users.email]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
					
			if ($this->form_validation->run()){				
				$email = $data['form_data']['email'];
				$created_date = time();
				$encCode  = base64_encode($email).'_____'.md5($created_date);	
				$user_data = array(
								'name'			=> $data['form_data']['name'],
								'email'			=> $email,
								'password'		=> password_hash($data['form_data']['password'],PASSWORD_DEFAULT),
								'status'		=> 0,
								'logged_type'	=> 'app',
								'forgot_code'	=> $encCode,
								'created_date'	=> $created_date,
								);
						
					  $email_message = $this->forgotCode($user_data,0);
					  $result = $this->Login_model->register_user($user_data);
					   if($result){
						$data['to'] 		= $data['form_data']['email'];
						$data['subject'] 	= 'App Demo - Congrats, your account is register successfully.';
						$data['message'] 	= $email_message;
						$this->sendMail($data);
					  } 
					  $data['form_data'] = array(
									'name'		=>'',
									'email'		=> '',
									'password'	=> '',
									);
					  $status 	= 'success';
					  $message 	= 'Register successfully !';
				}
			  else
				{
					$status 	= 'error';
					$message 	= strip_tags(validation_errors());
				}	
				$data['alert_data']['status'] = $status;			
				$data['alert_data']['message'] = $message;			
				$this->load->view('signup',$data);
		}else{	
			$data['form_data'] = array(
									'name'		=>'',
									'email'		=> '',
									'password'	=> '',
									);
			$this->load->view('signup',$data);
		}
	}
	
	public function google_login(){
		$this->is_login();
		require_once APPPATH.'third_party/google_sdk/Google_Client.php';
		require_once APPPATH.'third_party/google_sdk/contrib/Google_Oauth2Service.php';
		//Call Google API
		$gClient = new Google_Client();
		$gClient->setApplicationName('App Login');
		$gClient->setClientId($this->config->item('google_client_id'));
		$gClient->setClientSecret($this->config->item('google_client_secret'));
		$gClient->setRedirectUri($this->config->item('google_redirect_url'));
		$google_oauthV2 = new Google_Oauth2Service($gClient);
		
		if(isset($_GET['code']))
		{
			$gClient->authenticate($_GET['code']);
			$_SESSION['token'] = $gClient->getAccessToken();
			header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
		}

		if (isset($_SESSION['token'])) 
		{
			$gClient->setAccessToken($_SESSION['token']);
		}
		
		if ($gClient->getAccessToken()) {
            $user_data			 = $google_oauthV2->userinfo->get();
			$signup_data = array(
								'name'			=> $user_data['name'],
								'email'			=> $user_data['email'],
								'password'		=> password_hash($user_data['id'],PASSWORD_DEFAULT),
								'status'		=> 1,
								'picture'		=> $user_data['picture'],
								'logged_type'	=> 'google',
								'forgot_code'	=> '',
								'created_date'	=> time(),
								);			
			$this->Login_model->check_social_user($signup_data);			
			$result = getSingleRow('app_users',array('email'=>$user_data['email']));
			$this->login_user($result);				
			redirect('dashboard');			
        } 
		else 
		{
            $url = $gClient->createAuthUrl();
		    header("Location: $url");
            exit;
        }
	}	

	public function facebook_login(){
		$this->is_login();
		$this->load->library('facebook');
		$userData = array();
		if($this->facebook->is_authenticated()){	
			$user_data = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');
			$signup_data = array(
								'name'			=> $user_data['first_name'].' '.$user_data['last_name'],
								'email'			=> $user_data['email'],
								'password'		=> password_hash($user_data['id'],PASSWORD_DEFAULT),
								'status'		=> 1,
								'picture'		=> $user_data['picture']['data']['url'],
								'logged_type'	=> 'facebook',
								'forgot_code'	=> '',
								'created_date'	=> time(),
								);			
			$this->Login_model->check_social_user($signup_data);			
			$result = getSingleRow('app_users',array('email'=>$user_data['email']));
			$this->login_user($result);				
			redirect('dashboard');
		}
		else
		{
            $data['authUrl'] =  $this->facebook->login_url();
			redirect($data['authUrl']);
        }
	    
    }
	
	public function twitter_login() {	
		$this->is_login();
		include_once APPPATH."libraries/Twitter/twitteroauth.php";
		$this->load->library('twitter');
		$consumerKey = $this->config->item('consumerKey');
		$consumerSecret = $this->config->item('consumerSecret');
		$oauthCallback =  $this->config->item('oauthCallback');
		$sessToken = $_REQUEST['oauth_token'];
		$sessTokenSecret = $consumerSecret;

		if(isset($_REQUEST['oauth_token'])){
		//Successful response returns oauth_token, 
			//oauth_token_secret, user_id, and screen_name
		$connection = new TwitterOAuth($consumerKey, 
							  $consumerSecret, $sessToken, $sessTokenSecret); 
		$accessToken = $connection->getAccessToken($_REQUEST['oauth_verifier']);
		$params = array(
						'include_email' => 'true', 
						'include_entities' => 'false', 
						'skip_status' => 'true'
						);
		$user_data = $connection->get('account/verify_credentials', $params);
		$data['user_data'] = array(
									'logged_type' => 'twitter',
									'id' => $user_data->id,
									'name' => $user_data->name,
									'email' => $user_data->email,
									'locale' => 'en',
									'picture' => str_replace('_normal','',$user_data->profile_image_url),
								); 
		$this->session->set_userdata('logged_user',$data['user_data']);					
		$this->load->view('dashboard',$data);

		}else{
			$data['authUrl'] =  $this->facebook->login_url();
			redirect($data['authUrl']);
		}
		}


	public function logout(){
			if ($this->session->userdata('logged_user'))
				{
				if($this->session->userdata('logged_user')['logged_type']=='google'){
					require_once APPPATH.'third_party/google_sdk/Google_Client.php';
					require_once APPPATH.'third_party/google_sdk/contrib/Google_Oauth2Service.php';
					//Call Google API
					$gClient = new Google_Client();
					unset($_SESSION["auto"]);
					unset($_SESSION['token']);
					$gClient->revokeToken();
				}elseif($this->session->userdata('logged_user')['logged_type']=='facebook'){
					$token  = $this->session->userdata('fb_access_token');
					$url 	= 'https://www.facebook.com/logout.php?next=' . base_url() .
					  '&access_token='.$token;
					// redirect($url);  
				}	
				$arr = array(
					'logged_user',
					'permitted_data',
				);
				$this->session->unset_userdata($arr);
				redirect('login');
				}
			  else
				{
				redirect('login');
				}
		}
	
	public function forgotCode($data,$type=0){			
		$forgot_code = $data['forgot_code'];
		if($type==1){
			$url_type = 'forgot-verify';
		}else{
			$url_type = 'email-verify';
		};
		$content  = '<body><h1>Email Verification</h1>
		<p>Dear '.$data['name'].',</p><p>Thanks for register your account with us. please <strong><a href="'.base_url($url_type.'/'.$forgot_code).'">Click here</a></strong> to verify your account.<br></p><p>Thanks<br><b>Regards Team</b></p></body>';
		return $content;
	}
	
	public function forgotVerify($code){
		$ex_code = explode('_____',$code);		
		$decEmail = base64_decode($ex_code[0]);
		$userData = getSingleRow('app_users',array('email'=>$decEmail));
		if($userData){
			if($userData['forgot_code']==$code){
				setSingleRow('app_users',array('email'=>$decEmail),array('status'=>1));
				$status = 'success';			
				$message = 'User verified successfully';
				redirect('reset-password/'.$code);
			}else{
				$status = 'error';			
				$message = 'Verfication link is Expired';
			}			
		}else{
			$status = 'error';			
			$message = 'User verification failed';			
			$this->load->view('forgot',$data);
		}
		$data['form_data'] = array(
									'email'		=> '',
									'password'	=> '',
									);
		$data['alert_data']['status'] = $status;			
		$data['alert_data']['message'] = $message;			
		$this->load->view('login',$data);		
	}
	
	public function forgotPassword(){
		$this->is_login();
		if($_POST){
			$data['form_data'] = array(
									'email'	=> $this->input->post('email'),
									);								
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
					
			if ($this->form_validation->run()){
				$email = $data['form_data']['email'];
				$created_date = time();
				$encCode  = base64_encode($email).'_____'.md5($created_date);	
				$user_data = array(
								'name'			=> $email,
								'email'			=> $email,
								'status'		=> 0,
								'forgot_code'	=> $encCode,
								);						
				$email_message = $this->forgotCode($user_data,1);
				$result = $this->Login_model->forgot_user($user_data);
			    if($result == 0){
					$status 	= 'error';
					$message = " Email is not associated with any account !";
				}else{	
					setSingleRow('app_users',array('email'=>$email),array('status'=>0,'forgot_code'	=> $encCode));
					$data['to'] 		= $data['form_data']['email'];
					$data['subject'] 	= 'App Demo - Forgot Password ! ';
					$data['message'] 	= $email_message;
					$this->sendMail($data);
					$status 	= 'success';
					$message 	= 'Please check email to reset your password !';
				}
				}
			  else
				{
					$status 	= 'error';
					$message 	= strip_tags(validation_errors());
				}	
				$data['alert_data']['status'] = $status;			
				$data['alert_data']['message'] = $message;			
				$this->load->view('forgot',$data);
		}else{	
			$data['form_data'] = array(
									'email'		=> '',
									);
			$this->load->view('forgot',$data);
		}
	}
	
	public function resetPassword($code){
		$this->is_login();
		$decEmail = $this->is_expired($code);
		if($_POST){			
			$data['form_data']['password'] = $this->input->post('password');
			$data['form_data']['rpassword'] = $this->input->post('rpassword');
			$data['form_data']['decEmail'] = base64_decode($this->input->post('decCode'));
			$this->form_validation->set_rules('password', 'New Password', 'trim|required');
			$this->form_validation->set_rules('rpassword', 'Again Password', 'trim|required|matches[password]');
			$this->form_validation->set_rules('decCode', 'Reset Code', 'trim|required');
					
			if ($this->form_validation->run()){
				  $encPass  = password_hash($data['form_data']['password'],PASSWORD_DEFAULT);					
				  setSingleRow('app_users',array('email'=>$data['form_data']['decEmail']),array('password'=> $encPass));
				  $status 	= 'success';
				  $message 	= 'Password resets successfully !';
				  redirect('login');
				}
			  else
				{
					$status 	= 'error';
					$message 	= strip_tags(validation_errors());
				}	
				$data['alert_data']['status'] = $status;			
				$data['alert_data']['message'] = $message;			
				$this->load->view('reset',$data);
		}else{	
			$data['form_data'] = array(
									'password'	=> '',
									'rpassword'=> '',
									'decEmail'=> $decEmail,
									);
			$this->load->view('reset',$data);
		}
	}

	public function emailVerify($code){
		$ex_code = explode('_____',$code);		
		$decEmail = base64_decode($ex_code[0]);
		$userData = getSingleRow('app_users',array('email'=>$decEmail));
		if($userData){
			if($userData['forgot_code']==$code){
				setSingleRow('app_users',array('email'=>$decEmail),array('status'=>1));
				$status = 'success';			
				$message = 'User verified successfully';
				redirect('login');
			}else{
				$status = 'error';			
				$message = 'Verfication link is Expired';
			}			
		}else{
			$status = 'error';			
			$message = 'User verification failed';			
			$this->load->view('forgot',$data);
		}
		$data['form_data'] = array(
									'email'		=> '',
									'password'	=> '',
									);
		$data['alert_data']['status'] = $status;			
		$data['alert_data']['message'] = $message;			
		$this->load->view('login',$data);		
	}
	
	
	public function encryptCI($code){
		$this->load->library('encryption');
		$this->encryption->initialize(array('driver' => 'mcrypt',
						'cipher' => 'aes-256',
						'mode' => 'ctr',));
		return $this->encryption->encrypt($code);						
	}
	
	public function sessionData(){
		echo '<pre>';
		print_r($this->session->userdata());		
		echo '</pre>';
	}
	
	public function is_login(){
		if($this->session->userdata('logged_user')['id']!=''){
			redirect('dashboard');
		}
	}
	
	private function is_expired($code){
		if (strpos($code, '_____') == false) {
			redirect('access-denied');
		}else{
			$ex_code = explode('_____',$code);		
			$decEmail = base64_decode($ex_code[0]);
			if(filter_var($decEmail, FILTER_VALIDATE_EMAIL) !== false){
				$userData = getSingleRow('app_users',array('email'=>$decEmail));
				if(!$userData){
					redirect('access-denied');
				}else{
					return $ex_code[0];
				}
			}else{
				redirect('access-denied');
			}
		}
		
	}
	
	public function access_denied(){
		$this->load->view('access-denied');
	}

	public function test_method(){
		$user_data = array(
								'name'=>'1212'
								);				
		$this->db->insert('app_users', $user_data);
		echo $this->db->last_query();
		die;
	}
	
	public function sendMail($data) {
        $this->load->config('email_config');
        $this->load->library('email');
		$from = array('email' => 'chirayu.code@gmail.com', 'name' => 'APP DEMO','user' => $this->config->item('smtp_user'));
        $reply_to = $from;
		// $data['to'] = 'chirayushri@gmail.com';
        // $data['subject'] = 'Demo mail';
        // $data['message'] = 'Hi Demo Email';

        $this->email->set_newline("\r\n");
        $this->email->from($from['email'], $from['name'], $from['user']);
		$this->email->reply_to($reply_to['email'],$reply_to['name']);
        $this->email->to($data['to']);
        $this->email->subject($data['subject']);
        $this->email->message($data['message']);
		$this->email->set_mailtype("html");		
		
        if ($this->email->send()) {
            return true;
        } else {
            show_error($this->email->print_debugger());
        }
    }
	
	private function login_user($result){
		$data['user_data'] = array(
												'id' 		=> $result['user_id'],
												'parent_id' => $result['parent_id'],
												'email' 	=> $result['email'],
												'name'  	=> $result['name'],
												'logged_type' => $result['logged_type'],
												'locale' 	 => 'en',
												'picture'	 =>$result['picture'],						
												'package_id' =>$result['package_id'],						
											);
		$this->session->set_userdata('logged_user',$data['user_data']);
		if($result['is_expired']==1){
			/* User Plan is Expired */
			$data['permit_data']['is_expired'] = 1;			
		}else{
			/* User Plan is Active */
			if($result['parent_id']==0){
				/* User is Admin */
				$data['permit_data']['team_profile'] = 0;
			}else{
				/* User is Team member */
				$data['permit_data']['team_profile'] = $this->Login_model->get_role_id($result['email']);
			}
			$data['permit_data']['is_expired'] = 0;
			$data['permit_data']['package_id'] = $result['package_id'];
			$data['permit_data']['user_id']    = $data['permit_data']['team_profile'];			
			$this->set_permitted_data($data['permit_data']);
		}
		return true;		
	}
	
	private function set_permitted_data($permit_data){
		$result['package_features'] = $this->get_package_array($permit_data['package_id']);
		if($permit_data['user_id']==0){
			/* User is Admin */
			$result['team_features']    = $result['package_features'];
		}else{
			/* User is Team member */	
			$result['team_features'] 	= $this->get_team_array($permit_data['user_id']);
		}
		$data['permitted_data']     	= array(
												'package_features'  => $result['package_features'],
												'team_features' 	=> $result['team_features'],					
											);
		$this->session->set_userdata('permitted_data',$data['permitted_data']);
		return true;		
	}
	
	private function get_package_array($id){
		$data = [];
		$data = getSingleRow('app_packages',array('package_id'=>$id))['package_data'];
		return $data;		
	}
	
	private function get_team_array($id){
		$data = [];
		$data = $this->Login_model->get_member_features($id);;
		return $data;		
	}
	
	public function sendMail2(){
		$data['to'] = 'chirayushri@gmail.com';
        $data['subject'] = 'Demo mail';
        $data['message'] = 'Hi Demo Email';
		$this->sendMail($data);
	}
}
