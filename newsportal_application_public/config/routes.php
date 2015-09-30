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

$route['default_controller'] = "index";
$route['404_override'] = "error/page_missing";

$route['signup'] = "user/signup";
$route['account-activate/(:any)'] = "user/account_activate/$1";
$route['login'] = "user/login";
$route['signout'] = "user/signout";

$route['news/(:any)/(:any)'] = "news/news_details/$2";
$route['news-pdf-download/(:any)'] = "news/news_pdf_download/$1";
$route['rss-feed'] = "news/rss_news_feed";
$route['my-news'] = "news/my_news";
$route['add-news'] = "news/add_news";

$route['ajax-delete-news'] = "ajax/ajax_delete_news";
$route['ajax-check-email-avilability'] = "ajax/ajax_check_email_avilability";

/* End of file routes.php */
/* Location: ./application/config/routes.php */