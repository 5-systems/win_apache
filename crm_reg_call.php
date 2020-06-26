<?php

	require_once('settings.php');
	require_once('5c_std_lib.php');
	require_once('5c_files_lib.php');

	//error_reporting(E_ALL);
	//ini_set('display_errors', 1);
	error_reporting(0);
	ini_set('display_errors', 0);	

	header('Content-type: text/html; charset=utf-8'); 
	date_default_timezone_set('Etc/GMT-3');

	$file_name="logs/call_log.txt";


#	Initialization
	if(!isset($CallId)) {
		@$CallId=$_REQUEST['CallId'];
	}

	if(!isset($CallDate)) {
		@$CallDate=$_REQUEST['CallDate'];
	}

	if(!isset($CallerNumber)) {
		@$CallerNumber=$_REQUEST['CallerNumber'];
	}

	if(!isset($CalledNumber)) {
		@$CalledNumber=$_REQUEST['CalledNumber'];
	}

	@$AnswerWaitTime=$_REQUEST['AnswerWaitTime'];
	if(!isset($AnswerWaitTime)) {
		$AnswerWaitTime='';
	}

	@$ReasonCallLoss=$_REQUEST['ReasonCallLoss'];
	if(!isset($ReasonCallLoss)) {
		$ReasonCallLoss='';
	}	

	@$MissedCall=$_REQUEST['MissedCall'];
	if(!isset($MissedCall)) {
		$MissedCall='';
	}

	@$Outcoming=$_REQUEST['Outcoming'];
	if(!isset($Outcoming)) {
		$Outcoming='';
	}
	
	@$ContactInfo=$_REQUEST['ContactInfo'];
	if(!isset($ContactInfo)) {
		$ContactInfo='';
	}

	@$FirstCalledNumber=$_REQUEST['FirstCalledNumber'];
	if(!isset($FirstCalledNumber)) {
		$FirstCalledNumber='';	
	}


	@$FromWeb=$_REQUEST['FromWeb'];
	if(!isset($FromWeb)) {
		$FromWeb='';
	}

	@$WebPage=$_REQUEST['WebPage'];
	if(!isset($WebPage)) {
		$WebPage='';
	}

	@$Comment=$_REQUEST['Comment'];
	if(!isset($Comment)) {
		$Comment='';
	}

	@$Object1CId=$_REQUEST['Object1CId'];
	if(!isset($Object1CId)) {
		$Object1CId='';
	}

	@$Object1CType=$_REQUEST['Object1CType'];
	if(!isset($Object1CType)) {
		$Object1CType='';
	}

	@$CarModel=$_REQUEST['CarModel'];
	if(!isset($CarModel)) {
		$CarModel='';
	}

	@$Email=$_REQUEST['Email'];
	if(!isset($Email)) {
		$Email='';
	}

	@$PhoneStation=$_REQUEST['PhoneStation'];
	if(!isset($PhoneStation)) {
		$PhoneStation='AS';
	}

	@$AdvChannel=$_REQUEST['AdvChannel'];
	if(!isset($AdvChannel)) {
		$AdvChannel='';
	}
	@$session_id=$_REQUEST['session_id'];
	if(!isset($session_id)) {
		$session_id='';
	}

	@$user_id=$_REQUEST['user_id'];
	if(!isset($user_id)) {
		$user_id='';
	}
	
	@$x_roistat=$_REQUEST['X_ROISTAT'];
	if(!isset($x_roistat)) {
		$x_roistat='';
	}

	@$x_roistat_phone=$_REQUEST['X_ROISTAT_PHONE'];
	if(!isset($x_roistat_phone)) {
		$x_roistat_phone='';
	}

	@$x_roistat_marker=$_REQUEST['X_ROISTAT_MARKER'];
	if(!isset($x_roistat_marker)) {
		$x_roistat_marker='';
	}	

	@$Duration=$_REQUEST['Duration'];
	if(!isset($Duration)) {
		$Duration='';
	}

	@$Parts=$_REQUEST['Parts'];
	if(!isset($Parts)) {

		$Parts='<?xml version="1.0" encoding="UTF-8"?><data>';		
		if( strlen($session_id)>0 && strlen($user_id)>0 ) {
			$Parts.='<object type="string" name="session_id">'.$session_id.'</object>'.'<object type="string" name="user_id">'.$user_id.'</object>';
		}

		if( strlen($WebPage)>0 && $WebPage==='JivoSite' ) {
			$Parts.='<object type="string" name="ВидОбращения">Чат</object>';
		}		
		
		if( strlen($Duration)>0 ) {
			$Parts.='<object type="string" name="Duration">'.$Duration.'</object>';
		}

		if( strlen($x_roistat)>0 ) {
			$Parts.='<object type="string" name="x-roistat">'.$x_roistat.'</object>';
			$Parts.='<object type="string" name="x-roistat-phone">'.$x_roistat_phone.'</object>';
			$Parts.='<object type="string" name="x-roistat-marker">'.$x_roistat_marker.'</object>';
		}		
		
		$Parts.='</data>';

	}
	else {

		$Parts=reverse_replace_special_base64($Parts);
		$Parts=base64_decode($Parts);

		$Data_pos=strripos($Parts, '</data>');
		if( $Data_pos!==false ) {
			$Ins_object='<object type="string" name="session_id">'.$session_id.'</object>'.
				    '<object type="string" name="user_id">'.$user_id.'</object>'.
				    '<object type="string" name="Duration">'.$Duration.'</object>';

			$Parts=substr_replace($Parts, $Ins_object, $Data_pos, 0);
		}
	
	}



