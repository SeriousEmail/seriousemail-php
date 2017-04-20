<?php

require 'vendor/autoload.php'; //USE THIS IF USING COMPOSER
//require_once('src/SeriousEmail/SeriousEmail.php');  //Update this path if you changed the location of SeriousEmail.php

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
									'email' => 'test1@example.com',
									'custom' => array(
														'Points' => 92,
														'Balance' => 500,
													 )
	
								),
								
								array (
								
									'first_name' => 'Bob',
									'last_name' => 'Smith',
									'email' => 'test2t@example.com',
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
	echo "<br>send_time: " . $send->send_time->date;
	echo "<br>fail_count: " . $send->fail_count;
	echo "<br>success_count: " . $send->success_count;
	echo "<br>campaign_id: " . $send->campaign_id;	
	echo "<br>template_id: " . $send->template_id;
	echo "<br>default_subject: " . $send->default_subject;
	echo "<br>sender_name: " . $send->sender_name;
	echo "<br>sender_email: " . $send->sender_email;
	echo "<br>";
	
	$recipients = $send->recipient_info;
	$count = 0;
	foreach($recipients as $recipient){
		$count++;
		echo "<br><strong>recipient $count</strong>";
		echo "<br>recipient_email: " . $recipient->recipient_email;
		echo "<br>recipient_first_name: " . $recipient->recipient_first_name;
		echo "<br>recipient_last_name: " . $recipient->recipient_last_name;
		echo "<br>";
	}
	
	$errors = $send->errors;
	if(count($errors)){
		echo "<br><strong>Errors</strong>";
		foreach($errors as $error){		
			echo "<br>error: " . $error;
		}
	}
}

if(!empty( $send->curl_info )){

	echo "<br><br><strong>Curl information</strong><br>";
	print "<pre>";
	print_r($send->curl_info);
	print "</pre>";
}