# TrackerHq

The TrackerHq is a project to keep track of a user's calories intake.
It allow the user to create his ingredients, recipes and have access to his own dashboard where he can view his progression day by day.


Technologies : 
----------------
* Php 7.2.19
* MySQL 5.7.24
* Apache 2.4.35
* Symfony 5.2

Tools :
----------------
* Laragon

Features :
----------------
* Ingredient CRUD
* Recipes CRUD 
* Administration Backend
* Dashboard in SYmfony UX  


Installation
----------------
Clone the repository
````bash
git clone https://github.com/AdrienHq/TrackerHq.git
````

Intall the project & dependencies -> In your project folder. 
````bash
composer install
````
Create the database locally
````bash
php bin/console doctrine:database:create
````
Load the migrations
````bash
php bin/console doctrine:migrations:migrate
````
Launch your laragon local server
````bash
php -S 127.0.0.1:8000 -t public
````

You can now access the project on this url
````bash
http://localhost:8000/
````
