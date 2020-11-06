<?php

	require_once('settings.php');

	header('Content-Type: text/html; charset=utf-8');	

	@$CallId=$_REQUEST['CallId'];
	@$CallerNumber=$_REQUEST['CallerNumber'];	
	@$ParsedCallerNumber=$_REQUEST['ParsedCallerNumber'];
	
	ini_set('default_socket_timeout', 10);
	ini_set("soap.wsdl_cache_enabled", "1");
	ini_set("soap.wsdl_cache_limit", "10");
	ini_set("soap.wsdl_cache_ttl", "100000000");
	ini_set("soap.wsdl_cache", WSDL_CACHE_MEMORY);

	$SoapClient1C = new SoapClient("http://".$http_server.":".$http_server_port."/".trim($publication_path, ' /')."/ws/wsoktellexchange.1cws?wsdl", array('login'=>$user_login, 'password'=>$user_password));


	If(isset($CallerNumber)) {
		
		$params=Array();
		$params['CallId']=$CallId;
		$params['CallerNumber']=$CallerNumber;
		$params['ParsedCallerNumber']=$ParsedCallerNumber;
		$params['OutputFirstNames']='0';

		try{
			$Result = $SoapClient1C->GetCallerData($params);
		}
		catch(Exception $e){
			echo $e->getMessage();
			exit;
		}


		if( gettype($Result)==="object" ) {
			$return_result=trim(strVal($Result->return));
			echo $return_result;
		}

	}


?>

