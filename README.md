# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax.  [...more](https://lumen.laravel.com/docs).

## Official Documentation of Lumen

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).


# blog-api 
## Dokumentasi blog-api
### Instalasi
    - Instal project ini dalam local anda
    - Lakukan clone dg perintah `$ git clone https://github.com/mohamilin/blog-api.git`
    - Copy env.example dan ganti menjadi .env 
    - Konfigurasikan .env
        - API_KEY = 
        - DB_DATABASE = nama-database (bebas)
        - DB_USERNAME = root 
        - DB_PASSWORD = 
    - untuk mendapatkan API_KEY :
        - Jalankan blog-api dengan perintah `$ php -S localhost:8000 -t public`
        - Klik di browser `http://localhost:8000/key`
        - Copy-paste Key yang anda dapatkan dan letakkan dalam API_KEY di .env
    - Jalankan `http://localhost/phpmyadmin`
    - Setting nama database dalam `http://localhost/phpmyadmin`, sesuaikan nama database dengan .env
    - Dalam tabel **user** pastikan **default** dalam keadaan **null**
    - Catatan : biasanya dalam konfigurasi .env setiap developer memiliki perbedaan

### Menjalankan Route
    - Dalam menjalankan route ini, terlebih dahulu register dan login karena terdapat beberapa route yang memerlukan security berupa Authorization di Headers.
    - Gunakan postman dalam menjalankan route dibawah ini. 
    - Untuk route yang memiliki security api_token, api_token dapat didapatkan setelah login.
    - masukkan api_token di Headers dengan ketentuan :
        - KEY   : Authorization
        - VALUE : bearer api_token

    | No  | Tujuan | Route  | Security  | Reg Format |
    | --- | ------ | -----  | --------  | ---------- |
    |  1  | Register | /signup  |   | username, email, password |
    |  2  | Login  | /signin | api_token | email, password