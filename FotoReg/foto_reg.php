<?php
# вызывается при регистрации авто фотокамерой
# log-файл: \htdocs\foto_reg.txt

	header('Content-type: text/html; charset=utf-8'); 

	$file_name='../logs/foto_reg.txt';
	
	$fp = fopen($file_name, 'a');
	if ($fp) {

		$mytext=date('Ymd H:i:s').' REG: ';
		while( list($key, $value)=each($_REQUEST) ) {
			$mytext.=$key.'='.$value.', ';
		}
	
		if( strlen($mytext)>1 && substr($mytext, -2, 2)==', ' ) {
			$mytext=substr($mytext, 0, strlen($mytext)-2);
		}

		$mytext.=PHP_EOL;

		fwrite($fp, $mytext);
		fclose($fp);
		
	}

	@$LPR_Plate=$_GET['LPR_Plate'];
	@$LPR_Time=$_GET['LPR_Time'];
	@$LPR_Direction=$_GET['LPR_Direction'];
	@$LPR_Passage=$_GET['LPR_Passage'];
	@$IdCamera=$_GET['IdCamera'];

	if(!isset($LPR_Plate)) {
		$LPR_Plate='';
	}
	if(!isset($LPR_Time)) {
		$LPR_Time='';
	}
	if(!isset($LPR_Direction)) {
		$LPR_Direction='';
	}
	if(!isset($LPR_Passage)) {
		$LPR_Passage='';
	}
	if(!isset($IdCamera)) {
		$IdCamera='';
	}

#	Connect to 1C

	ini_set("soap.wsdl_cache_enabled", "0");
	try {

		$SoapClient1C = new SoapClient("http://127.0.0.1:8080/database_name/ws/wsFotoRegistration.1cws?wsdl", array('login'=>'WebService', 'password'=>'passwd'));

	}
	 catch (Exception $e) {
#   	 	echo 'Exception: ',  $e->getMessage(), "<br/>";
		exit('1');
	}

		$params=Array();
		$params['LPR_Plate']=$LPR_Plate;
		$params['LPR_Time']=$LPR_Time;
		$params['LPR_Direction']=$LPR_Direction;
		$params['LPR_Passage']=$LPR_Passage;
		$params['IdCamera']=$IdCamera;

		try {
			$Result = $SoapClient1C->Registration($params);
		}
	 	catch (Exception $e) {
			exit('1');
		}		

		foreach($Result as $line) {
			$mytext.=$line;
			$Return=$line;
		}

		exit($Return);
	
	
?>