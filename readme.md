## Dump the contents of a database

### This repo contains an easy to use class to dump a database using PHP. Currently MySQL is supported. Behind the scenes mysqldump

## Requirements

For dumping MySQL-db's mysqldump should be installed.

## Installation

You can install the package via composer:

    composer require amanatjuwel/db-dump

### Laravel 5.x:

After updating composer, add the ServiceProvider to the providers array in config/app.php

    Amanatjuwel\Contact\DbDumpServiceProvider::class,

### Configuration

    php artisan vendor:publish --provider="Amanatjuwel\DbDump\DbDumpServiceProvider"

This command will publish file and folder in "resources/views/" folder named "vendor/db-dump/index.blade.php" with basic bootstrap css and fontawsome css.

Config your database in .env

	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=xxxxxxxxxxx
	DB_USERNAME=root
	DB_PASSWORD=xxxx


## Usage

### Environment

for localhost 

	from .env set APP_ENV=local 

	from 'config/db-dump.php' set "mysqldump_path" = "PATH_TO_MYSQLDUMP"

for server (.env)

	APP_ENV=production

### Endpoints

index 

	GET localhost:8000/database-backup

create a backup 

	GET localhost:8000/database-backup/create

delete a backup 

	POST localhost:8000/database-backup/delete

### License

This Contact Us From Pakage for Laravel is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)