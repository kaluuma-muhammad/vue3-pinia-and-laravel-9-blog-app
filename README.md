# vue3-pinia-and-laravel-9-blog-app
This is a complete blog system app with authentications, made with vue-3 composition-api, pinia state management and laravel-9 for the backend using passport.

# App Details
This is a simple blog system app containing two file directories  
1- First is the backend (laravel-9)  
2- And the frontend directory (Vue.js 3)  

# Frontend
After cloning the repository navigate to the frontend repository  
Open the terminal and run command
```
npm install
```
Install the app packages and dependencies  
After installing the packages start the development server by running the following code in the terminal
```
npm run dev
```
That's all you need for the frontend

# Backend
Navigate to the backend directory and open the command terminal and run

```
composer update
```
It'll install all the composer dependencies required by the backend app  
Migrate all the migration tables and start the backend server

```
php artisan migrate  
php artisan passport:install
php artisan serve
```

# Conclusion
After installing all the project dependencies now run your frontend in the browser,  
Sign up and proceed to the blog system.  
Now you can view available blogs, add, edit, and delete a blog.
