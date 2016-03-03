<?php
include("../core/create_admin_user.php");
include("../core/response.php");
$admin = new create_admin_user();
$username = $_POST["master_user"];
$password = $_POST["password"];

$name = $_POST['name'];
$contact = $_POST['contact'];
$address = $_POST['address'];
$password_admin = $_POST['password_admin'];

$response = new Response();
$response->api ="validate master user";
$response->type = "Validate";

if($admin->validate_master_user($username, $password) === TRUE){
	
	if($admin ->add_admin_user($name,$contact,$address,$password_admin)){
			$response->result = "admin_added";
			$response->response_code = 200;
		
	}else{
			$response->result = "admin_not_added";
			$response->response_code = 400;
	}
		
}else{
	$response->result = "master_password_wrong";
	$response->response_code = 300;
}

echo json_encode($response);

?>