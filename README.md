# vue3-pinia-and-laravel-9-blog-app
This is a complete blog system app with authentications, made with vue-3 composition-api, pinia state management and laravel-9 for the backend using passport.

# App Details
This is a simple blog system app containing two file dirictories  
1- First is the backend (laravel-9)  
2- And the frontend directory (Vue.js 3)  

# Frontend
After cloning the repository navigate to the frontend repository  
Open the terminal and run command
```
npm install
```
Istall the app packages and depencies  
After installing the packages start the development server by running the following code in the terminal
```
npm run dev
```
That's all you need for the frontend

# Backend
###### Recormendations
I'd highly recommend you to upgrate to  
1- PHP 8.0.10 or higher  
2- phpMyAdmin ^5.1.1 or higher  

Now navigate to the backend directory and open the command terminal and run

```
composer update
```
It'll install all the composer dependecies required by the backend app  
Migrate all the migration tables and start the backend server

```
php artisan migrate  
php artisan passport:install
php artisan serve
```
