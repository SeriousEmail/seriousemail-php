<?php
/**
  * This library allows you to quickly and easily send emails through Serious.Email using PHP.
  *
  * @author    Kurt Dommermuth <kurt@serious.email>
  * @copyright 2016 Serious Email
  * @license   https://opensource.org/licenses/MIT The MIT License
  * @version   GIT: <git_id>
*/

/**
  * Interface to the Serious.Email Web API
*/
  
class SeriousEmail
{
	private $version = '1.0.1';
	
	//secret can be retreived from your Serious.Email account - https://serious.email/account/settings#tab_api-settings
	private $api_secret;
	
	//url for triggering remote sends
	private $url = 'https://serious.email/send';

	/**
     * API keys (including $api_secret) issued for account holders at serious.email
     *
    */
	public function __construct($api_secret)
    {
		$this->api_secret = $api_secret;
    }
		
	/**
     * Trigger an email
     *
     *  sends a custom Serious Email template
     *  This requires authentication.
     *  Request type: POST
	 *  @param bool $debug will reveal additional information to help client debug.  Not for use in production environment.
	 *  @param array $data is array of information required to send info.
	 *  
    */
	public function send($data, $debug=0){
		
		//if debug = 1 additiona connection information and retrieved data will displayed
		$data['debug'] = $debug;
		
		//convert $data to json
		$data_string = json_encode($data);
		
		//create signature so we can validate that this is a legitimate request				
		$signature = base64_encode(hash_hmac('sha256', $data_string , $this->api_secret, true));
		
		//establish headers for curl and add signature
		$header = array(
						"Accept: application/json",
						"Content-Length: " . strlen($data_string),
						"signature: " . $signature,
						);
		
		//initialize curl
		$ch = curl_init();
		//set curl header + other curl options
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_ENCODING, "gzip");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		//add $data
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		//url establish as class var
		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		//get a raw response for debugging
		$raw_response = curl_exec($ch);	
		$response = json_decode($raw_response);		

		if(!isset($response)) {
			
			$response = array(
					'success' => 0,
					'feedback' => 'Message failed to send.  Did not reach the server or server error. Try turning on debugging for more info.',
					);
					
			$response = json_decode(json_encode($response));		
		}
		
		if($debug){
			
			$ee = curl_getinfo($ch);
			$response->curl_info = $ee;
		}
		
		return $response;
	}
}