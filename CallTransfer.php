<?php

	require_once('settings.php');
	require_once('5c_std_lib.php');
	require_once('5c_files_lib.php');

	header('Content-type: text/html; charset=utf-8'); 
	date_default_timezone_set('Etc/GMT-3');

	error_reporting(E_ALL);
	ini_set('display_errors', 1);
 
	$file_name="logs/transfer_log.txt";
#	Initialization
	@$CallId=$_REQUEST['CallId'];
	@$CallDate=$_REQUEST['CallDate'];
	@$CallerNumber=$_REQUEST['CallerNumber'];
	@$CalledNumber=$_REQUEST['CalledNumber'];
	@$Json=$_REQUEST['Json'];

	if(!isset($CallId)) {
		$CallId='';
	}
	if(!isset($CallDate)) {
		$CallDate='';
	}
	if(!isset($CallerNumber)) {
		$CallerNumber='';
	}
	if(!isset($CalledNumber)) {
		$CalledNumber='';
	}
	if(!isset($Json)) {
		$Json='';
	}

#	Write data in a file
	$params_log=Array();
	$params_log['CallId']=$CallId;
	$params_log['CallerNumber']=$CallerNumber;
	$params_log['CalledNumber']=$CalledNumber;
	$params_log['CallDate']=$CallDate;
	$params_log['Json']=$Json;

	write_log($params_log, $file_name);

#	Connect to 1C
	ini_set('default_socket_timeout', 10);
	ini_set("soap.wsdl_cache_enabled", "1");
	ini_set("soap.wsdl_cache_limit", "10");
	ini_set("soap.wsdl_cache_ttl", "100000000");
	ini_set("soap.wsdl_cache", WSDL_CACHE_MEMORY);
	
	try {
		$SoapClient1C = new SoapClient("http://".$http_server.":".$http_server_port."/".trim($publication_path, ' /')."/ws/wsoktellexchange.1cws?wsdl", array('login'=>$user_login, 'password'=>$user_password));
	}
	catch (Exception $e) {
   	 	$error_text='Exception: '.$e->getMessage()."<br/>";
		write_log($error_text, $file_name);
		echo $error_text;
		exit('1');
	}

																				
	If(isset($CallId) && isset($CallerNumber)) {

		$params=Array();
		$params['CallId']=$CallId;
		$params['CallDate']=$CallDate;
		$params['CallerNumber']=$CallerNumber;
		$params['CalledNumber']=$CalledNumber;
		$params['Json']=$Json;

		try {
			$Result = $SoapClient1C->CallTransfer($params);
		}
	 	catch (Exception $e) {
   	 		$error_text='Exception: '.$e->getMessage()."<br/>";
			write_log($error_text, $file_name);
			echo $error_text;
			exit('1');
		}		
	}
	else {
		exit('1');
	}

	echo '0';

function reverse_replace_special_base64($input_str) {

	$result=$input_str;
        $result=preg_replace("/EQUALSSIGN/", '=', $result);
        $result=preg_replace("/DIVIDESIGN/", '/', $result);		
        $result=preg_replace("/PLUSSIGN/", '+', $result);
		
        return($result);
}

?>
