# LMS-LAMP

A library management system built in LAMP (Linux, Apache, MySQL, PHP).

## Setup

* Clone the repository.
* Start phpMyAdmin, create your database and run `scheme.sql` which is in `schema` directory.
* Create `config.php` in the `config` directory, you can look at `sample.config.php` for help.
* In the home directory, run `composer install` and then `composer dump-autoload`.
> To make a user admin, do it manually through MySQL via phpMyAdmin.

## Run

* Goto the `public` directory and run `php -S locahost:<PORT>`.
* Open a web brower and go to `localhost:<PORT>` to see your LMS.
