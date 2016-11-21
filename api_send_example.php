<?php


require_once('src/SeriousEmail/SeriousEmail.php');

$api_secret = 'your_api_secret';
$se = new SeriousEmail($api_secret);

$data = array(
		'public_api_id' => 'your_public_api_key', 
		'campaign_id' => 89,
		'template_id' => 442,
		'recipient_info' => array( 
		
								array (
								
									'first_name' => 'Sam',
									'last_name' => 'Lamb',
									'email' => 'test1t@example.com',
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
}