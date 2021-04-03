## extract project
right click on be-flip.zip then click extract to specified project or extract on currently directory project.

## run composer
open terminal typing this command 
"composer update && composer install"

## setting .env
- copy file .env.example to .env
- change "DB_DATABASE=laravel" to "DB_DATABASE=db_flip"

## make database
create database with file name db_flip.

## clear cache project
write this one by one to clear cache 
1. "php artisan config:clear"
2. "php artisan route:clear"
3. "php artisan view:clear"
4. "php artisan config:cache"

## generate new key
write this on terminal / cmd on current directory project 
"php artisan key:generate"

## migration database
write this on terminal / cmd on current directory project 
"php artisan migrate"

## run project
write this on terminal / cmd on current directory project 
"php artisan serve"

## POST
fill in data on input Disbursement Form, then click submit, then click "OK"

## GET
click button on left table namely "Set Status" to change / update the data, then click "OK" , and you will see that the "Status", "Receipt", "time_served" will automatically updated.
