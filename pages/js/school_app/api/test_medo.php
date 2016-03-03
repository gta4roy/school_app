<?php
	require("medoo/medoo.php");
	
	$database->insert("sample", [
		"first" => "abhijit",
		"second" => "roy"
	]);
	
	$datas = $database->select("sample", "*");
	
	$json_format = json_encode($datas);
	$output = "{\"records\" :".$json_format."}";
	echo $output;

?>
