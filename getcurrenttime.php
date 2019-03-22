<?php
	
	ini_set('default_socket_timeout', 10);

	ini_set("soap.wsdl_cache_enabled", "0");

	try {
		$SoapClient1C = new SoapClient("http://127.0.0.1:8080/database_name/ws/wsoktellexchange.1cws?wsdl", array('login'=>'WebService', 'password'=>'passwd'));
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

