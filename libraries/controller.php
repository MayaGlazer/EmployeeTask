<?php

class Controller {

    protected $_view;
    protected $_model;

    public function __construct() {
        $this->_view = new View();
    }

    public function loadModel($name) {
        $path = 'models/' . $name . '_Model.php';
        if (file_exists($path)) {
            require_once $path;
            $modelName = $name . "_Model";  
            $this->_model = new $modelName();
        }
    }
}    