#	Write data in a file
	$params_log=Array();
	$params_log['CallId']=$CallId;
	$params_log['CallerNumber']=$CallerNumber;
	$params_log['CallDate']=$CallDate;
	$params_log['AnswerWaitTime']=$AnswerWaitTime;
	$params_log['ReasonCallLoss']=$ReasonCallLoss;		
	$params_log['CalledNumber']=$CalledNumber;
	$params_log['ContactInfo']=$ContactInfo;
	$params_log['Comment']=$Comment;
	$params_log['MissedCall']=$MissedCall;
	$params_log['Outcoming']=$Outcoming;
	$params_log['FirstCalledNumber']=$FirstCalledNumber;
	$params_log['FromWeb']=$FromWeb;
	$params_log['WebPage']=$WebPage;
	$params_log['Object1CId']=$Object1CId;
	$params_log['Object1CType']=$Object1CType;
	$params_log['CarModel']=$CarModel;
	$params_log['Email']=$Email;
	$params_log['PhoneStation']=$PhoneStation;
	$params_log['AdvChannel']=$AdvChannel;
	$params_log['user_id']=$user_id;
	$params_log['session_id']=$session_id;
	$params_log['Parts']=$Parts;
	$params_log['X_ROISTAT']=$x_roistat;
	$params_log['X_ROISTAT_PHONE']=$x_roistat_phone;
	$params_log['X_ROISTAT_MARKER']=$x_roistat_marker;

	write_log($params_log, $file_name);


#	Connect to 1C
	ini_set('default_socket_timeout', 10);
	ini_set("soap.wsdl_cache_enabled", "0");


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
		$params['AnswerWaitTime']=$AnswerWaitTime;
		$params['ReasonCallLoss']=$ReasonCallLoss;
        $params['ParsedCallerNumber']='';
		$params['MissedCall']=$MissedCall;
		$params['Outcoming']=$Outcoming;
		$params['ContactInfo']=$ContactInfo;
		$params['FirstCalledNumber']=$FirstCalledNumber;
		$params['FromWeb']=$FromWeb;
		$params['WebPage']=$WebPage;
		$params['Comment']=$Comment;
		$params['Object1CId']=$Object1CId;
		$params['Object1CType']=$Object1CType;
		$params['CarModel']=$CarModel;
		$params['Email']=$Email;
		$params['PhoneStation']=$PhoneStation;
		$params['AdvChannel']=$AdvChannel;
		$params['XML']=$Parts;


		try {
			$Result = $SoapClient1C->ExternalCall($params);
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

