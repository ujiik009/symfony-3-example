symfony-example
===============

A Symfony project created on February 22, 2018, 3:02 am.
# symfony-3-example


### install symfony version 3.6
requirement php 5.6
[link symfony](https://symfony.com/doc/3.4/setup.html)
![logo](https://symfony.com/images/v5/logos/sf-positive.svg)
### Installing & Setting up the Symfony Framework
    php -r "file_put_contents('symfony', file_get_contents('https://symfony.com/installer'));"
    move symfony c:\xampp\bin\php
    cd c:\xampp\bin\php
    (echo @ECHO OFF & echo php "%~dp0symfony" %*) > symfony.bat
    symfony

### create project
    symfony new <project_name> <version>
    symfony new myproject 3.4
### command generate entity
    command : php bin/console doctrine:generate:entity
### command create schema
	command : php bin/console doctrine:schema:update --force