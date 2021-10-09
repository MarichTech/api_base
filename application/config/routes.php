<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'accounts/index';

$route['users/register'] = 'users/register';
$route['users/login'] = 'users/login';

$route['accounts/create'] = 'accounts/create';
$route['accounts/update'] = 'accounts/update';
$route['accounts/(:any)'] = 'accounts/view/$1';
$route['accounts'] = 'accounts/index';


$route['opportuinities/create'] = 'opportuinities/create';
$route['opportuinities/update'] = 'opportuinities/update';
$route['opportuinities'] = 'opportuinities/index';

$route['(:any)'] = 'pages/view/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
