<?php
	
	//  phpinfo();
 	// echo "934e435260635d2b56c3426a0d54dac4";
	 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	require "config/Autoload.php";
	require "config/Data.php";
	require "config/DataAPI.php";
	
	use config\Autoload as Autoload;
	use config\Router 	as Router;
	use config\Request 	as Request;
		
    Autoload::start();
	session_start();
	//include_once(VIEWS.'/header.php');
	//include_once(VIEWS.'/login.php');
	//include_once(VIEWS.'/nav.php');
	//include_once(VIEWS.'/CrudCinema.php');
	
	//include_once(VIEWS.'/footer.php');
	//var_dump($_SESSION);
	Router::Route(new Request());

	
?>