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
| example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
| https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
| $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
| $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
| $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples: my-controller/index -> my_controller/index
|   my-controller/my-method -> my_controller/my_method
*/
$route['default_controller'] = 'auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

//$route['main/login'] = 'main/login';
/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
$route['admin'] = 'admin/dashboard';
$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8
// api/example/users/
//   api/example/users/1  api/example/users/id/1  api/example/users/id/1/html/

//Complaint  REST API Routes
$route['api/complaint/dashboard'] = 'api/complaint/dashboard';
$route['api/complaint/key_in/(:num)'] = 'api/complaint/key_in/id/$1';
$route['api/complaint/key_in_file/(:num)'] = 'api/complaint/key_in_file/id/$1';
$route['api/complaint/result/(:num)'] = 'api/complaint/result/id/$1';
$route['api/complaint/user_detail/(:num)'] = 'api/complaint/user_detail/$1';

$route['api/complaint/export/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/complaint/export/id/$1/format/$3$4';
$route['api/complaint/export_xml/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/complaint/export/id/$1/format/$3$4';


//User  REST API Routes
$route['api/user/user'] = 'api/user/user';
$route['api/user/user/(:num)'] = 'api/user/user/id/$1';
$route['api/user/user_groups/(:num)'] = 'api/user/user_groups/id/$1';


//Setting  REST API Routes
$route['api/setting/complain_type/(:num)'] = 'api/setting/complain_type/id/$1'; // Example 4
$route['api/setting/accused_type/(:num)'] = 'api/setting/accused_type/id/$1'; // Example 4
$route['api/setting/channel/(:num)'] = 'api/setting/channel/id/$1'; // Example 4
$route['api/setting/subject/(:num)'] = 'api/setting/subject/id/$1'; // Example 4
$route['api/setting/wish/(:num)'] = 'api/setting/wish/id/$1'; // Example 4
$route['api/report/report_statistic_by_type/(:num)'] = 'api/report/report_all_complaint/$1'; // Example 4
$route['api/report/report_statistic_by_type/(:num)'] = 'api/report/report_statistic_by_type/year/$1'; // Example 4
$route['api/report/report_statistic_by_type_max/(:num)'] = 'api/report/report_statistic_by_type_max/year/$1'; // Example 4
$route['api/report/month_report/(:num)'] = 'api/report/month_report/year/$1'; // Example 4
$route['api/setting/org/(:num)'] = 'api/setting/org/id/$1'; // Example 4
$route['api/setting/use_org/(:num)'] = 'api/setting/use_org/id/$1'; // Example 4
$route['api/setting/use_complain_type/(:num)'] = 'api/setting/use_complain_type/id/$1'; // Example 4
$route['api/setting/use_accused_type/(:num)'] = 'api/setting/use_accused_type/id/$1'; // Example 4
$route['api/setting/complain_type_lists/(:num)'] = 'api/setting/complain_type_lists/id/$1'; // Example 4
$route['api/authen/re_password_info/(:num)'] = 'api/authen/re_password_info/$1'; // Example 4


