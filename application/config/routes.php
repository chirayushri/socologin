<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['dashboard'] = 'dashboard/index';
$route['profile'] = 'dashboard/profile';
$route['change-pasword'] = 'dashboard/profile';
$route['logout'] = 'login/logout';
$route['signup'] = 'login/signup';
$route['login'] = 'login/index';
$route['forgot-password'] = 'login/forgotPassword';
$route['reset-password/(:any)'] = 'login/resetPassword/$1';
$route['email-verify/(:any)'] = 'login/emailVerify/$1';
$route['forgot-verify/(:any)'] = 'login/forgotVerify/$1';
$route['404_override']  = 'login/access_denied';
$route['access-denied'] = 'login/access_denied';

$route['members']['GET']     		= 'member/index/member';
$route['member/add']['GET'] 		= 'member/index/member_add';
$route['member/edit/(:any)']['GET'] = 'member/index/member_edit/$1';

$route['member/roles']['GET'] = 'member/index/role';
$route['member/role/add']['GET'] = 'member/index/role_add';
$route['member/role/add']['POST'] = 'member/role_add';
$route['member/role/edit/(:any)']['GET'] = 'member/index/role_edit/$1';
$route['member/role/edit']['POST'] = 'member/role_edit';

$route['packages']['GET']     			= 'member/index/packages';
$route['packages/add']['GET'] 			= 'member/index/package_add';
$route['packages/edit/(:any)']['GET'] 	= 'member/index/package_edit/$1';
$route['packages/add']['POST'] 			= 'package/package_add';
$route['packages/edit']['POST'] 		= 'package/package_edit';

$route['pages']['GET']     				= 'member/index/pages';
$route['pages/add']['GET'] 				= 'member/index/page_add';
$route['pages/edit/(:any)']['GET'] 		= 'member/index/page_edit/$1';
$route['pages/add']['POST'] 			= 'page/page_add';
$route['pages/edit']['POST'] 			= 'page/page_edit';


$route['translate_uri_dashes'] = FALSE;
