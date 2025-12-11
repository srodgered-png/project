<?php

// Request URL
$routes = [
    ''   => [
        'controller' => 'DefaultController',
        'action'     => 'index'
    ],
    'v1/api/users/all'   => [
        'controller' => 'AppController',
        'action'     => 'getAll'
    ],
    'v1/api/users' => [
        'GET' => [
            'controller' => 'AppController',
            'action'     => 'get'
        ],
        'POST' => [
            'controller' => 'AppController',
            'action'     => 'create'
        ],
        'PUT' => [
            'controller' => 'AppController',
            'action'     => 'update'
        ],
        'DELETE' => [
            'controller' => 'AppController',
            'action'     => 'delete'
        ]
    ]
];

// Load Model
$files = glob('../src/Model/*.php');
foreach ($files as $file) {
    include_once($file);
}

// Load Mapper
$files = glob('../src/Mapper/*.php');
foreach ($files as $file) {
    include_once($file);
}

// Load Form
$files = glob('../src/Form/*.php');
foreach ($files as $file) {
    include_once($file);
}

// Load Repository
$files = glob('../src/Repository/*.php');
foreach ($files as $file) {
    include_once($file);
}

// Load Service
$files = glob('../src/Service/*.php');
foreach ($files as $file) {
    include_once($file);
}

// init
$request = new  App\Service\Request();
$method  = $request->method();
$url     = $request->getUrl();

$parsedUrl = parse_url($url);

$url = trim($parsedUrl['path'], '/');
$route = $routes[$url] ?? null;
if (!$route) {
    http_response_code(404);
    echo 'Page not found 404 ;(';
    die;
}

if (isset($route[$method])) {
    $route = $route[$method];
}
if (empty($route['controller']) || empty($route['action'])) {
    http_response_code(404);
    echo 'Page not found 404 ;(';
    die;
}

// Load Controller
include_once('../src/Controller/AbstractController.php');
include_once('../src/Controller/' . $route['controller'] . '.php');

try {
    $diApp = new App\Service\ActionInvoker($route['controller'], $route['action']);
    echo $diApp->invoke();
} catch (\Throwable $e) {
    http_response_code(500);
    echo 'Something wrong 500 ;(';
    die;
}
