<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// DAOs
$container['UsuarioDAO'] = function ($c) {
    return new \App\DAO\UsuarioDAO($c);
};
$container['FavoritoDAO'] = function ($c) {
    return new \App\DAO\FavoritoDAO($c);
};

// Models
$container['UsuarioModel'] = function ($c) {
    return new \App\Model\UsuarioModel($c->get('logger'));
};
$container['FavoritoModel'] = function ($c) {
    return new \App\Model\FavoritoModel($c->get('logger'));
};
$container['IndexModel'] = function ($c) {
    return new \App\Model\IndexModel($c->get('logger'));
};

// Controllers
$container['FavoritoController'] = function ($c) {
    return new \App\Controllers\FavoritoController($c);
};
$container['UsuarioController'] = function ($c) {
    return new \App\Controllers\UsuarioController($c);
};
$container['IndexController'] = function ($c) {
    return new \App\Controllers\IndexController($c->get('logger'),$c);
};