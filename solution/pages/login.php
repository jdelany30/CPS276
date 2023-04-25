<?php
session_start();

require_once('classes/StickyForm.php');

$stickyForm = new StickyForm();

function init(){
  global $elementsArr, $stickyForm;

  if(isset($_POST['submit'])){
    $postArr = $stickyForm->validateForm($_POST, $elementsArr);
    if($postArr['masterStatus']['status'] == "noerrors"){
      return addData($_POST);
    }
    else{
	  return getForm("<h1>Login</h1>",$postArr);
    }
  }
  else {
      return getForm("<h1>Login</h1>", $elementsArr);
    } 
}

$elementsArr = [
  	"masterStatus"=>[
    "status"=>"noerrors",
    "type"=>"masterStatus"
  ],
	"email"=>[
	"errorMessage"=>"<span style='color: red; margin-left: 15px;'>Email cannot be blank</span>",
    "errorOutput"=>"",
    "type"=>"text",
    "value"=>"email@status.com",
	"regex"=>"email"
	],

    "password"=>[
    "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Password cannot be blank.</span>",
    "errorOutput"=>"",
    "type"=>"text",
    "value"=>"password",
	"regex"=>"password"
    ],  
];

$name = "";

function addData($post){
  	global $elementsArr;  
	if(isset($_POST['submit'])){
		require_once 'classes/PdoMethods.php';
		$pdo = new PdoMethods();

		$sql = "SELECT name, email, password, status FROM admins WHERE email = :email";
		$bindings = array(
			array(':email', $post['email'], 'str')
		);
		$records = $pdo->selectBinded($sql, $bindings);
		if($records == 'error'){
			return "There was an error logging in";
		}
		else{
			if(count($records) != 0){
				if(password_verify($post['password'], $records[0]['password'])){
					session_start();
					$_SESSION['access'] = "accessGranted";
					$_SESSION['status'] = $records[0]['status'];
					$_SESSION['name'] = $records[0]['name'];
					header('location: index.php?page=welcome');
				}
				else {
					return getForm("<h1>Login</h1><p>Cannot login with those credentials</p>", $elementsArr);
				}
			}
	        else {
			return getForm("<h1>Login</h1><p>Cannot login in with those credentials</p>", $elementsArr);
			}
		}
	}
}

function getForm($acknowledgement, $elementsArr){

global $stickyForm;
$form = <<<HTML
    
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<title>login page</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">	
	</head>
	<body>
	<main class="container"> 
			<form method='post' action='index.php?page=login'>
			<div class="form-group">
				<label for="email">Email{$elementsArr['email']['errorOutput']}</label>
				<input type="text" class="form-control" name="email" id="email" value="jdelany@admin.com">
			</div>
			<div class="form-group">
				<label for="password">Password{$elementsArr['password']['errorOutput']}</label>
				<input type="password" class="form-control" name="password" id="password" value="password">
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary" name="submit" id="submit" value="Login" >
			</div>
		</main>
	</body>
	</html>
	
HTML;
return [$acknowledgement, $form];
}
?>

