<?php namespace Config;
 /* FRONT */
 define('FRONT_ROOT','/Proyecto-cines-programacion-2019/');
 /* BACK */
 define('ROOT', dirname(__DIR__)."/");
 
 define('DB_HOST', 'localhost');
 define('DB_NAME', 'cines');
 define('DB_USER', 'admin');
 define('DB_PASS', 'admin@');
 /* BACK */
define('VIEWS', ROOT . 'views/');
define('ADMIN_VIEWS', ROOT . 'views/admin/');

/* FRONT 
define('ADMIN_FRONT_ROOT', FRONT_ROOT . '/admin');
*/
define('CSS_PATH',VIEWS . 'css/');
define('JS_PATH', VIEWS . 'js/');
define('IMG_PATH',VIEWS . 'img/');
/*
define('IMG_PATH', FRONT_ROOT . '/asset/img');
define('IMG_UPLOADS_PATH', FRONT_ROOT . '/asset/uploads/img');
define('MOV_UPLOADS_PATH', FRONT_ROOT . '/asset/uploads/movies');
*/
