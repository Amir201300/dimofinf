<!-- Table of Contents -->
# :notebook_with_decorative_cover: Table of Contents

- [About the Project](#star2-about-the-project)
  * [Tech Stack](#space_invader-tech-stack)
  * [Features](#dart-features)
- [Getting Started](#toolbox-getting-started)
  * [Prerequisites](#bangbang-prerequisites)
  * [Installation](#gear-installation)
- [Usage](#eyes-usage)
- [dashboard link](#dashboard)

  

<!-- About the Project -->
## :star2: About the Project

<div align="center"> 
  <img src="http://emir.life/codescreen.PNG" alt="screenshot" />
</div>


<!-- TechStack -->
### :space_invader: Tech Stack

- PHP 8.0</p>
- Laravel 8.75"
- MySQL MySQL

<!-- Features -->
### :dart: Features

- Feature 1
- Feature 2
- Feature 3
 
<!-- Getting Started -->
## 	:toolbox: Getting Started

<!-- Prerequisites -->
### :bangbang: Prerequisites

- make sure you have Composer installed on your machine.
<a href="https://getcomposer.org/">Composer</a>

- install xampp server php v 8.0 

<!-- Installation -->
### :gear: Installation

Clone the project

```bash
  git clone https://github.com/Amir201300/dimofinf
```

Go to the project directory

```bash
  cd dimofinf
```

Install dependencies

```bash
  composer install
```

Install migration and seeds

```bash
  php artisan project:install
```

Run test

```bash
  php artisan test
```

Start the server

```bash
  php artisan serve
```


<!-- Usage -->
## :eyes: Usage
structure : 
- models 
- controllers
- repository binding with interfaces 

Designs Patterns :  
- singleton design pattern in my helpers

```php
namespace App\Helpers;

class DateHelper
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function customDateFormat($date){
        return date('m/d/Y', strtotime($date));
    }

    public function customTimeFormat($date){
        return date('h:i a', strtotime($date));
    }

    public static function dispose()
    {
        self::$instance = null;
    }
}
```
- factory design pattern to handle my response result
```php
<?php


namespace App\Core;

define('SUCCESS' , 1);
define('ERROR' , 0);

class AppResult
{
    public $operationType = null ;
    public $data = null ;
    public $error = null ;

    private function __construct($operationType , $data , $error){
        $this->operationType = $operationType ;
        $this->data = $data;
        $this->error = $error;
    }

    public static function success($data){
        return new self(SUCCESS,$data,null);
    }

    public static function error($error){
        return new self(ERROR,null,$error);
    }

}
```

<!-- dashboard -->
## dashboard
- to login to project dashboard use this link 
```bash
  <base_url>/Admin/loin
```
email : admin@admin.com 
password : 12345678
