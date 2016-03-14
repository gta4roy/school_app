	<?php
		require("medoo/medoo.php");
		require("MyLogPHP-1.2.1.class.php");
	
		$data = array();
		$log = new MyLogPHP();

		$_POST = json_decode(file_get_contents("php://input"));

		$email    = $_POST->email;
		$pass     = $_POST->pass;
		
		
		
		if(empty(trim($email)) || empty(trim($pass)))
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

		$ret = $database->select("tbl_users", "user_name","city","role", [
			"AND" => [
				"password[=]" => $pass,
				"email[=]" => $email
			]	
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
