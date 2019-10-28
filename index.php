<?php 
session_start();

require_once("vendor/autoload.php");
// require_once("functions.php");

use Code\Model\User;

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {
    
	$page = new Code\Page();

	$page->setTpl("index");

});

$app->get('/admin', function() {

	User::verifyLogin();
    
	$page = new Code\PageAdmin();

	$page->setTpl("index");

});

$app->get('/admin/login', function() {
    
	$page = new Code\PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("login");

});

$app->post('/admin/login', function(){

	User::login($_POST['deslogin'], $_POST['despassword']);

	header("Location: /admin");
	exit;
});


$app->get('/admin/logout', function() {

	User::logout();

	header("Location: /admin/login");
	exit;

});

$app->get('/admin/users', function() {

	User::verifyLogin();

	$page = new Code\PageAdmin();

	$page->setTpl("users");

});

$app->get('/admin/users/create', function() {

	User::verifyLogin();

	$page = new Code\PageAdmin();

	$page->setTpl("users-create");

});

$app->get('/admin/users:iduser', function($iduser) {

	User::verifyLogin();

	$page = new Code\PageAdmin();

	$page->setTpl("users-update");

});


$app->post("/admin/users/create", function(){

	User::verifyLogin();	
});

$app->post("/admin/users:iduser", function($iduser){

	User::verifyLogin();	
});


$app->delete("/admin/users/:iduser", function($iduser){
	User::verifyLogin();
});





$app->run();

