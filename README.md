# seriousemail-php
A PHP class to help access the Serious.Email API and trigger HTML email sends.

## Getting Started

Download this class and example to help you understand how to trigger email sends at Serious.email.

### Prerequisites

This class requires an account Serious.email.  https://serious.email

```
Give examples
```

### Installing

This API requires that you set up a few things at Seroius.email.

Step 1: Generate a public_api_key and api_secret here:

https://serious.email/account/settings#tab_api-settings

Note the api_secret and keep in a safe place as it will only be revealed once.  In the event you forget it, you'll need to regenerate your keys again.


Step 2: Create a subscribers list here:  https://serious.email/subscribers-manager

Subscribers that you add via this API will be saved to this list.  This enables comprehensive analytics, future sends and data back-up.


Step 3: Create a campaign and note it's ID here:  https://serious.email/campaigns-manager

You will include this ID when using this API to trigger a send.

Use the settings dialog to indicate a default subcriber list, default test subscriber list, sender name and sender email.


Step 4: Create an email template here: https://serious.email/templates-manager

This is the template that will be sent to your remotely added subscribers.


Step 5: Now that you have set-up everything at Serious.email you can start sending emails.  Simply add this class to your PHP project:

require_once('lib/SeriousEmail.php');

Step 6: Use the example provided as a basis for adding your own content.


## Authors

* **Kurt Dommermuth** - *Initial work* - [dommermuth](https://github.com/dommermuth)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

