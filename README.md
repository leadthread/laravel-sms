# laravel-sms
[![Latest Version](https://img.shields.io/github/release/leadthread/laravel-sms.svg?style=flat-square)](https://github.com/leadthread/laravel-sms/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://travis-ci.org/leadthread/laravel-sms.svg?branch=master)](https://travis-ci.org/leadthread/laravel-sms)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/leadthread/laravel-sms/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/leadthread/laravel-sms/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/leadthread/laravel-sms/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/leadthread/laravel-sms/?branch=master)
[![Dependency Status](https://www.versioneye.com/user/projects/56f3252c35630e0029db0187/badge.svg?style=flat)](https://www.versioneye.com/user/projects/56f3252c35630e0029db0187)
[![Total Downloads](https://img.shields.io/packagist/dt/leadthread/laravel-sms.svg?style=flat-square)](https://packagist.org/packages/leadthread/laravel-sms)

Laravel SMS is a simple Laravel 5 package for sending messages to different SMS services. 

Currently supported:
- [Plivo](http://plivo.com/)
- [Twilio](http://twilio.com/)

## Installation

Install via [composer](https://getcomposer.org/) - In the terminal:
```bash
composer require leadthread/laravel-sms
```

Install Plivo or Twilio SDK
```bash
composer require plivo/plivo-php:^1.1
# or
composer require twilio/sdk:^4.10
# or
composer require bandwidth/catapult:^0.8.2
```

Now add the following to the `providers` array in your `config/app.php`
```php
LeadThread\Sms\Providers\SmsServiceProvider::class
```

and this to the `aliases` array in `config/app.php`
```php
"Sms" => "LeadThread\Sms\Facades\Sms",
```

Then you will need to run these commands in the terminal in order to copy the config file
```bash
php artisan vendor:publish
```

## Usage
First you must change your config file located at `config/sms.php` with your proper API credentials.

### Sending Messages
You can simply send a message like this:
```php
# Send one text
$message  = "Hello Phone!";
$to       = "+15556667777";
$from     = "+17776665555";
$response = Sms::send($message,$to,$from);
```
```php
# Send many texts
$message  = "Hello Phone!";
$to       = ["+15556667777","+15556667778","+15556667779"];
$from     = "+17776665555";
$response = Sms::sendMany($message,$to,$from);
```
```php
# Send many texts with different messages
$items = [
  ["msg"=>"Hello Rick!", "to"=>"+15556667777","from"=>"+17776665555"],
  ["msg"=>"Hello Tyler!","to"=>"+15556667778","from"=>"+17776665555"],
  ["msg"=>"Hello Karla!","to"=>"+15556667779","from"=>"+17776665555"],
];
$response = Sms::sendArray($items);
```

Dont forget to add this to the top of the file 
```php
//If you updated your aliases array in "config/app.php"
use Sms;
//or if you didnt...
use LeadThread\Sms\Facades\Sms;
```

### Buying and Selling phone numbers
```php
$areacode = '435';
//Search for a number to buy
//The response is different for each SMS service provider. This example shows Plivo.
$response = Sms::searchNumber($areacode);
$number = $response['response']['objects'][0]['number'];

//Buy the number
Sms::buyNumber($number);

//Unrent the number
Sms::sellNumber($number);
```

## Contributing
Contributions are always welcome!
If you would like to have another service added to the list please request it by opening up an issue or sending a pull request
