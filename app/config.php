<?php

//VERSION 1.2.0

if ($_SERVER['HTTP_HOST'] == 'tiny.com.ng') {
	// Live Database Configuration
	define("ENV", "PRODUCTION");
	define('URL', '');
	define('DB_TYPE', 'mysql');
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'live_db_name');
	define('DB_USER', 'live_db_user');
	define('DB_PASS', 'live_db_password');
} else if ($_SERVER['HTTP_HOST'] == 'dev.tiny.com.ng') {
	// dev Database Configuration
	define("ENV", "DEV");
	define('URL', '');
	define('DB_TYPE', 'mysql');
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'dev_db_name');
	define('DB_USER', 'dev_db_user');
	define('DB_PASS', 'dev_db_password');
} else {
	// Local Database Configuration
	define("ENV", "LOCAL");
	define('URL', '/');
	define('DB_TYPE', 'mysql');
	define('DB_HOST', '127.0.0.1');
	define('DB_NAME', 'tiny_blog');
	define('DB_USER', 'root');
	define('DB_PASS', 'root');
}

// The site wide hash key, do not change this because its used for passwords!
// This is for other hash keys... Not sure yet
define('HASH_GENERAL_KEY', 's@fsS_+FS4#EreSDf2#$@3412');
define('HASH_PASSWORD_KEY', 'catsFLYhigh2000miles');

define('SITE_NAME', 'Tiny');
define('JWT_SECRET', 'TINY_SECRET@#$_%');
define('SHOW_DB_ERROR', false);


define('DEFAULT_TIME_ZONE', 'Africa/Lagos');
define('DIRECTORY_ROOT', 'tiny-blog');
define('URL_ROOT', 'http://localhost/' . DIRECTORY_ROOT);
