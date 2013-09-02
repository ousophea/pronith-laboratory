<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */

//// ------------------ QMS
define('TEMPLATE', 'templates/win8');

define('CSS','templates/win8/css/');
define('JS','templates/win8/js/');
define('FONT','templates/win8/font-awesome/');

// prefex password
define('PASSWORD_PREFEX', 'LaBo$');


// TABLE and field name
define('TBL_PREFEX', 'tbl_');
define('USERS', TBL_PREFEX.'users');
define('USE_ID', 'use_id');
define('USE_USERNAME', 'use_username');
define('USE_PASSWORD', 'use_password');
define('USE_FIRSTNAME', 'use_firstname');
define('USE_LASTNAME', 'use_lastname');
define('USE_FULLNAME', 'use_fullname');
define('USE_STATUS', 'use_status');
define('USE_GROUPID', 'use_gro_id');

define('GROUPS', TBL_PREFEX.'users_groups');
define('GRO_ID', 'gro_id');
define('GRO_NAME', 'gro_name');
define('GRO_DES', 'gro_description');
define('GRO_STATUS', 'gro_status');