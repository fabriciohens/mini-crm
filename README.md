# QuickTech test project

Mini-CRM - A small system to manage companies and their employees.

## Demo

[video demo](https://www.youtube.com/watch?v=n7dNNRWkNNQ)

## Development enviroment used

- [Virtual Box 5.2](https://www.virtualbox.org/)
- [Vagrant](https://www.vagrantup.com/)
- [Laravel Homestead](https://laravel.com/docs/5.6/homestead)
- [PHP 7.1](http://php.net/archive/2018.php#id2018-03-30-2)
- [Composer](https://getcomposer.org/)
- Windows 10 (my pc XD)

## Some libraries/packages used

- [Propaganistas/Laravel-Phone](https://github.com/Propaganistas/Laravel-Phone) - Phone number functionality for Laravel 5.
- [Propaganistas/Laravel-Intl](https://github.com/Propaganistas/Laravel-Intl) - Easy to use internationalization/localization functions for Laravel 5.
- [Laravel BrowserKit Testing](https://github.com/laravel/browser-kit-testing) - Backwards compatibility layer for Laravel 5.3 style "BrowserKit" testing on Laravel 5.6.
- [Laravel Collective - Forms & HTML](https://laravelcollective.com/docs/master/html) - Package to help with the criation of forms.
- [DataTables](https://datatables.net/) - Advanced interaction controls to your HTML tables.
- [Admin-LTE](https://adminlte.io/) - Open source admin dashboard & control panel theme.

## Some of the commands used

- `php artisan make:seed UsersTableSeeder`
- `composer dump-autoload`
- `php artisan db:seed`
- `php artisan make:migration create_companies_table`
- `php artisan migrate`
- `php artisan migrate:refresh --seed`
- `php artisan make:model Company`
- `php artisan make:controller CompanyController --resource`
- `php artisan make:request CompanyRequest`
- `php artisan storage:link`
- `php artisan make:auth`
- `php artisan make:test CompanyTest`
- `php artisan make:test EmployeeDatabaseTest --unit`

## Observations

###### Make *storage/app/public*  accessible from *public*

To acomplish the requirement '**store companies logos in storage/app/public folder and make them accessible from public**' it was used the following command to create a symbolic link: `php artisan storage:link` (it was necessary to start the Homestead box with a command prompt running as admin)

###### Admin-LTE

To install Admin-LTE I had to do:

- `npm install admin-lte --save`
- `npm install`
- change line 49 in node_modules/adminlte/dist/css/AdminLTE.css to: `background: url('~/../img/boxed-bg.jpg') repeat fixed;`
- `npm run dev`

###### Pagination


Requirement: **Use Laravel’s pagination for showing Companies/Employees list, 10 entries per page**

I implemented but removed Laravel's pagination feature since DataTables already provides pagination.
