<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['admin'] = 'admin/home';
$route['default_controller'] = 'pages';
$route['post/(:any)'] = 'blog/get_blog/$1';
//$route['404_override'] = 'pages';
$route['translate_uri_dashes'] = FALSE;
