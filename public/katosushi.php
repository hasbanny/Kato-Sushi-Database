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
$app->get('/log/owner_view', function ($request, $response, $args) {
	$response= $this->view->render($response, 'owner_view.html');
    return $response;
})->setName('owner_view');

////////////////////////////////////////////////////////
//V I E W tables {employee/inventory/finances/suppliers}
/////////////////////////////////////////////////////////

$app->get('/log/owner_view/employee', function($request, $response, $args) {
    $emp = EmployeeQuery::create()->find();
	$response = $this->view->render($response, 'employee.html', [
        "employee" => $emp
		]);
	return $response;
})->setName('employee');

$app->get('/log/owner_view/inventory', function($request, $response, $args) {
    $inv = InventoryQuery::create()->find();
	$response = $this->view->render($response, 'inventory.html', [
        "inventory" => $inv
		]);
	return $response;
})->setName('inventory');

$app->get('/log/owner_view/finances', function($request, $response, $args) {
    $fin = FinancesQuery::create()->find();
	$response = $this->view->render($response, 'finances.html', [
        "finances" => $fin
		]);
	return $response;
})->setName('finances');

$app->get('/log/owner_view/supplier', function($request, $response, $args) {
    $sup = SupplierQuery::create()->find();
	$response = $this->view->render($response, 'supplier.html', [
        "supplier" => $sup
		]);
	return $response;
})->setName('supplier');

$app->get('/log/owner_view/owner', function($request, $response, $args) {
    $own = OwnerQuery::create()->find();
	$response = $this->view->render($response, 'owner.html', [
        "owner" => $own
		]);
	return $response;
})->setName('owner');

///////////////////////////////////////////////
// A D D employee/inventory/finances/suppliers
///////////////////////////////////////////////

$app->get('/log/owner_view/employee_add', function($request, $response, $args) {
	$response = $this->view->render($response, 'employee_add.html');
	return $response;
})->setName('employee_add');

$app->get('/log/owner_view/inventory_add', function($request, $response, $args) {
	$response = $this->view->render($response, 'inventory_add.html');
	return $response;
})->setName('inventory_add');

$app->get('/log/owner_view/supplier_add', function($request, $response, $args) {
	$response = $this->view->render($response, 'supplier_add.html');
	return $response;
})->setName('supplier_add');

$app->get('/log/owner_view/finances_add', function($request, $response, $args) {
	$response = $this->view->render($response, 'finances_add.html');
	return $response;
})->setName('finances_add');

$app->get('/log/owner_view/owner_add', function($request, $response, $args) {
	$response = $this->view->render($response, 'owner_add.html');
	return $response;
})->setName('owner_add');

/////////////////////////////////////////////////////
// U P D A T E employee/inventory/finances/suppliers
////////////////////////////////////////////////////

$app->get('/log/owner_view/employee_update', function($request, $response, $args) {
	$response = $this->view->render($response, 'employee_update.html');
	return $response;
})->setName('employee_update');

$app->get('/log/owner_view/inventory_update', function($request, $response, $args) {
	$response = $this->view->render($response, 'inventory_update.html');
	return $response;
})->setName('inventory_update');

$app->get('/log/owner_view/finances_update', function($request, $response, $args) {
	$response = $this->view->render($response, 'finances_update.html');
	return $response;
})->setName('finances_update');

$app->get('/log/owner_view/supplier_update', function($request, $response, $args) {
	$response = $this->view->render($response, 'supplier_update.html');
	return $response;
})->setName('supplier_update');

$app->get('/log/owner_view/owner_update', function($request, $response, $args) {
	$response = $this->view->render($response, 'owner_update.html');
	return $response;
})->setName('owner_update');

/////////////////////////////////////////////////////
// D E L E T E employee/inventory/finances/suppliers
////////////////////////////////////////////////////

$app->get('/log/owner_view/employee_del', function($request, $response, $args) {
	$response = $this->view->render($response, 'employee_del.html');
	return $response;
})->setName('employee_del');

//////////////////////
// POST
//////////////////////

//use post instead to get the information from the forms
$app->post('/log/owner_view/employee_add', function($request, $response, $args) use ($app){
	$post = $request->getParsedBody();
	$ne = new Employee();
	$ne->setName($post['fullname']);
	$ne->setEmpSsn($post['ssn']);
	$ne->setPhoneNum($post['phone']);
	$ne->setSalary($post['salary']);
	$ne->setJobTitle($post['job']);
	$ne->setHiredBy($post['hired']);
	$ne->save();
	
	return $response->withRedirect('employee');
});

//use post instead to get the information from the forms
$app->post('/log/owner_view/employee_update', function($request, $response, $args) {
	$post = $request->getParsedBody();
	$e = EmployeeQuery::create()->findPk($post['emp_id']);
	if($e != NULL)
	{
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
	}
	
	return $response->withRedirect('employee');
});

