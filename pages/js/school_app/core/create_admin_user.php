<?php
include("db_connection.php");


class create_admin_user{
	protected static $log;
	protected static $db_conn;
	
	
	protected $admin_index;
	
	protected $admin_name;
	protected $admin_contact;
	protected $admin_address;
	protected $admin_password;
	
	public function create_admin_user(){
		//calculate the index needed 
		self::$log = new MyLogPHP();
		self::$db_conn = new Db();
		
		$result = self::$db_conn->select("select max(admin_id) as 'index' from admin");
		
		if($result != FALSE){
			
			$row = $result[0];
			$index = $row['index'];
			$index++;
			$this->admin_index = $index;
			
			
		}else{
			
			$this->admin_index = 1;
		}
		
		
			
	}
		
	public function add_admin_user($name,$contact = '',$address ='',$password){
		
		
		$this->admin_name = $name;
		$this->admin_contact = $contact;
		$this->admin_password = $password;
		$this->admin_address = $address;
		
		$result = self::$db_conn->insert("insert into admin(admin_id,admin_name,admin_contact,admin_address,admin_password,admin_is_super)
					values (".$this->admin_index.",'".$this->admin_name."','".$this->admin_contact."','".$this->admin_address."','".$this->admin_password."',False)");
		
		if($result === FALSE){
				self::$log->debug("Some Issue in inserting admin ".$this->admin_name);			
		}else{
				self::$log->info("Admin user added ". $this->admin_name);
		}
		return $result;
		
	}
	
	public function validate_master_user($username,$password){
		
		self::$log->info("validating master user ");
		$db = new Db();
		$result = $db->select("select * from admin where admin_name = '".$username."' and admin_password = '".$password."'");
		
		if($result == true){
			
			return true;
		}else{
			return false;
		}
	}
	
}

function test_add_admin_user(){
		$add_user = new create_admin_user();
		
		if($add_user ->add_admin_user("gaurav","7829712286","Century Marvel","@Ceg71201")){
			echo "Test success";
		}else{
			echo "Test Failed ";
		}
}

function test_validate_master_user($username,$password){
	$db = new Db();
	$result = $db->select("select * from admin where admin_name = '".$username."' and admin_password = '".$password."'");
	if($result == true){
		return true;
	}else{
		return false;
	}
}

function test_validate_admin_user($username,$password){
	$db = new Db();
	$result = $db->select("select * from admin where admin_name = '".$username."' and admin_password = '".$password."'");
	if($result == true){
		return true;
	}else{
		return false;
	}
}


//test_add_admin_user();




?>