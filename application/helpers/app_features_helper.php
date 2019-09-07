<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('check_access'))
{
    function check_access($item){	
		$CI =& get_instance();
		if($CI->session->userdata("logged_user")['id']==$CI->config->item('admin_id')){
			return true;
		}
		is_package_feature($item);
		is_team_feature($item);
	}
}

if (!function_exists('is_package_feature'))
{
    function is_package_feature($item){	
	$CI =& get_instance();
	if($CI->session->userdata("logged_user")['parent_id']==$CI->config->item('admin_id')){
			return true;
	}
	$package_features 	= json_decode($CI->session->userdata("permitted_data")["package_features"],true);
	$item_array			= array($item=>1);
	$result				= array_intersect_key($package_features,$item_array);
		if($result){
			if($result[$item]!=1){
				$response['status'] = 'package_denied';
				$response['message'] = 'Access Denied ! Feature not available in your package.';
				header('Content-Type: application/json');
				echo json_encode($response); die();
			}
		}else{
				$response['status'] = 'package_denied';
				$response['message'] = 'Access Denied ! Feature not available in your package.';
				header('Content-Type: application/json');
				echo json_encode($response); die();
		}
	}
}

if (!function_exists('is_team_feature'))
{
    function is_team_feature($item){
	$CI =& get_instance();
    $team_features 	= json_decode($CI->session->userdata("permitted_data")["team_features"],true);
	$item_array			= array($item=>1);
	$result				= array_intersect_key($team_features,$item_array);
		if($result){
			if($result[$item]!=1){
				$response['status'] = 'team_denied';
				$response['message'] = 'Access Denied ! Access not available in your account.';
				header('Content-Type: application/json');
				echo json_encode($response); die();
			}	
		}else{
				$response['status'] = 'team_denied';
				$response['message'] = 'Access Denied ! Access not available in your account.';
				header('Content-Type: application/json');
				echo json_encode($response); die();
		}	
	}
}


