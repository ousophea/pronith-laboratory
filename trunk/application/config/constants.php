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
define('IMG','templates/win8/img/');
define('FONT','templates/win8/font-awesome/');

// prefex password
define('PASSWORD_PREFEX', 'LaBo$');


// TABLE and field name
define('TBL_PREFEX', 'tbl_');
define('VIE_PREFEX', 'vie_');
define('PRO_PREFEX', 'pro_');
define('FUN_PREFEX', 'fun_');
define('USERS', TBL_PREFEX.'users');
define('USE_ID', 'use_id');
define('USE_USERNAME', 'use_username');
define('USE_PASSWORD', 'use_password');
define('USE_FIRSTNAME', 'use_firstName');
define('USE_LASTNAME', 'use_lastName');
define('USE_FULLNAME', 'use_fullName');
define('USE_DATACREATED', 'use_dateCreated');
define('USE_DATAMODIFIED', 'use_dateModified');
define('USE_STATUS', 'use_status');
define('USE_GROUPID', 'use_gro_id');

define('GROUPS', TBL_PREFEX.'users_groups');
define('GRO_ID', 'gro_id');
define('GRO_NAME', 'gro_name');
define('GRO_DES', 'gro_description');
define('GRO_STATUS', 'gro_status');

define('ILLGROUPS', TBL_PREFEX.'ills_groups');
define('ILG_ID', 'ill_gro_id');
define('ILG_NAME', 'ill_gro_name');
define('ILG_NAMEKH', 'ill_gro_nameKh');
define('ILG_DESCRIPTION', 'ill_gro_description');
define('ILG_DATECREATED', 'ill_gro_dateCreated');
define('ILG_DATEMODIFIED', 'ill_gro_dateModified');
define('ILG_STATUS', 'ill_gro_status');

define('ILLS', TBL_PREFEX.'ills');
define('ILL_ID', 'ill_id');
define('ILL_GROUPID', 'ill_ill_gro_id');
define('ILL_NAME', 'ill_name');
define('ILL_NAMEKH', 'ill_nameKh');
define('ILL_DATECREATED', 'ill_dateCreated');
define('ILL_DATEMODIFIED', 'ill_dateModified');
define('ILL_STATUS', 'ill_status');

define('ILLITEMS', TBL_PREFEX.'ills_items');
define('ILI_ID', 'ill_ite_id');
define('ILI_ILLID', 'ill_ite_ill_id');
define('ILI_NAME', 'ill_ite_name');
define('ILI_DESCRIPTION', 'ill_ite_description');
define('ILI_DIMENTION', 'ill_ite_dimention');
define('ILI_VALUEMALE', 'ill_ite_value_male');
define('ILI_VALUEFEMALE', 'ill_ite_value_female');
define('ILI_DATECREATED', 'ill_ite_dateCreated');
define('ILI_DATEMODIFIED', 'ill_ite_dateModified');
define('ILI_STATUS', 'ill_ite_status');

// Global worlds
define('DROPDOWN_DEFAULT', '-- ច្រើសរើស --');
define('STATUS', 'status');
//doctor commission %
define('DOCTOR_COMMISSION', 10);