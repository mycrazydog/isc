## Laravel 4 Bootstrap Starter Site

[![Build Status](https://travis-ci.org/snipe/laravel4-starter.svg?branch=master)](https://travis-ci.org/snipe/laravel4-starter)

This is a Laravel 4 Starter Site and it will help you getting started with Laravel 4.
It's based off the great [Laravel Starter Kit](https://github.com/brunogaspar/laravel4-starter-kit)
from [brunogaspar](https://github.com/brunogaspar), with some additional refinements,
bugfixes and a cleaner, more modern UX.

It includes examples on how to use the framework itself and how to use some
packages, like the awesome [Sentry 2](https://github.com/cartalyst/sentry) package.

-----

## Included goodies

* Twitter Bootstrap 3.1.1
* jQuery 1.10.2
* Custom CLI Installer
* Translation-ready with internationalization files
* Custom Error Pages:
	* 403 for forbidden page access
	* 404 for not found pages
	* 500 for internal server errors
	* 503 for the maintenance page
* Back-end
	* User and Group management
	* Manage blog posts and comments
	* Login brute-force prevention via [Sentry 2](https://github.com/cartalyst/sentry) - default lockout is 5 failed login attempts
* Front-end
	* User login, registration, activation and forgot password
	* User account area
	* Blog functionality with comments
	* Contact us page
* Packages included:
	* [Cartalyst Sentry 2 - Authentication and Authorization package](https://github.com/cartalyst/sentry)

-----

## Requirements

- PHP 5.3.7 or later
- MCrypt PHP Extension

-----

## How to Install

### 1) Downloading
#### 1.1) Clone the Repository

	git clone https://github.com/snipe/laravel4-starter your-folder

#### 1.2) Download the Repository

	https://github.com/snipe/laravel4-starter/archive/master.zip

-----

### 2) Install the Dependencies via Composer
##### 2.1) If you don't have composer installed globally

	cd your-folder
	curl -s http://getcomposer.org/installer | php
	php composer.phar install

##### 2.2) For globally composer installations

	cd your-folder
	composer install

-----

### 3) Setup Database

Now that you have the Starter Kit cloned and all the dependencies installed, you need to create a database and update the file `app/config/database.php`.

-----

### 4) Setup Mail Settings

Setup your mail settings by  opening and updating `app/config/mail.php`.

This will be used to send emails to your users, when they register and they request a password reset.

While testing locally, you can set `'pretend' => true,` in `app/config/mail.php` to simulate email being sent.

-----

### 5) Use custom CLI Installer Command

Now, you need to create yourself a user and finish the installation.

Use the following command to create your default user, user groups and run all the necessary migrations automatically.

	php artisan app:install

(Note that [the Travis CI file](https://github.com/snipe/laravel4-starter/blob/master/.travis.yml) skips this step and instead calls the individual setup methods and just inserts the example user, since [the CI build](https://travis-ci.org/snipe/laravel4-starter.svg?branch=master) isn't interactive.)

-----

### 6) Accessing the Administration

To access the administration page, you just need to access `http://your-host/admin` in your browser and it
will redirect you to the login page.

After being authenticated, you will be redirected back to the administration page.

-----

### 7) Brute-force Lockout Settings

The default Sentry setting is to lockout the user for 15 minutes after 5 failed login attempts. To
change these settings, edit your `/vendor/cartalyst/sentry/src/config/config.php` file locally.

-----

### 8) Contact
If you have questions about this project, you can reach me at snipe@snipe.net, or on Twitter at [@snipeyhead](https://twitter.com/snipeyhead).

-----

### LICENSE

> Version 1, December 2009

> Copyright (C) 2009 Philip Sturgeon <email@philsturgeon.co.uk>

 Everyone is permitted to copy and distribute verbatim or modified
 copies of this license document, and changing it is allowed as long
 as the name is changed.

> DON'T BE A DICK PUBLIC LICENSE
> TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION

 1. Do whatever you like with the original work, just don't be a dick.

     Being a dick includes - but is not limited to - the following instances:

	 1a. Outright copyright infringement - Don't just copy this and change the name.
	 1b. Selling the unmodified original with no work done what-so-ever, that's REALLY being a dick.
	 1c. Modifying the original work to contain hidden harmful content. That would make you a PROPER dick.

 2. If you become rich through modifications, related works/services, or supporting the original work,
 share the love. Only a dick would make loads off this work and not buy the original works
 creator(s) a pint.

 3. Code is provided with no warranty. Using somebody else's code and bitching when it goes wrong makes
 you a DONKEY dick. Fix the problem yourself. A non-dick would submit the fix back.
