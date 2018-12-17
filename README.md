# Laravel Firebase Cloud Messaging

## Instalation
To get the latest version of FCM on your project, require it from "composer":
```bash
$ composer require muhbayu\laravel-firebase-cloud-messaging
```
### Laravel
Register the provider directly in your app configuration file `config/app.php`
```php
'providers' => [
	 // ...
	 MuhBayu\Fcm\FcmServiceProvider::class,
]
```
Publish the package config file using the following command:
```bash
$ php artisan vendor:publish --provider="MuhBayu\Fcm\FcmServiceProvider"
```
### Lumen
Register the provider in your bootstrap app file `boostrap/app.php`
Add the following line in the "Register Service Providers" section at the bottom of the file:
```php
$app->register(MuhBayu\Fcm\FcmServiceProvider::class);
```

### Package Configuration
In your `.env` file, add the server key and the secret key for the Firebase Cloud Messaging:
```env
FCM_LEGACY_KEY=<your_server_Key>
FCM_SENDER_ID=<your_sender_id>
```
## Basic Usage
The following use statements are required for the examples below:
```php
use MuhBayu\Fcm;
```
#### Sending Push Notification
```php
// if you want to send multiple $recipients token must an array 
Fcm::to($recipients)->notification([
	'title' => 'Title Message',
	'body' => 'This is a body message of FCM',
	'click_action' => 'http://yourdomain.com', // optional
	'icon' => 'your_icon', //optional
])->send();
```
If You want to send a FCM to topic, use method 
```php
->topic('/topic/name')
```
#### Notification with Extra Data
If you want to send a FCM with data & notification parameter, you must use extra method :
```php
Fcm::to($recipients)->notification([
	// ...
])->extra([
	'name' => 'Name Data',
	'data' => 'Data test',
])->send();
```

#### Simple Usage
```php
fcm()->send($notification, $data);
```