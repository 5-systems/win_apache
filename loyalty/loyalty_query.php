<?php
	
	header('Content-Type: text/html; charset=utf-8');
	date_default_timezone_set('Etc/GMT-3');

	require_once('../settings.php');
	require_once('../5c_std_lib.php');	
	require_once('../5c_files_lib.php');

	$log_file='../logs/mobile_log.txt';
	
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	
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
	@$RequestID=$_REQUEST['RequestID'];
	@$Mark=$_REQUEST['Mark'];
	@$Model=$_REQUEST['Model'];
	@$MarkID=$_REQUEST['MarkID'];
	@$ModelID=$_REQUEST['ModelID'];
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
	@$All=$_REQUEST['All'];
	@$Type=$_REQUEST['Type'];
	@$CategoryID=$_REQUEST['CategoryID'];
	@$XML=$_REQUEST['XML'];
	@$Limit=$_REQUEST['Limit'];
	@$ServiceIDs=$_REQUEST['ServiceIDs'];
	@$CarComment=$_REQUEST['CarComment'];
	@$VIN=$_REQUEST['VIN'];
	@$OtherService=$_REQUEST['OtherService'];
	@$DoneePhone=$_REQUEST['DoneePhone'];
	@$AccountID=$_REQUEST['AccountID'];
	@$Volume=$_REQUEST['Volume'];
	@$DoneeEmail=$_REQUEST['DoneeEmail'];
	@$Prices=$_REQUEST['Prices'];
	@$Date=$_REQUEST['Date'];
	@$Datetime=$_REQUEST['Datetime'];
	
	// Initialize variables
	If( !isset($OtherService) ) {
		$OtherService='';	
	}
	If( !isset($ServiceIDs) ) {
		$ServiceIDs='';	
	}
	If( !isset($VIN) ) {
		$VIN='';	
	}
	If( !isset($CarComment) ) {
		$CarComment='';	
	}	
	
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

	If( !isset($RequestID) ) {
		$RequestID='';	
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

	If( !isset($Model) ) {
		$Model='';	
	}

	If( !isset($MarkID) ) {
		$MarkID='';	
	}

	If( !isset($ModelID) ) {
		$ModelID='';	
	}

	If( !isset($Call) ) {
		$Call='';	
	}

	If( !isset($All) ) {
		$All='';	
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
	
	If( !isset($Type) ) {
		$Type='';	
	}
			
	If( !isset($CategoryID) ) {
		$CategoryID='';	
	}
			
	If( !isset($XML) ) {
		$XML='';	
	}
			
	If( !isset($Limit) ) {
		$Limit='';	
	}

	If( !isset($DoneePhone) ) {
		$DoneePhone='';	
	}

	If( !isset($AccountID) ) {
		$AccountID='';	
	}

	If( !isset($Volume) ) {
		$Volume='';	
	}

	If( !isset($DoneeEmail) ) {
		$DoneeEmail='';	
	}

	If( !isset($Prices) ) {
		$Prices=array();
	}

	If( !isset($Date) ) {
		$Date='';	
	}

	If( !isset($Datetime) ) {
		$Datetime='';	
	}	

	If( !isset($IntegrationID) ) {
		$IntegrationID='';
	}

			
	// Write log
	write_log($_REQUEST, $log_file);

	ini_set("soap.wsdl_cache_enabled", "1");
	ini_set("soap.wsdl_cache_limit", "10");
	ini_set("soap.wsdl_cache_ttl", "100000000");
	ini_set("soap.wsdl_cache", 2);
	
	try {
		$SoapClient1C = NULL;

		if( is_null($SoapClient1C) ) {
			$SoapClient1C = new SoapClient("http://".$http_server.":".$http_server_port."/".trim($publication_path, ' /')."/ws/wsloyalty.1cws?wsdl", array('login'=>$user_login, 'password'=>$user_password));
		}
	}
	 
	catch (Exception $e) {
		$error_text='Exception: '.$e->getMessage();
		write_log($error_text, $log_file);
		exit($error_text);
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
	elseif(isset($MethodId) && $MethodId=="loyalty_GetClientProfileByPhone") {
		$params=Array();
		$params['Phone']=$Phone;
		
		$Result = $SoapClient1C->loyalty_GetClient($params);
		$result_str='';
		foreach($Result as $line) {
			$result_str=$line;
		}
		
		$result_arr=array();
		if( strlen($result_str)>0 ) {
			$result_arr=json_decode($result_str, true);
		}

		$result_ClientID='';
		if( is_array($result_arr)
		    && count($result_arr)>1
		    && array_key_exists("ClientID",  $result_arr[1]) ) {

		    $result_ClientID=$result_arr[1]["ClientID"];
		}

		$Result=array("Result"=>"2");
		if( strlen($result_ClientID)>0 ) {
			$params=Array();
			$params['ClientID']=$result_ClientID;		
		
			$Result = $SoapClient1C->loyalty_GetClientProfile($params);
		}
		
	}	
	elseif(isset($MethodId) && $MethodId=="loyalty_GetClientCarOrders") {
		$params=Array();
		$params['ClientID']=$ClientID;
		$params['CarID']=$CarID;
		$params['Phone']=$Phone;
		$params['IntegrationID']=$IntegrationID;
		
		$Result = $SoapClient1C->loyalty_GetClientCarOrders($params);	
	}
	elseif(isset($MethodId) && $MethodId=="loyalty_GetClientCarInfo") {
		$params=Array();
		$params['ClientID']=$ClientID;
		$params['CarID']=$CarID;
		$params['IntegrationID']=$IntegrationID;
		
		$Result = $SoapClient1C->loyalty_GetClientCarInfo($params);	
	}
	elseif(isset($MethodId) && $MethodId=="loyalty_GetClientInfo") {
		$params=Array();
		$params['ClientID']=$ClientID;
		
		$Result = $SoapClient1C->loyalty_GetClientInfo($params);	
	}
	elseif(isset($MethodId) && $MethodId=="loyalty_GetCategories") {
		$params=Array();
		$params['CategoryID']=$CategoryID;
		
		$Result = $SoapClient1C->loyalty_GetCategories($params);	
	}
	elseif(isset($MethodId) && $MethodId=="loyalty_GetClientRequests") {
		$params=Array();
		$params['ClientID']=$ClientID;
		$params['Phone']=$Phone;
		
		$Result = $SoapClient1C->loyalty_GetClientRequests($params);	
	}
	elseif(isset($MethodId) && $MethodId=="loyalty_CancelClientRequest") {
		$params=Array();
		$params['ClientID']=$ClientID;
		$params['Phone']=$Phone;
		$params['RequestID']=$RequestID;
		
		$Result = $SoapClient1C->loyalty_CancelClienRequest($params);	
	}
	elseif(isset($MethodId) && $MethodId=="loyalty_GetClientCarList") {
		$params=Array();
		$params['ClientID']=$ClientID;
		$params['All']=$All;
		$params['IntegrationID']=$IntegrationID;
		
		$Result = $SoapClient1C->loyalty_GetClientCarList($params);	
	}
	elseif(isset($MethodId) && $MethodId=="loyalty_GetClientCarOrder") {
		$params=Array();
		$params['OrderID']=$OrderID;
		$params['Type']=$Type;
		
		$Result = $SoapClient1C->loyalty_GetClientCarOrder($params);	
	}
	elseif(isset($MethodId) && $MethodId=="loyalty_GetClientBonusSum") {
		$params=Array();
		$params['ClientID']=$ClientID;
		
		$Result = $SoapClient1C->loyalty_GetClientBonusSum($params);	
	}
	elseif(isset($MethodId) && $MethodId=="loyalty_GetClientBonusHistory") {
		$params=Array();
		$params['ClientID']=$ClientID;
		
		$Result = $SoapClient1C->loyalty_GetClientBonusHistory($params);	
	}
	elseif(isset($MethodId) && $MethodId=="loyalty_GetServices") {
		$params=Array();
		$params['CategoryID']=$CategoryID;
		$params['CarID']=$CarID;
		$params['Mark']=$Mark;
		$params['Model']=$Model;
		$params['MarkID']=$MarkID;
		$params['ModelID']=$ModelID;
		
		$Result = $SoapClient1C->loyalty_GetServices($params);	
	}
	elseif(isset($MethodId) && $MethodId=="loyalty_GetAllServices") {
		$params=Array();
		$params['CarID']=$CarID;
		$params['MarkID']=$MarkID;
		$params['ModelID']=$ModelID;
		
		$Result = $SoapClient1C->loyalty_GetAllServices($params);	
	}
	elseif(isset($MethodId) && $MethodId=="loyalty_AddClientRequest") {
		
		$XML='<?xml version="1.0" encoding="UTF-8"?><data>';
		
		$XML.='<object type="string" name="ClientID">'.$ClientID.'</object>';
		$XML.='<object type="string" name="Phone">'.$Phone.'</object>';
		$XML.='<object type="string" name="CarID">'.$CarID.'</object>';
		$XML.='<object type="string" name="VIN">'.$VIN.'</object>';
		$XML.='<object type="string" name="CarComment">'.$CarComment.'</object>';
		$XML.='<object type="string" name="OtherService">'.$OtherService.'</object>';
		$XML.='<object type="string" name="ClientName">'.$Name.'</object>';		
		
		$loc_ServiceIDs=array();
		if( is_array($ServiceIDs) ) {
			$loc_ServiceIDs=$ServiceIDs;
		}
		else {
			$loc_ServiceID[]=$ServiceIDs;
		}
		
		reset($loc_ServiceIDs);
		foreach( $loc_ServiceIDs as $key=>$value ) {
			$XML.='<object type="string" name="ServiceIDs">'.$value.'</object>';
		}

		$loc_Prices=array();
		if( is_array($Prices) ) {
			$loc_Prices=$Prices;
		}
		else {
			$loc_Prices[]=$Prices;
		}

		reset($loc_Prices);
		foreach( $loc_Prices as $key=>$value ) {
			$XML.='<object type="string" name="Prices">'.$value.'</object>';
		}			
			
		$XML.='<object type="string" name="BranchID">'.$BranchID.'</object>';
		$XML.='<object type="string" name="Comment">'.$Comment.'</object>';
		$XML.='<object type="string" name="Datetime">'.$Datetime.'</object>';
		$XML.='<object type="string" name="Mark">'.$Mark.'</object>';
		$XML.='<object type="string" name="Model">'.$Model.'</object>';		
		$XML.='<object type="string" name="MarkID">'.$MarkID.'</object>';
		$XML.='<object type="string" name="ModelID">'.$ModelID.'</object>';		
		$XML.='<object type="string" name="IntegrationID">'.$IntegrationID.'</object>';

		if ( array_key_exists('Mobile-Application', getallheaders()) || array_key_exists('Mobile-Application', $_REQUEST) ) {
    			$XML.='<object type="string" name="RequestSource">'.'Mobile-Application'.'</object>';
		}

		$XML.='</data>';
		
		$params=Array();
		$params['XML']=$XML;		
		write_log($XML, $log_file);
		
		$Result = $SoapClient1C->loyalty_AddClientRequest($params);
	}
	elseif(isset($MethodId) && $MethodId=="loyalty_GetCarRecommendations") {
		$params=Array();
		$params['CarID']=$CarID;
		$params['Limit']=$Limit;
		
		$Result = $SoapClient1C->loyalty_GetCarRecommendations($params);	
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
	elseif(isset($MethodId) && $MethodId=="loyalty_GiveBonus") {

		$params=Array();
		$params['ClientID']=$ClientID;
		$params['DoneePhone']=$DoneePhone;
		$params['AccountID']=$AccountID;
		$params['Volume']=$Volume;
		$params['DoneeEmail']=$DoneeEmail;
	
		$Result = $SoapClient1C->loyalty_GiveBonus($params);	
	}
	elseif(isset($MethodId) && $MethodId=="loyalty_GetBookingTimes") {
	
		$XML='<?xml version="1.0" encoding="UTF-8"?><data>';
		
		$XML.='<object type="string" name="Date">'.$Date.'</object>';
		$XML.='<object type="string" name="BranchID">'.$BranchID.'</object>';
		
		$loc_ServiceIDs=array();
		if( is_array($ServiceIDs) ) {
			$loc_ServiceIDs=$ServiceIDs;
		}
		else {
			$loc_ServiceIDs[]=$ServiceIDs;
		}
		
		reset($loc_ServiceIDs);
		foreach( $loc_ServiceIDs as $key=>$value ) {
			$XML.='<object type="string" name="ServiceIDs">'.$value.'</object>';
		}
		
		$XML.='<object type="string" name="ClientID">'.$ClientID.'</object>';
		$XML.='<object type="string" name="CarID">'.$CarID.'</object>';
		$XML.='<object type="string" name="VIN">'.$VIN.'</object>';

		$XML.='</data>';	
	
		$params=Array();
		$params['XML']=$XML;

		$Result = $SoapClient1C->loyalty_GetBookingTimes($params);	
	}		
	
	unset($SoapClient1C);

	write_log('Finish '.$MethodId.' Result '.gettype($Result), $log_file);
	
	foreach($Result as $line) {
		$result=$line;
		$result=str_replace("\t", ' ', $result);
		$result=str_replace("\r", ' ', $result);
		$result=str_replace("\n", ' ', $result);

		write_log($result, $log_file);
		echo $result;			
	}
		
?>
