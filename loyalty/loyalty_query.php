<?php
	
	header('Content-Type: text/html; charset=utf-8');
	date_default_timezone_set('Etc/GMT-3');
	
	require_once('../5c_files_lib.php');

	$log_file='../logs/mobile_log.txt';
	
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	$host_ip='';
	if( array_key_exists('SERVER_ADDR', $_SERVER) ) {
			$host_ip=$_SERVER['SERVER_ADDR'];
	}

	$host_port='';
	if( array_key_exists('SERVER_PORT', $_SERVER) ) {
			$host_port=$_SERVER['SERVER_PORT'];
	}
	
	@$MethodId=$_REQUEST['Method'];
	@$CodeString=$_REQUEST['CodeString'];
	@$ShortCode=$_REQUEST['ShortCode'];
	@$Promocode=$_REQUEST['Promocode'];
	@$ClientID=$_REQUEST['ClientID'];
	@$Phone1=$_REQUEST['Phone1'];
	@$Phone2=$_REQUEST['Phone2'];
	@$Phone3=$_REQUEST['Phone3'];
	@$Email=$_REQUEST['Email'];
	@$Birthday=$_REQUEST['Birthday'];
	@$Verbosity=$_REQUEST['Verbosity'];
	@$BranchID=$_REQUEST['BranchID'];
	@$Comment=$_REQUEST['Comment'];
	@$OrderID=$_REQUEST['OrderID'];
	@$Mark=$_REQUEST['Mark'];
	@$Call=$_REQUEST['Call'];
	@$Sms=$_REQUEST['Sms'];
	@$Push=$_REQUEST['Push'];
	@$Phone=$_REQUEST['Phone'];
	@$Name=$_REQUEST['Name'];
	@$MessageID=$_REQUEST['MessageID'];
	@$MarketingProgram=$_REQUEST['MarketingProgram'];
	@$ValidityPeriod=$_REQUEST['ValidityPeriod'];
	@$WorkID=$_REQUEST['WorkID'];
	@$CarID=$_REQUEST['CarID'];
	@$Sold=$_REQUEST['Sold'];
	@$LastName=$_REQUEST['LastName'];
	@$FirstName=$_REQUEST['FirstName'];
	@$MiddleName=$_REQUEST['MiddleName'];
	@$Sex=$_REQUEST['Sex'];
	
	// Initialize variables
	If( !isset($MarketingProgram) ) {
		$MarketingProgram='';	
	}	
	
	If( !isset($ValidityPeriod) ) {
		$ValidityPeriod='';	
	}	
	
	If( !isset($CodeString) ) {
		$CodeString='';	
	}	
	
	If( !isset($ShortCode) ) {
		$ShortCode='';	
	}	

	If( !isset($ClientID) ) {
		$ClientID='';	
	}	
	
	If( !isset($Phone1) ) {
		$Phone1='';	
	}

	If( !isset($Phone2) ) {
		$Phone2='';	
	}

	If( !isset($Phone3) ) {
		$Phone3='';	
	}	

	If( !isset($Email) ) {
		$Email='';	
	}
	
	If( !isset($Birthday) ) {
		$Birthday='';	
	}

	If( !isset($BranchID) ) {
		$BranchID='';	
	}

	If( !isset($Comment) ) {
		$Comment='';	
	}

	If( !isset($Mark) ) {
		$Mark='';	
	}

	If( !isset($Call) ) {
		$Call='';	
	}

	If( !isset($Sms) ) {
		$Sms='';	
	}

	If( !isset($Push) ) {
		$Push='';	
	}

	If( !isset($Phone) ) {
		$Phone='';	
	}

	If( !isset($Name) ) {
		$Name='';	
	}

	If( !isset($MessageID) ) {
		$MessageID='';	
	}			
	
	If( !isset($WorkID) ) {
		$WorkID='';	
	}

	If( !isset($CarID) ) {
		$CarID='';	
	}
			
	If( !isset($Sold) ) {
		$Sold='';	
	}

	If( !isset($LastName) ) {
		$LastName='';	
	}

	If( !isset($FirstName) ) {
		$FirstName='';	
	}

	If( !isset($MiddleName) ) {
		$MiddleName='';	
	}

	If( !isset($Sex) ) {
		$Sex='';	
	}
			
	// Write log
	write_log($_REQUEST, $log_file);

	ini_set("soap.wsdl_cache_enabled", "0");
	try {
		$SoapClient1C = NULL;

		if( is_null($SoapClient1C) ) {
			$SoapClient1C = new SoapClient("http://127.0.0.1:8080/database_name/ws/wsloyalty.1cws?wsdl", array('login' => 'WebService', 'password' => 'passwd'));
		}
	}
	 
	catch (Exception $e) {
		$error_text='Exception: '.$e->getMessage();
		write_log($error_text, $log_file);
		exit('1');
	}
	
	$Result = Array();
	If(isset($MethodId) && $MethodId=="loyalty_GetCurrentTime") {
		$params=Array();						
		$Result = $SoapClient1C->loyalty_GetCurrentTime();	
	}
	elseif(isset($MethodId) && $MethodId=="loyalty_GetClientProfile") {
		$params=Array();
		$params['ClientID']=$ClientID;
		
		$Result = $SoapClient1C->loyalty_GetClientProfile($params);	
	}
	elseif(isset($MethodId) && $MethodId=="loyalty_UpdateClientProfile") {
		$params=Array();
		$params['ClientID']=$ClientID;
		$params['Phone1']=$Phone1;
		$params['Phone2']=$Phone2;
		$params['Phone3']=$Phone3;
		$params['Email']=$Email;
		$params['Birthday']=$Birthday;
		$params['Call']=$Call;
		$params['Sms']=$Sms;
		$params['Push']=$Push;
		$params['Name']=$Name;
		$params['LastName']=$LastName;
		$params['FirstName']=$FirstName;
		$params['MiddleName']=$MiddleName;
		$params['Sex']=$Sex;
				
		$Result = $SoapClient1C->loyalty_UpdateClientProfile($params);	
	}
	elseif(isset($MethodId) && $MethodId=="loyalty_GetClientCars") {
		$params=Array();
		$params['ClientID']=$ClientID;
		$params['Verbosity']=$Verbosity;		
		
		$Result = $SoapClient1C->loyalty_GetClientCars($params);	
	}
	elseif(isset($MethodId) && $MethodId=="ourCompany_GetBranches") {
		$Result = $SoapClient1C->ourCompany_GetBranches();	
	}
	elseif(isset($MethodId) && $MethodId=="loyalty_RegisterRequest") {

		$params=Array();
		$params['ClientID']=$ClientID;
		$params['BranchID']=$BranchID;
		$params['Comment']=$Comment;	
		$params['WorkID']=$WorkID;	

		$Result = $SoapClient1C->loyalty_RegisterRequest($params);	
	}
	elseif(isset($MethodId) && $MethodId=="loyalty_GetClientPoints") {
		$params=Array();
		$params['ClientID']=$ClientID;
		$params['Verbosity']=$Verbosity;		
		
		$Result = $SoapClient1C->loyalty_GetClientPoints($params);	
	}	
	elseif(isset($MethodId) && $MethodId=="loyalty_GetOrdersForSurvey") {
		$params=Array();
		$params['ClientID']=$ClientID;
		$Result = $SoapClient1C->loyalty_GetOrdersForSurvey($params);	
	}	
	elseif(isset($MethodId) && $MethodId=="loyalty_RegisterClientReply") {
		$params=Array();
		$params['ClientID']=$ClientID;
		$params['OrderID']=$OrderID;
		$params['Comment']=$Comment;
		$params['Mark']=$Mark;		
				
		$Result = $SoapClient1C->loyalty_RegisterClientReply($params);	
	}
	elseif(isset($MethodId) && $MethodId=="loyalty_ClientOpenedMessage") {
		$params=Array();
		$params['OrderID']=$OrderID;
		$params['ClientID']=$ClientID;
		$params['MessageID']=$MessageID;	
				
		$Result = $SoapClient1C->loyalty_ClientOpenedMessage($params);	
	}
	elseif(isset($MethodId) && $MethodId=="loyalty_GetClient") {
		$params=Array();
		$params['Phone']=$Phone;
				
		$Result = $SoapClient1C->loyalty_GetClient($params);	
	}
	elseif(isset($MethodId) && $MethodId=="loyalty_SendPromoCode") {
		$params=Array();
		$params['ClientID']=$ClientID;
		$params['Promocode']=$Promocode;
				
		$Result = $SoapClient1C->loyalty_SendPromocode($params);	
	}
	elseif(isset($MethodId) && $MethodId=="loyalty_GetPromocode") {
		$params=Array();
		$params['ClientID']=$ClientID;		
		$Result = $SoapClient1C->loyalty_GetPromocode($params);	
	}	
	elseif(isset($MethodId) && $MethodId=="loyalty_GetPromocodeForFriend") {
		$params=Array();
		$params['ClientID']=$ClientID;		
		$Result = $SoapClient1C->loyalty_GetPromocodeForFriend($params);	
	}
	elseif(isset($MethodId) && $MethodId=="loyalty_RegisterRequestNewClient") {

		$params=Array();
		$params['Name']=$Name;
		$params['Phone']=$Phone;
		$params['BranchID']=$BranchID;
		$params['Comment']=$Comment;	
		$params['WorkID']=$WorkID;	

		$Result = $SoapClient1C->loyalty_RegisterRequestNewClient($params);	
	}		
	elseif(isset($MethodId) && $MethodId=="GivenPromocode") {

		$params=Array();
		$params['MarketingProgram']=$MarketingProgram;
		$params['Promocode']=$Promocode;
		$params['ValidityPeriod']=$ValidityPeriod;	

		$Result = $SoapClient1C->GivenPromocode($params);	
	}
	elseif(isset($MethodId) && $MethodId=="loyalty_UpdateCarData") {

		$params=Array();
		$params['ClientID']=$ClientID;
		$params['CarID']=$CarID;
		$params['Sold']=$Sold;	

		$Result = $SoapClient1C->loyalty_UpdateCarData($params);	
	}		
	elseif(isset($MethodId) && $MethodId=="loyalty_GetWorks") {
		$Result = $SoapClient1C->loyalty_GetWorks();	
	}		
		
	
	unset($SoapClient1C);

	write_log('Finish '.$MethodId.' Result '.gettype($Result), $log_file);
	
	foreach($Result as $line) {
		$result=$line;
		$result=str_replace("\t", ' ', $result);
		$result=str_replace("\r", ' ', $result);
		$result=str_replace("\n", ' ', $result);

		echo $result;			
	}
		
?>