//use post instead to get the information from the forms
$app->post('/log/owner_view/employee_del', function($request, $response, $args) {
	$post = $request->getParsedBody();
	$e = EmployeeQuery::create()->findPk($post['emp_id']);
	if($e != NULL){
		$e->delete();
	}
	

	return $response->withRedirect('employee');
});

//use post instead to get the information from the forms
$app->post('/log/owner_view/inventory_add', function($request, $response, $args) use ($app){
	$post = $request->getParsedBody();
	$ne = new Inventory();
	$ne->setItemName($post['itname']);
	$ne->setShipDate($post['ship']);
	$ne->setSuppliedBy($post['supp']);
	$ne->setInStock($post['stock']);
	$ne->setDoneBy($post['done_by']);
	$ne->save();
	
	return $response->withRedirect('inventory');
});

$app->post('/log/owner_view/inventory_update', function($request, $response, $args) {
	$post = $request->getParsedBody();
	$e = InventoryQuery::create()->findPk($post['it_id']);
	if($e != NULL){
		if($post['itname'] != ''){
			$e->setItemName($post['itname']);
		}
		if($post['ship'] != ''){
			$e->setShipDate($post['ship']);
		}
		if($post['supp'] != ''){
			$e->setSupplier($post['supp']);
		}
		if($post['stock'] != ''){
			$e->setInStock($post['stock']);
		}
		if($post['done_by'] != ''){
			$e->setDoneBy($post['done_by']);
		}
		$e->save();
	}
	else{
		echo "item ID does not exist";
	}
	

	//return $response->withRedirect('inventory');
});

//use post instead to get the information from the forms
$app->post('/log/owner_view/finances_add', function($request, $response, $args) use ($app){
	$post = $request->getParsedBody();
	$ne = new Inventory();
	$ne->setItemName($post['itname']);
	$ne->setShipDate($post['ship']);
	$ne->setSupplier($post['supp']);
	$ne->setInStock($post['stock']);
	$ne->save();
	
	return $response->withRedirect('finances');
});

$app->post('/log/owner_view/finances_update', function($request, $response, $args) {
	$post = $request->getParsedBody();
	$e = InventoryQuery::create()->findPk($post['it_id']);
	if($post['itname'] != ''){
		$e->setItemName($post['itname']);
	}
	if($post['ship'] != ''){
		$e->setShipDate($post['ship']);
	}
	if($post['supp'] != ''){
		$e->setSupplier($post['supp']);
	}
	if($post['stock'] != ''){
		$e->setInStock($post['stock']);
	}
	$e->save();

	return $response->withRedirect('inventory');
});

//use post instead to get the information from the forms
$app->post('/log/owner_view/supplier_add', function($request, $response, $args) use ($app){
	$post = $request->getParsedBody();
	$ne = new Supplier();
	$ne->setName($post['sname']);
	$ne->setAddress($post['saddr']);
	$ne->setPhoneNum($post['phone']);
	$ne->save();
	
	return $response->withRedirect('supplier');
});

$app->post('/log/owner_view/supplier_update', function($request, $response, $args) {
	$post = $request->getParsedBody();
	$e = SupplierQuery::create()->findPk($post['sup_id']);
	if($e != NULL){
		if($post['sname'] != ''){
			$e->setName($post['sname']);
		}
		if($post['saddr'] != ''){
			$e->setAddress($post['saddr']);
		}
		if($post['phone'] != ''){
			$e->setPhoneNum($post['phone']);
		}
		$e->save();
	}
	else{
		echo "item ID does not exist";
	}

	return $response->withRedirect('supplier');
});

//use post instead to get the information from the forms
$app->post('/log/owner_view/owner_add', function($request, $response, $args) use ($app){
	$post = $request->getParsedBody();
	$ne = new Owner();
	$ne->setName($post['owname']);
	$ne->setAddress($post['owaddr']);
	$ne->setPhoneNum($post['owphone']);
	$ne->setPasswordHash($ne->setPassword($post['owpass']));
	$ne->save();

	echo $ne->getPasswordHash();
	//return $response->withRedirect('owner');
});

$app->post('/log/owner_view/owner_update', function($request, $response, $args) {
	$post = $request->getParsedBody();
	$e = InventoryQuery::create()->findPk($post['it_id']);
	if($post['itname'] != ''){
		$e->setItemName($post['itname']);
	}
	if($post['ship'] != ''){
		$e->setShipDate($post['ship']);
	}
	if($post['supp'] != ''){
		$e->setSupplier($post['supp']);
	}
	if($post['stock'] != ''){
		$e->setInStock($post['stock']);
	}
	$e->save();

	return $response->withRedirect('owner');
});

//////////////////////
// AJAX Handlers
//////////////////////
$app->add(new Tuupola\Middleware\HttpBasicAuthentication([
    "path" => "/log", /* or ["/admin", "/api"] */
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