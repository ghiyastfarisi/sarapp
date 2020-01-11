<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$host = 'localhost';
$user = 'root';
$pass = '';

if (ENVIRONMENT === 'production') {
	$host = 'mariadb-local';
	$user = 'root';
	$pass = 'Example2020Example2020';
}

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => $host,
	'username' => $user,
	'password' => $pass,
	'database' => 'db_hallovent',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
