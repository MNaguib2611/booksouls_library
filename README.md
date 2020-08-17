



<p align="center">
<a href="https://github.com/Elshafeay/booksouls_library"><img src="./public/imgs/LogoMakr_8FEAlV.png" alt="Build Status"></a>
</p>



# Book Souls Library


A Library Web Application using Laravel Php Framework, where users can lease books for a specific period of time.Admins can manage the library by adding,deleing or updating books,book categories ,manage authorized admins and delete or deactivate users.Admins has access to the website stats throught Dashboard

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

What things you need to install the software and how to install them


#### Windows users:
- Download wamp: http://www.wampserver.com/en/
- Download and extract cmder mini: https://github.com/cmderdev/cmder/releases/download/v1.1.4.1/cmder_mini.zip
- Update windows environment variable path to point to your php install folder (inside wamp installation dir) (here is how you can do this http://stackoverflow.com/questions/17727436/how-to-properly-set-php-environment-variable-to-run-commands-in-git-bash)
 

cmder will be refered as console

#### Mac Os, Ubuntu and windows users continue here:
- Create a database locally named `booksouls` utf8_general_ci 
- Download composer https://getcomposer.org/download/
- Pull Laravel/php project from git provider.
- Rename `.env.example` file to `.env`inside your project root and fill the database information.
  (windows wont let you do it, so you have to open your console cd your project root directory and run `mv .env.example .env` )
- Open the console and cd your project root directory
- Run `composer install` or ```php composer.phar install```
- Run `php artisan key:generate` 





### Running the Project
Now the project needs exta steps to run

use the teminal to migrate the tables and seed the data

```
php artisan migrate --seed
```

use teminal start the the development server

```
php artisan serve
```
##### You can now access your project at localhost:8000 :)


run scheduled commands (on Linux)

```
{ ```crontab -e``` }
```
the command that you need to run to open the cronjob file
and then you just need to add the below line at the end of the file
00 00 * * * cd [the-path-to-the-project-directory] && php artisan schedule:run >> /dev/null 2>&1  and make sure to replace "[the-path-to-the-project-directory]" with your own path




## Deployment

### If for some reason your project stop working do these:
- `composer install`
- `php artisan migrate --seed`


## Built With

* [Laravel](https://laravel.com/) - The web Framework for Web Artisans.
* [JQuery](https://jquery.com/) - JavaScript Library.
* [Bootstrap](https://getbootstrap.com/) - CSS library.
* Ajax - Perform an asynchronous HTTP request..
 



## Authors

* **Omar Abdo** - [omarMohamedAbdo](https://github.com/omarMohamedAbdo)
* **Reham Hussein** - [Reham97](https://github.com/Reham97)
* **Mohammed Naguib** - [MNaguib2611](https://github.com/MNaguib2611)
* **Mohamed Elshafeay** - [Elshafeay](https://github.com/Elshafeay)



