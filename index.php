<?php
require 'vendor/autoload.php';
require 'functions.php';

require_all_files( 'includes' );

Flight::view()->set('asset_url', get_base_url() . 'assets' );
Flight::view()->set('menu', array(
	array(
		'url' => '/',
		'icon' => 'ni ni-tv-2',
		'text' => 'Dashboard'
	),
	array(
		'url' => '/users',
		'icon' => 'ni ni-circle-08',
		'text' => 'Users'
	),
) );

if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}

// set database connection
Flight::register('db', 'MysqliDb', array( 'localhost', 'root', '', 'deft__learn' ) );

Flight::route('/', function(){
	if ( !isset( $_SESSION['user'] ) ) {
		Flight::redirect( '/login' );
		exit();
	}

	Flight::view()->set('title', 'Dashboard');
    Flight::render( 'dashboard', array( 'name' => $_SESSION['user'] ) );
});

Flight::start();