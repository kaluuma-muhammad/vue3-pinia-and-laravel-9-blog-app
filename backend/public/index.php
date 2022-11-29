<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// $allowed_origins = array(
//     'http://127.0.0.1:8000', // Laravel API domain
//     'http://127.0.0.1:5173', // Frontend domain
// );

// if (isset($_SERVER['HTTP_ORIGIN']) && $_SERVER['HTTP_ORIGIN'] != '') {
//     foreach ($allowed_origins as $$allowed_origin) {
//         if (preg_match('#' . $allowed_origin . '#', $_SERVER['HTTP_ORIGIN'])) {
//             header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
//             header('Access-Control-Allow-Credentials: true');
//             header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, OPTIONS');
//             header('Access-Control-Allow-Age: 1728000');
//             header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, X-Requested-With, Content-Range, Content-Disposition, x-xsrf-token, ip');
//             break;
//         }
//     }
// }

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that any pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
