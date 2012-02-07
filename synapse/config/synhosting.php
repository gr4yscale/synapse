<?php
/**
 the environement
*/

switch($_SERVER['HTTP_HOST'])
{
	case 'localhost':
		define('__ENVIRONMENT', 'testing');
	break;

	case 'synapse.synergylocal.net':
		define('__ENVIRONMENT', 'development');
	break;

	case 'synapse.synergylocal.com':
		define('__ENVIRONMENT', 'production');
	break;

	default:
		define('__ENVIRONMENT', 'testing');
}
 
switch(__ENVIRONMENT){
	case 'testing':
		define('ROOT', DS.'Data'.DS.'Code'.DS.'synapse');
		define('APP_DIR', 'www');
		define('CAKE_CORE_INCLUDE_PATH', DS.'Data'.DS.'Code'.DS.'synapse');
	break;

	case 'development':
		define('ROOT', DS.'home'.DS.'www'.DS.'synergylocal.net'.DS.'synapse');
		define('APP_DIR', 'www');	
		define('CAKE_CORE_INCLUDE_PATH', DS.'home'.DS.'www'.DS.'synergylocal.net'.DS.'synapse');

	break;

	case 'production':

	break;
}


/**
* Core Defines
*/

/** I dunno about any of this!
* define(’DEBUG’, 3);
* define(’CACHE_CHECK’, false);
* define(’LOG_ERROR’, 2);
* define(’CAKE_SESSION_SAVE’, ‘php’);
* define(’CAKESESSIONTABLE’, ‘cake_sessions’);
define(’CAKE_SESSION_STRING’, ‘ANYSESSIONKEYHERE’);
define(’CAKESESSIONCOOKIE’, ‘CAKEPHP’);
define(’CAKE_SECURITY’, ‘high’);
define(’CAKESESSIONTIMEOUT’, ‘120′);
define(’CAKE_ADMIN’, ‘admin’);
define(’WEBSERVICES’, ‘off’);
define(’COMPRESS_CSS’, false);
define(’AUTO_SESSION’, true);
define(’MAX_MD5SIZE’, (5 * 1024) * 1024);
define(’ACLCLASSNAME’, ‘DBACL’);
define(’ACL_FILENAME’, ‘db_acl’);
define(’ACL_DATABASE’, ‘default’);
define(’CACHE_DEFAULT_DURATION’, 0);
define(’CACHEGCPROBABILITY’, 3);
$cakeCache = array(’File’);
*/
