<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://backupsys.fikirkasabasi.com/logo.png" width="200"></a></p>


## About BackupSys

BackupSys is a web application for taking backup with schedules. You can schedule backup interval of daily, weekly and monthly. BackupSys based on Laravel. Also some little native Python codes.

## Setup Instructions

### BackupSys minimum requirments:

- [Php 7.3 and above](https://php.net).
- [Mysql 5.7 and above](https://mysql.com).
- [Python 3.6 and above](https://python.org).
- Pip should work with Python 3.
- [Composer](https://getcomposer.org).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

### Install:

```
composer install
```
```
php artisan key:generate
```
```
php artisan migrate
```
```
php artisan db:seed
```
```
sudo apt install python3-pip
```
```
pip install mysql-connector-python
```
```
pip install python-dotenv
```


### Premium Partners

- **[Ozan Uzer](https://ozanuzer.com/)**

## Contributing

Thank you for considering contributing to the BackupSys! [Contact Us](mailto:mail@ozanuzer.com).

## Security Vulnerabilities

If you discover a security vulnerability within BackupSys, please send an e-mail to Ozan Uzer via [mail@ozanuzer.com](mailto:mail@ozanuzer.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
