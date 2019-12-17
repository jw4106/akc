##Notes
 - I had very limited time to work on this
 - Was able to set up the DB and blades and POST requests 
 - able to implement lat/long for google API
 - implement a distance formula (thank you stack overflow) 
 - set up routes for POST/GET

##Stack

 - Laravel (Artisan)
 - Blade for Views
 - Ajax, Jquery 
 - HTML/CSS

##instructions

- run composer install 
- config/database.php -> change to proper db 
- create schema 'akc'
- php artisan migrate
- php artisan migrate:fresh --seed
- php artisan key:generate
- php artisan config:cache
- php artisan serve 
