# LaraMvcms

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

## Install

Add lara-mvcms package:

``` bash
$ composer require hlacos/lara-mvcms
```

### Bower dependencies

Create .bowerrc file contains:
``` bash
{
  "directory": "public/bower_components/"
}
```

Init bower
``` bash
bower init
```

Install dependencies
``` bash
bower install adminlte --save
bower install flag-icon-css --save
bower install responsive-filemanager#9.9.7 --save
bower install font-awesome --save
bower install ionicons --save
bower install jQuery --save
```

### Commands
Add commands to app\Console\Kernel $commands array
```
\Hlacos\LaraMvcms\Console\Commands\CreateAdminUser::class
```

### Middlewares

Add LaraMvcms middlewares to $routeMiddleware array in app\Http\Kernel.php
```
'lara-mvcms.admin' => \Hlacos\LaraMvcms\Http\Middlewares\AdminAuthenticate::class,
'lara-mvcms.guest' => \Hlacos\LaraMvcms\Http\Middlewares\AdminGuest::class,
'lara-mvcms.is-admin' => \Hlacos\LaraMvcms\Http\Middlewares\SetIsAdmin::class,
'lara-mvcms.has-permission' => \Hlacos\LaraMvcms\Http\Middlewares\HasPermission::class,
```

### Service providers

Add LaraMvcms service providers in config/app.php file to the end of the 'providers' array
```
/*
 * Lara-MVCMS depencencies
 */
Spatie\LaravelAnalytics\LaravelAnalyticsServiceProvider::class,
Dimsav\Translatable\TranslatableServiceProvider::class,
Hlacos\Attachment5\Attachment5ServiceProvider::class
```

Add LaraMvcms service provider in config/app.php file before 'Application Service Providers'
```
/*
 * Lara-MVCMS Service Providers
 */
Hlacos\LaraMvcms\LaraMvcmsServiceProvider::class
```

Change Illuminate\Auth\AuthServiceProvider::class in the 'providers' array to
```
Kbwebs\MultiAuth\AuthServiceProvider::class
```

Change Illuminate\Auth\Passwords\PasswordResetServiceProvider::class in the 'providers' array to
```
Kbwebs\MultiAuth\PasswordResets\PasswordResetServiceProvider::class
```

### Aliases
Add aliases in config/app.php to the 'aliases' array
```
'LaravelAnalytics' => Spatie\LaravelAnalytics\LaravelAnalyticsFacade::class
```

### Vendor publish

``` bash
php artisan vendor:publish
```

### Set up users

More information available in https://github.com/Kbwebs/MultiAuth

Set up multi-auth users in config/auth.php example:
```
'multi-auth' => array(
    'admin' => array(
        'driver' => 'eloquent',
        'model' => Hlacos\LaraMvcms\Models\AdminUser::class,
        'email' => 'lara-mvcms::emails.auth.reminder',
    )
),
'password' => array(
    'table' => 'password_resets',
    'expire' => 60,
),
'globals' => [
    'user', 'check'
],
```

### Migrations

Remove default users and password_resets table
``` bash
rm database/migrations/2014_10_12_000000_create_users_table.php
rm database/migrations/2014_10_12_100000_create_password_resets_table.php
```

Add Multiauth password resets table
```
php artisan kbwebs:multi-auth:create-resets-table
```

Than migrate
``` bash
php artisan migrate
```

### Seeds

Add line to database Seeder (database/seeds/DatabaseSeeder.php)
```
$this->call(LaraMvcmsSeeder::class);
```

or use:
``` bash
php artisan db:seed --class=LaraMvcmsSeeder
```

### Dashboard

More informations: https://github.com/spatie/laravel-analytics

Set up google analitycs in the .env file
```
ANALITYCS_SITE_ID=
ANALYTICS_CLIENT_ID=
ANALYTICS_SERVICE_EMAIL=

CERTIFICATE_NAME=
```
create attachments folder

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

Not implemented yet.

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email heiszmann@gmail.com instead of using the issue tracker.

## Credits

- [Heiszmann László][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/league/lara-mvcms.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/thephpleague/lara-mvcms/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/thephpleague/lara-mvcms.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/thephpleague/lara-mvcms.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/league/lara-mvcms.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/league/lara-mvcms
[link-travis]: https://travis-ci.org/thephpleague/lara-mvcms
[link-scrutinizer]: https://scrutinizer-ci.com/g/thephpleague/lara-mvcms/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/thephpleague/lara-mvcms
[link-downloads]: https://packagist.org/packages/league/lara-mvcms
[link-author]: https://github.com/:author_username
[link-contributors]: ../../contributors
