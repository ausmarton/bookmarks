<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "welcome";
$route['404_override'] = '';

switch($_SERVER['REQUEST_METHOD']) {
	case "GET":
		$route['bookmarks'] = 'bookmarks/get_index';
		$route['tags'] = 'tags/get_index';
		$route['bookmarks/new'] = 'bookmarks/get_new';
		$route['bookmarks/(:num)'] = "bookmarks/get_show/$1";
		$route['bookmarks/(:num)/edit'] = "bookmarks/get_edit/$1";
		break;
	case "POST":
		$route['bookmarks'] = 'bookmarks/post_create';
		$route['tags'] = 'tags/post_create';
		break;
	case "PUT":
		$route['bookmarks/(:num)'] = "bookmarks/put_update/$1";
		$route['tags/(:num)'] = "tags/put_update/$1";
		break;
	case "DELETE":
		$route['bookmarks/(:num)'] = "bookmarks/delete/$1";
		$route['tags/(:num)'] = "tags/delete/$1";
		break;
}


//$route['bookmarks/(:num)/confirm_delete'] = "bookmarks/post_confirm_delete/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */
