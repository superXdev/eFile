# eFile - Sistem Pengelolaan File

Sistem pengelolaan file sederhana berbasis website, dibangun dengan framework CodeIgniter 4 dan template AdminLTE 2

![App Screenshot](https://github.com/superXdev/eFile/blob/main/ss.png?raw=true)

## Install

```bash
cp env .env / copy env .env
php spark install

```

## Server Requirements

PHP version 7.4 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
