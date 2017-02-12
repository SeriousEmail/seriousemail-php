# seriousemail-php

This is a PHP class to help access the Serious.Email API.  The Serious.Email API leverages Serious Email's HTML email templating system and analytics while allowing you to trigger sends from your own server.  You may send one or more emails simutaneously and as many emails as your account allows. 

### Demo

You can see and test the Serious Email API here:  [DEMO](https://serious.email/api-demo)

### Prerequisites

This class requires an account Serious.email.  https://serious.email

## Getting Started

You can install this package via Composer or manually.  

**Composer**

<<<<<<< HEAD
https://serious.email/account/settings-api
=======
Add SeriousEmail to your composer.json file. 
>>>>>>> 8606751e0dd07053902a6d1c87a08383da81e887

```
{
  "require": {
    "seriousemail/seriousemail-php": "dev-master"
  }
}

```
At the top of your PHP script require the autoloader:

```
require 'vendor/autoload.php';

```

**Manually**

If you're not using composer, you can [Download](https://github.com/dommermuth/seriousemail-php/archive/master.zip) this package (example included) to help you trigger email sends at Serious.email.

### Instructions

This API requires that you set up a few things at Serious.email.

1. **Generate a public_api_key and api_secret**

  https://serious.email/account/settings#tab_api-settings

  *Note the api_secret and keep in a safe place as it will only be revealed once.  In the event you forget it, you'll need to regenerate your keys again.*


2. **Create a subscribers list**

  https://serious.email/subscribers-manager

  Subscribers that you add via this API will be saved to this list.  This enables comprehensive analytics, future sends and data back-up.


3. **Create a campaign and note it's ID**

  https://serious.email/campaigns-manager

  You will include this ID when using this API to trigger a send.

  Use the settings dialog to indicate a default subcriber list, default test subscriber list, sender name and sender email.


4. **Create an email template and note it's ID**

  https://serious.email/templates-manager

  This is the template that will be sent to your remotely added subscribers.


5. **Use the example provided as a basis for adding your own content.**

  Now that you have set-up everything at Serious.email and you've installed this package - you can start sending emails.  Below is an example script for accessing the API and sending an email:

  ```
<?php

//require 'vendor/autoload.php'; //use this if installed via Composer.
require_once('lib/SeriousEmail/SeriousEmail.php'); //manual installation

$api_secret = 'YOUR_API_SECRET';
$se = new SeriousEmail($api_secret);

//an example of adding and sending to 2 subscribers...
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
							'email' => 'test2@example.com',
							'custom' => array(
									'Points' => 500,
									'Balance' => 20,
									)
						),							
					),
	    );

$send = $se->send($data);

if(isset($send)){
	echo $send->feedback;
}
  ```

  **api_secret** is required. Please do not expose your api_secret.

  **public_api_key** is required.  This gets passed in your $data array.

  **campaign_id** is required.  You get this from your account at Serious.email. This gets passed in your $data array.

  **template_id** is required.  You get this from your acccount at Serious.email. This gets passed in your $data array.

  **recipient_info** is required.  At least one recipient must be added to **recipient_info**.  You can add as many as your account allows.  **recipient_info** must include an **'email'** address, but all other information is optional.  If you wish to personalize your template with the **first_name** or **last_name** you simply include `%%first_name%%` and/or `%%last_name%%` in your template. This gets passed in your $data array.  This is also true for **'custom'** data.

  **'custom'** data can be sent.  You can include as much custom data as you'd like. Populating your template with this data is easy.  You'd simply wrap the array index name in double percentage signs and include it in your Serious Email template. 

  For example:

  ```
<head>

<title>An example of how to populate a template with dynamic (custom) data</title>

</head>

<body>

<p>You have %%Points%% and your balance is %%Balance%%.</p>

</body>
  ```

### Debugging

Turn on debugging for feedback as to what is happening with your call to the Serious.Email API

```
$send = $se->send($data, 1);

if(isset($send)){
    echo $send->feedback;
}

```

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

---



<a href="https://serious.email">
  <img src="https://serious.email/images/logo.svg" width="100%" height="28">
</a>

