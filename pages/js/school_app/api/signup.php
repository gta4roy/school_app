	<?php
		require("medoo/medoo.php");
		require("MyLogPHP-1.2.1.class.php");
	
		$data = array();
		$log = new MyLogPHP();

		$_POST = json_decode(file_get_contents("php://input"));

		$email    = $_POST->email;
		$pass     = $_POST->pass;
		$username = $_POST->username;
		$city     = $_POST->city;	
		$role     = $_POST->role;
		
		if(empty(trim($email)) || empty(trim($pass)) || empty(trim($username)) || empty(trim($city)) || empty(trim($role)) )
		{
			$data['ret']     = "0";
			$data['error']   = "blank values";
			$data['log']     = "blank input";
			$log->debug("blank input from the user");

		}
		else
		{

		try
		{
	
		$ret = $database->insert("tbl_users", [
			"user_name" => $username,
			"password" => $pass,
			"city"     => $city,
			"role"     => $role,
			"email"    => $email
		]);
	
		}catch(Exception $ex){
			$data['errors'] = $ex->getMessage();
		}
		if($ret == 0){
			$data['message'] = 'failed';
		}else{
			$data['message'] = 'success';
		}	
		$data['ret']     =  $ret;
		$data['error']   =  $database->error()[2];
		$data['log']     =  $database->log();
		$log->debug("Query:".implode("|",$database->log()));
		$log->debug("error".implode("|",$database->error()[2]));

		}

		echo json_encode($data) ;
	
?>
