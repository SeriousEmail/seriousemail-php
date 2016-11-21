<?php

//require 'vendor/autoload.php'; //USE THIS IF USING COMPOSER
require_once('src/SeriousEmail/SeriousEmail.php');  //Update this path if you changed the location of SeriousEmail.php

$api_secret = 'YOUR_API_SECRET';
$se = new SeriousEmail($api_secret);

$data = array(
		'public_api_id' => 'YOUR_PUBLIC_API_KEY', 
		'campaign_id' => 89,
		'template_id' => 442,
		'recipient_info' => array( 
		
								array (
								
									'first_name' => 'Sam',
									'last_name' => 'Lamb',
									'email' => 'success@simulator.amazonses.com',
									'custom' => array(
														'Points' => 92,
														'Balance' => 500,
													 )
	
								),
								
								array (
								
									'first_name' => 'Bob',
									'last_name' => 'Smith',
									'email' => 'success+label1@simulator.amazonses.com',
									'custom' => array(
														'Points' => 500,
														'Balance' => 20,
													 )
								),
							
							),	
							
		
	    );

$send = $se->send($data, 1);  //0 = debugging false

if(isset($send)){
	echo $send->feedback;
}

if(!empty( $send->raw_response )){
	
	echo "<strong>Raw Response</strong>";
	print "<pre";
	print_r($send->raw_response);
	print "</pre>";
}

if(!empty( $send->curl_info )){

	echo "<strong>Curl information</strong>";
	print "<pre";
	print_r($send->curl_info);
	print "</pre>";
}