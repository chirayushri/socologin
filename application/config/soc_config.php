<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/* Google  Login */

	//Google client ID
	$config['google_client_id']	     =  '418314426427-rgju9eq6qp3luo01e242cmn820u343k5.apps.googleusercontent.com'; 
	//Google client secret
	$config['google_client_secret']  =  'XodplnM0GdIa59OFTaVYaNby'; 
	//Google Redirect URL
	$config['google_redirect_url']   =   base_url() .'login/google_login';

/* Google  Login */


/* Facebook  Login */

$config['facebook_app_id']              = '2319894671618699';
$config['facebook_app_secret']          = '72f12ae2c3d49793f021079507c417a6';
$config['facebook_login_type']          = 'web';
$config['facebook_login_redirect_url']  = 'login/facebook_login';
$config['facebook_logout_redirect_url'] = 'login/logout';
$config['facebook_permissions']         = array('email');
$config['facebook_graph_version']       = 'v2.6';
$config['facebook_auth_on_load']        = TRUE;

/* Facebook  Login */