<?php
class DATABASE_CONFIG {

	var $testing = array(
		'driver' => 'mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'root',
		'password' => 'root',
		'database' => 'synapse'
	);

	var $development = array(
		'driver' => 'mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'root',
		'password' => 'root',
		'database' => 'synapse'
	);

	var $production = array(
		'driver' => 'mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'synapse',
		'password' => 'synapse',
		'database' => 'synapse'
	);

	var $default = array();

	function __construct()
	{
		$this->default = ($_SERVER['SERVER_ADDR'] == '127.0.0.1') ?
			$this->testing : $this->development;
	}

	function DATABASE_CONFIG()
	{
		$this->__construct();
	}
}
?>
