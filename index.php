<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);
date_default_timezone_set('America/New_York');

require_once('kernel/definitions.php');
require_once('kernel/connection.php');
require_once('kernel/class.user.php');
require_once('kernel/init.php');
require_once('kernel/functions.php');


session_id() || session_start();



$user = new User();

$user_data = array( 'name' => 'sLomakov', 'email' => 'sapfeer0k@gmail.com', 'password' => sha1('12345'), 'date' => time() );

//$id = $user->createUser($user_data);


if (isset($_SESSION['user_id'])) { // user authorized
	$user = new User($_SESSION['user_id']);
	if ( !$user->getId() ) {
		unset($_SESSION['user_id']);
		header('Location: /');
		die();
	}
	action_dashboard();	
	
} else {
	action_login($_POST);
	$smarty->display('login.tpl');

}

/*

if ( 0 && !$id ) {
	print("User already exists!");
}
*/
?>
