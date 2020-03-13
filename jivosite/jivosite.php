<?php

	require_once('../settings.php');
	require_once('../5c_std_lib.php');	
	require_once('../5c_files_lib.php');

	date_default_timezone_set ('Etc/GMT-3');

	// Settings
	$log_file='../logs/jivosite_log.txt';

	@$source=$_REQUEST["source"];
	if( !isset($source) ) $source=''; 
	
	$input=file_get_contents("php://input");

	write_log('blank_line', $log_file);
	write_log($_REQUEST, $log_file);
	write_log($input, $log_file, 'body');

	ini_set('default_socket_timeout', 3);
	ini_set("soap.wsdl_cache_enabled", "0");
	
	try {
	
		$SoapClient1C = new SoapClient("http://".$http_server.":".$http_server_port."/".trim($publication_path, ' /')."/ws/wsoktellexchange.1cws?wsdl", array('login'=>$user_login, 'password'=>$user_password));
		
		if( !isset($SoapClient1C) ) {
			throw new Exception('SOAP-client is not defined');
		}
		
	}
	 
	catch (Exception $e) {
		
		$error_txt='Cannot create soap-client. Exception: '.$e->getMessage();
		write_log($error_txt, $log_file);
		echo $error_txt;
		exit();
		
	}

	$params=Array();
	$params['message']=$input;
	$params['source']=$source;	
		
	$Result_object = $SoapClient1C->Jivosite($params);
	
	$result='{"result":"ok"}';
	foreach($Result_object as $line) {
		write_log($line, $log_file);		
	}
	
	echo $result;	
	unset($SoapClient1C);
  
?>