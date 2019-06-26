<?php 

require_once("vendor/autoload.php");

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {
    
	$sql = new Coder\DB\Sql();

	$results = $sql->select("SELECT * FROM td_users");

	echo json_encode($results);


});

$app->run();

 ?>