<?php

// This is the database connection configuration.
return array(
	//uncomment the following lines to use a SQLite database
	/*
	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	*/
	// uncomment the following lines to use a MySQL database
	'connectionString' => 'mysql:host=localhost;dbname=cookbook_db',
	'emulatePrepare' => true,
	'username' => 'root',
	'password' => 'oDD-!#%&(!!',
	'charset' => 'utf8',
);
