# laravel-sms
[![Latest Version](https://img.shields.io/github/release/zenapply/laravel-sms.svg?style=flat-square)](https://github.com/zenapply/laravel-sms/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://travis-ci.org/zenapply/laravel-sms.svg?branch=master)](https://travis-ci.org/zenapply/laravel-sms)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/zenapply/laravel-sms/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/zenapply/laravel-sms/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/zenapply/laravel-sms/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/zenapply/laravel-sms/?branch=master)
[![Dependency Status](https://www.versioneye.com/user/projects/56f3252c35630e0029db0187/badge.svg?style=flat)](https://www.versioneye.com/user/projects/56f3252c35630e0029db0187)
[![Total Downloads](https://img.shields.io/packagist/dt/zenapply/laravel-sms.svg?style=flat-square)](https://packagist.org/packages/zenapply/laravel-sms)

Laravel SMS is a simple Laravel 5 package for sending messages to different SMS services. 

Currently supported:
- [Plivo](http://plivo.com/)
- [Twilio](http://twilio.com/)

## Installation

Install via [composer](https://getcomposer.org/) - In the terminal:
```bash
composer require zenapply/laravel-sms
```

Now add the following to the `providers` array in your `config/app.php`
```php
Zenapply\Sms\Providers\SmsServiceProvider::class
```

and this to the `aliases` array in `config/app.php`
```php
"Sms" => "Zenapply\Sms\Facades\Sms",
```

Then you will need to run these commands in the terminal in order to copy the config file
```bash
php artisan vendor:publish
```

## Usage
First you must change your config file located at `config/sms.php`.
Then you can simply send a message like this:
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
use Zenapply\Sms\Facades\Sms;
```

## Contributing
Contributions are always welcome!
If you would like to have another service added to the list please request it by opening up an issue or sending a pull request
