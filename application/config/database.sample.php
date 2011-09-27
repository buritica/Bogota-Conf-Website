<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

if(ENV == 'local'){
	$active_group = "local";
}elseif(ENV == 'dev'){
	$active_group = "dev";
}elseif(ENV == 'live'){
	$active_group = "live";
}


$active_record = TRUE;
//local server
$db['giovanny']['hostname'] = "giovannyhost";
$db['giovanny']['username'] = "giovanny";
$db['giovanny']['password'] = "";
$db['giovanny']['database'] = "bogotaconf";
$db['giovanny']['dbdriver'] = "mysql";
$db['giovanny']['dbprefix'] = "";
$db['giovanny']['pconnect'] = TRUE;
$db['giovanny']['db_debug'] = TRUE;
$db['giovanny']['cache_on'] = FALSE;
$db['giovanny']['cachedir'] = "";
$db['giovanny']['char_set'] = "utf8";
$db['giovanny']['dbcollat'] = "utf8_general_ci";

$active_record = TRUE;
//local server
$db['local']['hostname'] = "localhost";
$db['local']['username'] = "local";
$db['local']['password'] = "";
$db['local']['database'] = "bogotaconf";
$db['local']['dbdriver'] = "mysql";
$db['local']['dbprefix'] = "";
$db['local']['pconnect'] = TRUE;
$db['local']['db_debug'] = TRUE;
$db['local']['cache_on'] = FALSE;
$db['local']['cachedir'] = "";
$db['local']['char_set'] = "utf8";
$db['local']['dbcollat'] = "utf8_general_ci";

//dev server
$db['dev']['hostname'] = "localhost";
$db['dev']['username'] = "";
$db['dev']['password'] = "";
$db['dev']['database'] = "bogotaconf_prod";
$db['dev']['dbdriver'] = "mysql";
$db['dev']['dbprefix'] = "";
$db['dev']['pconnect'] = TRUE;
$db['dev']['db_debug'] = TRUE;
$db['dev']['cache_on'] = FALSE;
$db['dev']['cachedir'] = "";
$db['dev']['char_set'] = "utf8";
$db['dev']['dbcollat'] = "utf8_general_ci";

//live server
$db['live']['hostname'] = "localhost";
$db['live']['username'] = "bogotaconf";
$db['live']['password'] = "";
$db['live']['database'] = "";
$db['live']['dbdriver'] = "mysql";
$db['live']['dbprefix'] = "";
$db['live']['pconnect'] = TRUE;
$db['live']['db_debug'] = FALSE;
$db['live']['cache_on'] = FALSE;
$db['live']['cachedir'] = "";
$db['live']['char_set'] = "utf8";
$db['live']['dbcollat'] = "utf8_general_ci";



/* End of file database.php */
/* Location: ./application/config/database.php */