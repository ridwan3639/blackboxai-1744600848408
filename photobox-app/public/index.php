<?php
require_once __DIR__.'/../config/database.php';
require_once __DIR__.'/../app/controllers/BaseController.php';

// Simple routing
$request = $_SERVER['REQUEST_URI'];
$basePath = '/photobox-app/public';

// Remove base path and query string
$route = str_replace($basePath, '', parse_url($request, PHP_URL_PATH));

// Route mapping
$routes = [
    '/' => 'PaymentController@showPaymentOptions',
    '/payment/qris' => 'PaymentController@processQrisPayment',
    '/payment/voucher' => 'PaymentController@processVoucherPayment',
    '/photo' => 'PhotoController@showPhotoCapture',
    '/admin' => 'AdminController@dashboard'
];

// Find matching route
if (array_key_exists($route, $routes)) {
    list($controllerName, $method) = explode('@', $routes[$route]);
    $controllerClass = "\\App\\Controllers\\$controllerName";
    
    if (class_exists($controllerClass)) {
        $controller = new $controllerClass();
        $controller->$method();
    } else {
        http_response_code(404);
        echo "Controller not found";
    }
} else {
    http_response_code(404);
    echo "Page not found";
}
?>
