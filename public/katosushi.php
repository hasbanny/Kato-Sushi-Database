<?php
require '../vendor/autoload.php';
require '../generated-conf/config.php';

session_start();
//////////////////////
// Slim Setup
//////////////////////

$settings = ['displayErrorDetails' => true];

$app = new \Slim\App(['settings' => $settings]);

$container = $app->getContainer();
$container['view'] = function($container) {
	$view = new \Slim\Views\Twig('../templates');
	
	$basePath = rtrim(str_ireplace('index.php', '', 
	$container->get('request')->getUri()->getBasePath()), '/');

	$view->addExtension(
	new Slim\Views\TwigExtension($container->get('router'), $basePath));
	
	$view->getEnvironment()->addGlobal('flash', $container->flash);
	return $view;
};

$container['flash'] = function($container){
	return new \Slim\Flash\Messages();
};


//////////////////////
// Routes
//////////////////////

// home page route
$app->get('/', function ($request, $response, $args) {
	$this->view->render($response, 'index.html');
	return $response;
})->setName('home');

//login route
$app->get('/log', function ($request, $response, $args) {
	$this->view->render($response, 'login.html');
	return $response;
})->setName('log');

//owner view route
$app->get('/owner_view', function ($request, $response, $args) {
	$response= $this->view->render($response, 'owner_view.html');
    return $response;
})->setName('owner_view');

//view tables {employee/inventory/finances/suppliers}
$app->get('/employee', function($request, $response, $args) {
    $emp = EmployeeQuery::create()->find();
	$response = $this->view->render($response, 'employee.html', [
        "employee" => $emp
		]);
	return $response;
})->setName('employee');

$app->get('/inventory', function($request, $response, $args) {
    $inv = InventoryQuery::create()->find();
	$response = $this->view->render($response, 'inventory.html', [
        "inventory" => $inv
		]);
	return $response;
})->setName('inventory');

//add employee/inventory/finances/suppliers
$app->get('/employee_add', function($request, $response, $args) {
	$response = $this->view->render($response, 'employee_add.html');
	return $response;
})->setName('employee_add');

//update employee/inventory/finances/suppliers
$app->get('/employee_update', function($request, $response, $args) {
	$response = $this->view->render($response, 'employee_update.html');
	return $response;
})->setName('employee_update');

//delete employee/inventory/finances/suppliers
$app->get('/employee_del', function($request, $response, $args) {
	$response = $this->view->render($response, 'employee_del.html');
	return $response;
})->setName('employee_del');

//use post instead to get the information from the forms
$app->get('/owner_add', function($request, $response, $args) use ($app){
	$ne = new Owner();
	$ne->setName('Cecilia Sanchez');
	$ne->setAddress('406 Cherokee Lane. Alamo, TX');
	$ne->setPhoneNum('9561234567');
	$ne->setPasswordHash($ne->setPassword('123'));
	$ne->save();

	echo $ne->getPasswordHash();
});


//use post instead to get the information from the forms
$app->post('/employee_add', function($request, $response, $args) use ($app){
	$post = $request->getParsedBody();
	$ne = new Employee();
	$ne->setName($post['fullname']);
	$ne->setEmpSsn($post['ssn']);
	$ne->setPhoneNum($post['phone']);
	$ne->setSalary($post['salary']);
	$ne->setJobTitle($post['job']);
	$ne->save();
	
	return $response->withRedirect('employee');
});

//use post instead to get the information from the forms
$app->post('/employee_update', function($request, $response, $args) {
	$post = $request->getParsedBody();
	$e = EmployeeQuery::create()->findPk($post['emp_id']);
	if($post['fullname'] != ''){
		$e->setName($post['fullname']);
	}
	if($post['ssn'] != ''){
		$e->setEmpSsn($post['ssn']);
	}
	if($post['phone'] != ''){
		$e->setPhoneNum($post['phone']);
	}
	if($post['salary'] != ''){
		$e->setSalary($post['salary']);
	}
	if($post['job'] != ''){
		$e->setJobTitle($post['job']);
	}
	$e->save();

	return $response->withRedirect('employee');
});

//use post instead to get the information from the forms
$app->post('/employee_del', function($request, $response, $args) {
	$post = $request->getParsedBody();
	$e = EmployeeQuery::create()->findPk($post['emp_id'])
	->delete();

	return $response->withRedirect('employee');
});

//////////////////////
// AJAX Handlers
//////////////////////
$app->add(new Tuupola\Middleware\HttpBasicAuthentication([
    "path" => "/", /* or ["/admin", "/api"] */
    "realm" => "Protected",
    "users" => [
        "user1" => "bored",
        "somebody" => "pass"
    ]
]));
$app->post('/login', 
	function($request, $response, $args) {
		$post = $request->getParsedBody();
		
		$wq = OwnerQuery::create()->findOneByOwnerId($post['owner_id']);
		if($wq==NULL){
			return $response->withJson(["status" => 2]);
		}
		else{
			$success = $wq->login($post['password']);

			if(!$success){
				return $response->withJson(["status" => 0]);
			}
			else{
				$_SESSION['user'] = $post['owner_id'];
				return $response->withJson(
					["status" => 1,
					"owner_id" => $wq->getOwnerId(),
					"name" => $wq->getName()
					]);
			}
		}
		
});

$app->post('/logout', 
	function($request, $response, $args) {
	session_destroy();
	return $response->withJson(["success" => "true"]);		
});




//////////////////////
// App run
//////////////////////

$app->run();