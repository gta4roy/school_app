<?php
	include("../core/create_admin_user.php");
	include("../core/response.php");
 	$admin = new create_admin_user();
	$username = $_POST["master_user"];
  	$password = $_POST["password"];
 	$response = new Response();
 	$response->api ="validate master user";
 	$response->type = "Validate";
	
	if($admin->validate_master_user($username, $password) === TRUE){
		$response->result = "OK";
		$response->response_code = 200;
	}else{
		$response->result = "FAIL";
		$response->response_code = 0;
	}

	echo json_encode($response);

?>