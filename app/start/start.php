<?php

use DI\Container;
use DI\ContainerBuilder;
use League\Plates\Engine;
use Aura\SqlQuery\QueryFactory;
//use PDO;

$containerBilder = new ContainerBuilder;
$containerBilder->addDefinitions([
    Engine::class=>function(){
        return new Engine('../app/views');
    },
    QueryFactory::class => function(){
        return new QueryFactory('mysql');
    },
    PDO::class => function(){
        return new PDO('mysql:host=192.168.10.10; dbname=notepad_lesson_8; charset=utf8','homestead', 'secret');
    }
]);

$container = $containerBilder->build();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/tasks', ['App\controllers\HomeController', 'tasks']);
    $r->addRoute('GET', '/task/{id:\d+}', ['App\controllers\HomeController', 'task']);

    $r->addRoute('GET', '/createTask', ['App\controllers\HomeController', 'createTask']);
    $r->addRoute('POST', '/createTask', ['App\controllers\HomeController', 'createTask']);

    $r->addRoute('GET', '/editTask/{id:\d+}', ['App\controllers\HomeController', 'editTask']);
    $r->addRoute('POST', '/editTask/{id:\d+}', ['App\controllers\HomeController', 'editTask']);

    $r->addRoute('GET', '/deleteTask/{id:\d+}', ['App\controllers\HomeController', 'deleteTask']);

    // {id} must be a number (\d+)
//    $r->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
//    // The /{title} suffix is optional
//    $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo " ... 404 Not Found";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo " ... 405 Method Not Allowed";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

//        $container = new Container();
        $container->call($handler, $vars);
        // ... call $handler with $vars
        break;
}