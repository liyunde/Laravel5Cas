MultiCAS
===

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Total Downloads][ico-downloads]][link-downloads]

Multi CAS server SSO authentication in Laravel 5.x

this version base on xavrsl/cas v1.2.5 Compatible with the original version usage,thank author.

this version only use on multi diffent domain cas server in same project

## Installation

Require this package in your composer.json and run composer update.

For Laravel 5:

    composer require liyunde/laravel5-multi-cas

After updating composer, add the ServiceProvider to the providers array:

For Laravel 5:

config/app.php

```php
    MultiCas\CasServiceProvider::class,
```
As well as the Facade :
```php
	'Cas'       => MultiCas\Facades\Cas::class,
```

Then publish the package's config using one of those methods :

For Laravel 5 :
```
    $ php artisan vendor:publish
```

Configuration
==

Configuration should be pretty straightforward for anyone who's ever used the phpCAS client. Using the .env file will allow you to have different environments without even touching the cas.php config file. I've added the possibility to easily turn your application into a CAS Proxy, a CAS Service or both. You only need to set the cas_proxy setting to true (if you need to proxy services) and set the cas_service to whatever proxy you want to allow (this is all explained in the config file).

A new config variable (cas_pretend_user) available in the release allows you to pretend to be a selected CAS user. The idea came with the usage of laravel homestead. My application was running on a private network, on a fake domain. The CAS server was not able to redirect to that application. So activating the CAS plugin on that application was not possible, but I needed a user id to query my LDAP and allow/disallow the user in my application. You only need to give it a user id and the application will act just as if you ware logged in with that CAS user.

Usage
==

Authenticate against the CAS server. This should be called before trying to retrieve the CAS user id.

```php
	Cas::authenticate();
	OR
	Cas::default()->authenticate();
```

Then get the current user id this way :

```php
	Cas::getCurrentUser();
	OR
	Cas::user();
	
	Cas::default()->user();
```
