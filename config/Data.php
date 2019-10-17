<?php namespace Config;

/* DB */ 
define('DB_HOST', 'localhost');
define('DB_NAME', 'cines');
define('DB_USER', 'admin');
define('DB_PASS', 'admin@');

/* BACK */
define('ROOT', dirname(__DIR__));
define('VIEWS', ROOT . '/views');
define('ADMIN_VIEWS', ROOT . '/views/admin');

/* FRONT */
define('FRONT_ROOT','http://localhost/Proyecto-cines-programacion-2019');
define('VIEWS_PATH', FRONT_ROOT .'/views');
define('CSS_PATH',FRONT_ROOT . '/assets/css');
define('JS_PATH', FRONT_ROOT . '/assets/js');
define('IMG_PATH',FRONT_ROOT . '/assets/img');


/*
define('IMG_PATH', FRONT_ROOT . '/asset/img');
define('IMG_UPLOADS_PATH', FRONT_ROOT . '/asset/uploads/img');
define('MOV_UPLOADS_PATH', FRONT_ROOT . '/asset/uploads/movies');
*/
