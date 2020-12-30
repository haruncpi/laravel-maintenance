<h1 align="center">Laravel Maintenance</h1>
<p align="center">
    <a href="https://packagist.org/packages/haruncpi/laravel-maintenance"><img src="https://badgen.net/packagist/v/haruncpi/laravel-maintenance" /></a>
    <a href="https://creativecommons.org/licenses/by/4.0/"><img src="https://badgen.net/badge/licence/CC BY 4.0/23BCCB" /></a>
     <a href=""><img src="https://badgen.net/packagist/dt/haruncpi/laravel-maintenance"/></a>
    <a href="https://twitter.com/laravelarticle"><img src="https://badgen.net/badge/twitter/@laravelarticle/1DA1F2?icon&label" /></a>
    <a href="https://facebook.com/laravelarticle"><img src="https://badgen.net/badge/facebook/laravelarticle/3b5998"/></a>
</p>
<h4 align="center">for Laravel 6/7/5</h4>
<p align="center">Maintenance mode package for Laravel that support secret route!</p>

## Documentation
Install
```
composer require haruncpi/laravel-maintenance
```
Replace middleware in `app/Http/Kernel.php`
```php
//\App\Http\Middleware\CheckForMaintenanceMode::class,
\Haruncpi\LaravelMaintenance\Middleware\MaintenanceMode::class,
```

## Usage
This package support all default maintenance mode features with maintenance bypass by secret route.

 
##### Maintenance Bypass - Secret route
```
php artisan down --secret="mysecretkey"
```

##### Now you can bypass by secret route
```
https://example.com/mysecretkey
```
With this secret route, only you can access your website in live mode and the rest of the world get it in maintenance mode.


## Other Packages
- [Laravel User Activity](https://github.com/haruncpi/laravel-user-activity) - Monitor application's user activity.
- [Laravel Log Reader](https://github.com/haruncpi/laravel-log-reader) - Simple and beautiful laravel log reader.
- [Laravel H](https://github.com/haruncpi/laravel-h) - Helper package for Laravel Framework.
- [Laravel Simple Filemanager](https://github.com/haruncpi/laravel-simple-filemanager) - A simple filemanager for Laravel.
- [Laravel Option Framework](https://github.com/haruncpi/laravel-option-framework) - Option framework for Laravel.
