<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['find/(:any)'] = 'site/find/$1';
$route['(:any)'] = 'site/index';
$route['default_controller'] = 'site/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
