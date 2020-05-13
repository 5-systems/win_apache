<?php

	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	require_once('../settings.php');
	require_once('../5c_std_lib.php');
	require_once('../5c_files_lib.php');

	date_default_timezone_set('Etc/GMT-3');

	# Settings (change)
	$LogFileName='../logs/messenger/telegram_'.date('Ym').".txt";

	header('Content-Type: text/html; charset=utf-8');

	@$body=file_get_contents("php://input");

	If( !isset($body) ) {
		$body='{"error":"no data"}';	
	}	

	# Write log info
	$fp = fopen($LogFileName, 'a');
	if ($fp) {
	
		$mytext=date('Ymd H:i:s').' ';
		foreach($_REQUEST as $key=>$value) {
			$mytext.=$key.'='.$value.', ';
		}

		$mytext.='body='.$body.PHP_EOL;

		$test = fwrite($fp, $mytext);
		fclose($fp); 
	}

	ini_set("soap.wsdl_cache_enabled", "0");
	
	$SoapClient1C = Null;
	
	try {
		$SoapClient1C = new SoapClient("http://".$http_server.":".$http_server_port."/".trim($publication_path, ' /')."/ws/wsMessenger.1cws?wsdl", array('login'=>$user_login, 'password'=>$user_password));
	}
	catch (Exception $e) {
		echo "0";
	}

	$params=Array();
	$params['body']=$body;

	try {
		$Result = $SoapClient1C->WebHook($params);
		echo "ok";
	}
	catch (Exception $e) {
		$fp = fopen($LogFileName, 'a');
		$error_text='Exception: '.$e->getMessage();
		$test = fwrite($fp, '-33-');
		$test = fwrite($fp, $error_text);
		fclose($fp); 
		exit('1');
	}		

?>
