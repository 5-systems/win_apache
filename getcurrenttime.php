<?php

	require_once('settings.php');
	
	ini_set('default_socket_timeout', 10);
	ini_set("soap.wsdl_cache_enabled", "0");

	try {
		$SoapClient1C = new SoapClient("http://".$http_server.":".$http_server_port."/".trim($publication_path, ' /')."/ws/wsoktellexchange.1cws?wsdl", array('login'=>$user_login, 'password'=>$user_password));
	}


	catch (Exception $e) {
   	 	echo 'Exception: '.$e->getMessage()."<br/>";
		exit('1');
	}


	try {
		$Result = $SoapClient1C->GetCurrentTime();
	}


 	catch (Exception $e) {

		echo 'Exception2: '.$e->getMessage()."<br/>";
		exit('1');
	}


	if( gettype($Result)==="object" ) {

		echo $Result->return;

	}
	
?>		

