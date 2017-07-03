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
$route['api/user/user'] = 'api/user/user';
$route['api/user/user/(:num)'] = 'api/user/user/id/$1';


//Setting  REST API Routes
$route['api/setting/complain_type/(:num)'] = 'api/setting/complain_type/id/$1'; // Example 4
$route['api/setting/accused_type/(:num)'] = 'api/setting/accused_type/id/$1'; // Example 4
$route['api/setting/channel/(:num)'] = 'api/setting/channel/id/$1'; // Example 4
$route['api/setting/subject/(:num)'] = 'api/setting/subject/id/$1'; // Example 4
$route['api/setting/wish/(:num)'] = 'api/setting/wish/id/$1'; // Example 4



/*
| -------------------------------------------------------------------------
| Sample SOAP Routes
| -------------------------------------------------------------------------
*/

$route['nuSoapServer/getMember/wsdl'] = 'nuSoapServer/index/wsdl';
