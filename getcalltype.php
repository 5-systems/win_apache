<?php

	require_once('settings.php');
	require_once('5c_std_lib.php');
	require_once('5c_files_lib.php');
	
	header('Content-Type: text/html; charset=utf-8');	

	$file_name="logs/getcalltype_log.txt";

	@$CallerNumber=$_REQUEST['CallerNumber'];

	write_log('blank_line', $file_name);
	write_log($_REQUEST, $file_name);
	
	ini_set('default_socket_timeout', 4);
	ini_set("soap.wsdl_cache_enabled", "1");
	ini_set("soap.wsdl_cache_limit", "10");
	ini_set("soap.wsdl_cache_ttl", "100000000");
	ini_set("soap.wsdl_cache", WSDL_CACHE_MEMORY);

	try {
		$SoapClient1C = new SoapClient("http://".$http_server.":".$http_server_port."/".trim($publication_path, ' /')."/ws/wsoktellexchange.1cws?wsdl", array('login'=>$user_login, 'password'=>$user_password));
	}
	catch(Exception $e) {
		$error_message=strVal($e->getMessage());
		write_log($error_message, $file_name);
		exit;
	}	

	If(isset($CallerNumber)) {
		$params=Array();
		$params['CallerNumber']=$CallerNumber;
		
		try{
			$Result = $SoapClient1C->GetCallType($params);
		}
		catch(Exception $e) {
			$error_message=strVal($e->getMessage());
			write_log($error_message, $file_name);
			exit;
		}


		if( gettype($Result)==="object" ) {
			$return_result=trim(strVal($Result->return));
			write_log('result='.$return_result, $file_name);
			echo $return_result;
		}

	}


?>

