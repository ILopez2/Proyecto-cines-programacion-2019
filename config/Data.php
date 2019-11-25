<?php namespace config;

    /* DB */ 
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'tpcines');
    define('DB_USER', 'root');
    define('DB_PASS', '');

    /* BACK */
    define('ROOT', dirname(__DIR__)."/");

    define('VIEWS', ROOT . '/views');
    define('TEMP', ROOT . 'temp');
    define('ADMIN_VIEWS', ROOT . '/views/admin');

    /* FRONT */
    define('FRONT_ROOT','/Proyecto-cines-programacion-2019/');
    define('VIEWS_PATH', FRONT_ROOT .'/views');
    define('CSS_PATH',FRONT_ROOT . '/assets/css');
    define('JS_PATH', FRONT_ROOT . '/assets/js/');
    define('IMG_PATH',FRONT_ROOT . 'assets/images/');

    /* EXTRAS */

    /*CONSTANTE PARA ESTABLECER LA ZONA HORARIA EN ARGENTINA
    EJEMPLO date_default_timezone_set(TMZARG);*/
    define("TMZARG",'America/Argentina/Buenos_Aires');

