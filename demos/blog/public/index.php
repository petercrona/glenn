<?php

define('APP_PATH', realpath('../app') . DIRECTORY_SEPARATOR);
define('BASE_PATH', realpath('../../../') . DIRECTORY_SEPARATOR);
define('ACTIVE_RECORD', realpath('../../../ActiveRecord') . DIRECTORY_SEPARATOR);
set_include_path(APP_PATH . PATH_SEPARATOR . BASE_PATH . PATH_SEPARATOR . ACTIVE_RECORD);
require_once 'ActiveRecord.php';

spl_autoload_register(function($class) {
            require_once str_replace("\\", "/", $class) . '.php';
        });

use glenn\controller\FrontController,
 glenn\config\Config,
 glenn\http\Request,
 glenn\router\RouterTree;

ActiveRecord\Config::initialize(function($cfg) {
                    $cfg->set_model_directory('../app/models');
                    $cfg->set_connections(array('development' => 'sqlite://blog.db'));
                });

$request = new Request();
$router = new RouterTree();

$frontController = new FrontController($router);
$response = $frontController->dispatch($request);
$response->send();