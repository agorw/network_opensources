<?php

session_start();
header_remove("X-Powered-By");
header_remove("Server");
define('ROOT', dirname(__DIR__) . '/');
include_once ROOT . 'Autoloads.php';
$autoload = new \MF\Autoloads;
$autoload::register();

use \MF\Controllers\MainControllers;
use \MF\Cores\Config;

Config::Token();

require_once ROOT . '/' . Config::TEMPLATE . '.php';
