<a href="https://github.com/rilesh-webtech/assignment"> <h1 align="center">XML Task</h1></a></p>

## About

Xml Task is a PHP Laravel project using ([Bootstrap](https://getbootstrap.com/), [Laravel](https://laravel.com/)).

## Table of Contents

* [Requirements](#requirements)
* [Installation](#installation)

<a name="requirements"></a>
## Requirements

Package | Version
--- | ---
[Composer](https://getcomposer.org/)  | V2.2.6+
[Php](https://www.php.net/)  | V8.0.17+
[Mysql](https://www.mysql.com/)  |V 8.0.27+

<a name="installation"></a>
## Installation

> **Warning**
> Make sure to follow the requirements first.

Here is how you can run the project locally:
1. Clone this repo
    ```sh
    git clone https://github.com/rilesh-webtech/assignment.git
    ```

1. Go into the project root directory
    ```sh
    cd assignment
    ```

1. Copy .env.example file to .env file
    ```sh
    cp .env.example .env
    ```
1. Create database `assignment_db` (you can change database name)


1. Go to `.env` file 
    - set database credentials (`DB_DATABASE=assignment_db`, `DB_USERNAME=root`, `DB_PASSWORD=`)
    > Make sure to follow your database username and password

1. Install PHP dependencies 
    ```sh
    composer install
    ```

1. Generate key 
    ```sh
    php artisan key:generate
    ```

1. Run migration
    ```
    php artisan migrate
    ```
    
1. Run seeder
    ```
    php artisan db:seed
    ```
    this command will import dummy data of books:

1. Run server 
   
    ```sh
    php artisan serve
    ```  

1. Visit `localhost:8000` in your favorite browser.     

    > Make sure to follow your Laravel local Development Environment.

 > Let me know if you get in trouble.


1. Run schedule command to store data on every minute 
   
    ```sh
    php artisan schedule:work
    ```  

This is checked current date and find the folder on `public/books` and than check tree folder structure based on Year Month and Day and find the `books.xml` file and import data into database 