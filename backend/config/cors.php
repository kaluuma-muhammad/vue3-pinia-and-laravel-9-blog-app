<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*','*'],

    'allowed_methods' => ['POST', 'GET', 'DELETE', 'PUT', '*'],

    'allowed_origins' => [
        'http://localhost:8080',
        'http://localhost:8081',
        'http://localhost:8082',
        'http://127.0.0.1:5173'
    ],
    'allowed_origins_patterns' => [],

    'allowed_headers' => ['Origin','Content-Type','X-Auth-Token','Authorization','X-Requested-With','Content-Range','Content-Disposition','Content-Description','x-xsrf-token','ip','X-Custom-Header','Upgrade-Insecure-Requests','*'],

    'exposed_headers' => false,

    'max_age' => 1728000,
    
    'supports_credentials' => true,

];
