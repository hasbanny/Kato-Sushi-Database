<?php
require '../vendor/autoload.php';
require '../generated-conf/config.php';

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
	
	return $view;
};

//////////////////////
// Routes
//////////////////////

// home page route
$app->get('/', function ($request, $response, $args) {
	$this->view->render($response, 'index.html');
	return $response;
});

//login route
$app->get('/log', function ($request, $response, $args) {
	$this->view->render($response, 'login.html');
	return $response;
});

//owner view route
$app->get('/owner_view', function ($request, $response, $args) {
	$this->view->render($response, 'owner_view.html');
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
	$ne->setName('Hasbanny Irisson');
	$ne->setAddress('3202 Aggie Dr. McAllen, TX');
	$ne->setPhoneNum('9563289652');
	$ne->setPasswordHash($ne->setPassword('bored'));
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
	//$app->$response->redirect($app->urlFor('employee'));
	$emp = EmployeeQuery::create()->find();
	$response= $this->view->render($response, 'employee.html', [
        "employee" => $emp
		]);
    return $response;
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
	/*$emp = EmployeeQuery::create()->find();
	$response= $this->view->render($response, 'employee.html', [
        "employee" => $emp
		]);
    return $response;*/
});

//use post instead to get the information from the forms
$app->post('/employee_del', function($request, $response, $args) {
	$post = $request->getParsedBody();
	$e = EmployeeQuery::create()->findPk($post['emp_id'])
	->delete();
});

//////////////////////
// AJAX Handlers
//////////////////////

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
				return $response->withJson(
					["status" => 1,
					"owner_id" => $wq->getOwnerId(),
					"name" => $wq->getName()
					]);
			}
		}
		
});
//////////////////////
// App run
//////////////////////

$app->run();