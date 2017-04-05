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
$route['default_controller'] = 'welcome';
$route['test-ebay'] = 'client/ebay';
$route['login'] = 'client/user/login';
$route['logout'] = 'client/user/logout';
$route['register'] = 'client/user/register';
$route['profile'] = 'client/user/profile';
$route['change-user-info'] = 'client/user/changeInfo';
$route['change-password'] = 'client/user/changePass';
$route['request/(:any)'] = 'client/user/forgotPassword/$1';
$route['reset-pwd/(:any)'] = 'client/user/resetPass/$1';
$route['change-reset-password'] = 'client/user/changeResetPass';
$route['supplier'] = 'client/user/supplier';
$route['configuration'] = 'client/user/configuration';
$route['change-config'] = 'client/user/changeConfig';
$route['order-management'] = 'client/user/order_management';
$route['getItemForEbay'] = 'client/user/getItemForEbay';
$route['getItemForAliExpress'] = 'client/user/getItemForAliExpress';
$route['admin-manager'] = 'admin/admin/manager';
$route['admin-fee-history'] = 'admin/admin/fee_history_list';
$route['computeFeeHistory'] = 'admin/admin/computeFeeHistory';
$route['updateFeeHistory'] = 'admin/admin/updateFeeHistory';
$route['admin-displayuser'] = 'admin/admin/display_user';
$route['admin-lock-account/(:num)'] = 'admin/admin/lockaccount/$1';
$route['admin-unlock-account/(:num)'] = 'admin/admin/unlockaccount/$1';
$route['admin-paid-account/(:num)'] = 'admin/admin/paidaccount/$1';
$route['admin-free-account/(:num)'] = 'admin/admin/freeaccount/$1';
$route['admin-login/(:num)'] = 'admin/admin/adminlogin/$1';
$route['update-manager'] = 'admin/admin/update_manager';
$route['admin-save-supplier'] = 'admin/admin/save_supplier';
$route['auto-check-price'] = 'admin/admin/auto_check_price';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
