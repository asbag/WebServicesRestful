<?php
/**
 * @author David Mezquíriz Osés
 */
 
require 'vendor/autoload.php';

spl_autoload_register('loadClasses');

function loadClasses ($class) {
	if (file_exists('classes/'.$class . '.inc.php')) {
		require('classes/'.$class . '.inc.php');
	}
}


$app = new \Slim\Slim();

$app->get('/', 'indexFunction');
$app->get('/frameworks','listFrameworks');
$app->get('/framework/:name','frameworkInfo');
$app->get('/find','findFramework');
$app->get('/update','updateFramework');
$app->delete('/drop/:name','dropFramework');
$app->notFound(function(){echo 'Umm ... not sure what you mean';});

$app->run();

//Write the code for each function
function dbHandle() {
	try {
		$db = new PDO($dsn, $username, $password);
		$db->prepare($statement)
	} catch (PDOException $e)  {
		echo $e->getMessage();
	}
}
?>