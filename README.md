# seriousemail-php

This is a PHP class to help access the Serious.Email API.  The Serious.Email API leverages Serious Email's HTML email templating system and analytics while allowing you to trigger sends from your own server.  You may send one or more emails simutaneously and as many emails as your account allows.  

## Getting Started

[Download](https://github.com/dommermuth/seriousemail-php/archive/master.zip) this package (example included) to help you trigger email sends at Serious.email.

### Prerequisites

This class requires an account Serious.email.  https://serious.email

### Installing

This API requires that you set up a few things at Serious.email.

**Step 1: Generate a public_api_key and api_secret**

https://serious.email/account/settings#tab_api-settings

*Note the api_secret and keep in a safe place as it will only be revealed once.  In the event you forget it, you'll need to regenerate your keys again.*


**Step 2: Create a subscribers list**

https://serious.email/subscribers-manager

Subscribers that you add via this API will be saved to this list.  This enables comprehensive analytics, future sends and data back-up.


**Step 3: Create a campaign and note it's ID**

https://serious.email/campaigns-manager

You will include this ID when using this API to trigger a send.

Use the settings dialog to indicate a default subcriber list, default test subscriber list, sender name and sender email.


**Step 4: Create an email template**

https://serious.email/templates-manager

This is the template that will be sent to your remotely added subscribers.


**Step 5: [Download](https://github.com/dommermuth/seriousemail-php/archive/master.zip) this class and add it to your project.**



**Step 6: Use the example provided as a basis for adding your own content.**

Now that you have set-up everything at Serious.email you can start sending emails.  Simply add this class to your PHP project:

```
<?php

require_once('lib/SeriousEmail.php');

$api_secret = 'your_api_secret';
$se = new SeriousEmail($api_secret);

//an example of adding and sending to 2 subscribers...
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

$send = $se->send($data);

if(isset($send)){
	echo $send->feedback;
}
```
**'custom'** data can be sent via the custom array.  You can include as much custom data as you'd like.  Populating your template with this data is easy.  You'd simply wrap the array index name in double percentage signs and include it in your Serious Email template.

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

```

## Authors

* **Kurt Dommermuth** [dommermuth](https://github.com/dommermuth)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

