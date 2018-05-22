<?php

//require_once 'libraries/bootstrap.php';
spl_autoload_register(
        function($class) {
    if (file_exists("libraries/$class.php")) {
        require_once "libraries/$class.php";
    } else if (file_exists("config/$class.php")) {
        require_once "config/$class.php";
    } else {
        echo "$class was not found.";
        die();
    }
});
//
setConfig();
$app = new bootstrap();
$app->init();

function setConfig() {
    Config::$server = 'localhost';
    Config::$database = 'project';
    Config::$user = 'root';
    Config::$password = '';
}


