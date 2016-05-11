# LaraMvcms

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

**Note:** Replace ```:author_name``` ```:author_username``` ```:author_website``` ```:author_email``` ```:package_name``` ```:package_description``` with their correct values in [README.md](README.md) files, then delete this line.

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

## Install

Via Composer

``` bash
$ composer require hlacos/lara-mvcms
```
$ cd public
$ bower install adminlte
$ bower install flag-icon-css
$ bower install responsive-filemanager#9.9.7
$ bower install font-awesome
$ bower install Ionicons
$ bower install jQuery

Add commands to Kernel
\Hlacos\LaraMvcms\Console\Commands\CreateAdminUser::class

config/app.php

providers:
Hlacos\LaraMvcms\LaraMvcmsServiceProvider::class,

#JeroenG\Packager\PackagerServiceProvider::class,
Spatie\LaravelAnalytics\LaravelAnalyticsServiceProvider::class,
Dimsav\Translatable\TranslatableServiceProvider::class,
Hlacos\Attachment5\Attachment5ServiceProvider::class

change
Illuminate\Auth\AuthServiceProvider::class,->
Kbwebs\MultiAuth\AuthServiceProvider::class,

Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,->
Kbwebs\MultiAuth\PasswordResets\PasswordResetServiceProvider::class,

aliases:
'LaravelAnalytics' => 'Spatie\LaravelAnalytics\LaravelAnalyticsFacade',

#php artisan vendor:publish --provider="Spatie\LaravelAnalytics\LaravelAnalyticsServiceProvider"
#php artisan vendor:publish --provider="Hlacos\Attachment5\Attachment5ServiceProvider"

$ php artisan vendor:publish

Set up user models in config/auth.php
https://github.com/Kbwebs/MultiAuth
'multi-auth' => array(
    'admin' => array(
        'driver' => 'eloquent',
        'model' => Hlacos\LaraMvcms\Models\AdminUser::class,
        //'password' => array(
            'email' => 'lara-mvcms::emails.auth.reminder',
        //),
    )
),
'password' => array(
    //'email' => 'emails.auth.reminder',
    'table' => 'password_resets',
    'expire' => 60,
),
'globals' => [
    'user', 'check'
],

php artisan migrate (remove 2014_10_12_000000_create_users_table.php, 2014_10_12_100000_create_password_resets_table.php)

php artisan kbwebs:multi-auth:create-resets-table

Add required middlewares to $routeMiddleware array in Kernel.php
'lara-mvcms.admin' => \Hlacos\LaraMvcms\Http\Middlewares\AdminAuthenticate::class,
'lara-mvcms.guest' => \Hlacos\LaraMvcms\Http\Middlewares\AdminGuest::class,
'lara-mvcms.is-admin' => \Hlacos\LaraMvcms\Http\Middlewares\SetIsAdmin::class,
'lara-mvcms.has-permission' => \Hlacos\LaraMvcms\Http\Middlewares\HasPermission::class,



.env

ANALITYCS_SITE_ID=
ANALYTICS_CLIENT_ID=
ANALYTICS_SERVICE_EMAIL=

CERTIFICATE_NAME=

create attachments folder

##seeds

Add line to database Seeder
$this->call(LaraMvcmsSeeder::class);
or use php artisan db:seed --class=LaraMvcmsSeeder


## Usage

``` php
$skeleton = new League\Skeleton();
echo $skeleton->echoPhrase('Hello, League!');
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## Credits

- [Heiszmann László][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/league/:package_name.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/thephpleague/:package_name/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/thephpleague/:package_name.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/thephpleague/:package_name.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/league/:package_name.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/league/:package_name
[link-travis]: https://travis-ci.org/thephpleague/:package_name
[link-scrutinizer]: https://scrutinizer-ci.com/g/thephpleague/:package_name/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/thephpleague/:package_name
[link-downloads]: https://packagist.org/packages/league/:package_name
[link-author]: https://github.com/:author_username
[link-contributors]: ../../contributors
