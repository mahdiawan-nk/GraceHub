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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

$route['page-gereja/(:num)']='welcome/page_gereja/$1';
$route['info-gereja/(:num)']='welcome/info_gereja/$1';

$route['admins']='auth';
$route['api/login']['post']='auth/authCheck';
$route['api/logout']['get']='auth/logout';
$route['api/me']['get']='auth/me';

$route['admins/dashboard']='dashboard';
$route['admins/data-gereja']='datagereja';
$route['admins/informasi-gereja']='informasigereja';
$route['admins/pengguna']='users';

$route['api/datagereja']['get']='datagereja/list';
$route['api/datagereja/(:num)']['get']='datagereja/show/$1';
$route['api/datagereja']['POST']='datagereja/store';
$route['api/datagereja/(:num)']['post']='datagereja/update/$1';
$route['api/datagereja/(:num)']['DELETE']='datagereja/destroy/$1';

$route['api/kecamatan']['get']='welcome/kecamatan';

$route['api/infogereja']['get']='informasigereja/list';
$route['api/infogereja/(:num)']['get']='informasigereja/show/$1';
$route['api/infogereja']['POST']='informasigereja/store';
$route['api/infogereja/(:num)']['post']='informasigereja/update/$1';
$route['api/infogereja/(:num)']['DELETE']='informasigereja/destroy/$1';

$route['api/users']['get']='users/list';
$route['api/users/(:num)']['get']='users/show/$1';
$route['api/users']['POST']='users/store';
$route['api/users/password/(:num)']['POST']='users/updatepassword/$1';
$route['api/users/(:num)']['post']='users/update/$1';
$route['api/users/(:num)']['DELETE']='users/destroy/$1';

$route['api/gereja']['get']='welcome/get_data';
$route['api/info-gereja']['get']='welcome/get_data_info';