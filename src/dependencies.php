<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// Service factory for the ORM
$container['db'] = function ($c) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    if (!$c->get('settings')['displayErrorDetails'])  
        $capsule->addConnection($c->get('settings')['db']);
    else 
        $capsule->addConnection($c->get('settings')['dbdev']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};

// Register component on container twik view renderer
$container['view'] = function ($container) {
    $settings = $container->get('settings')['renderer'];
    $cache = $container->get('settings')['cache'];
    $view = new \Slim\Views\Twig($settings['template_path'], [
        // 'cache' => $cache['cache_path']
    ]);
    
    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Register Controller
$container['Controller'] = function ($c) {
    return new \App\Controller\Controller($c);
};

$container['DefaultController'] = function($c) {
    return new \App\Controller\DefaultController($c->get('csrf'), $c->get('logger'), $c->get('view'), $c->get('db'));
};

$container['PostController'] = function($c) {
    return new \App\Controller\PostController($c->get('csrf'), $c->get('logger'), $c->get('view'), $c->get('db'));
};

$container['CategoriesController'] = function($c) {
    return new \App\Controller\CategoriesController($c->get('csrf'), $c->get('logger'), $c->get('view'), $c->get('db'));
};

$container['NewController'] = function($c) {
    return new \App\Controller\NewController($c->get('csrf'), $c->get('logger'), $c->get('view'), $c->get('db'));
};

$container['PopularController'] = function($c) {
    return new \App\Controller\PopularController($c->get('csrf'), $c->get('logger'), $c->get('view'), $c->get('db'));
};

$container['RecommendController'] = function($c) {
    return new \App\Controller\RecommendController($c->get('csrf'), $c->get('logger'), $c->get('view'), $c->get('db'));
};