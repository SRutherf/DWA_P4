# DWA_P4

##Live URL
<http://p4.srutherf.me/>

##Demo
<http://screencast.com/t/6ZE0Ijhz/>

##Description
Project 4 for DWA15 at the Harvard Extension School.  Super realistic snowboarding simulator.

##Details
Validation:  The program is able to respond to duplicate emails in register forms, incorrect logins, mismatching passwords, and unauthenticated route access.

The routes are /slope, /shop, /logout, /login, /register.

Create:  Upon a successful user to user interaction (which has a 30% of occuring when loading the slope page) we add a row to the users_x_interactions table.

Read:  When loading the slope and shop pages the program reads the database tables to display correct data.

Update:  When switching between the shop and slope pages we update the database with data input through the forms.  Users can input data directly through the url.  Though they can mess up their own data they are unable to do anything that would affect other users.

Delete:  If the user hits the kill button on the slope page their data is deleted from the database.

##Outside Files
BootStrap: http://getbootstrap.com/
Laravel Facades:  HTML and FORM (Part of Laravel's Illuminate but not included in a standard installation)
Phaser.io Framework: http://phaser.io/

## Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
