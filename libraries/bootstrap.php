<?php

class bootstrap {

    const CONTROLLER = 0;
    const ACTION = 1;
    const P1 = 2;
    const P2 = 3;
    
    private $_controller = null;
    private $_controllerObj = null;
    private $_action = null;
    private $_p1 = null;
    private $_p2 = null;
    
    public $id;

    function __construct() {
        
    }

    public function init() {
        $this->_parseParams();
        // if controller file was found and a relevant object was created,
        // then execute the function.
        if (($this->_createController()) == TRUE) {
            $this->_execute();
        }
    }

    private function _parseParams() {
        $uri = isset($_GET['uri']) ? $_GET['uri'] : 'Employees/index';
        $uri = rtrim($uri, '/');
        $uri = explode('/', $uri);
       
// check the array from $_GET
//        echo "<pre>";
//        var_dump($uri);
//        echo "</pre>";
//        
// let's assume we didn't declare the properties at the beginning of the class.
// we could actually create them on the fly but this is a logic mistake.
// try to avoide such a case and declare all the variables first.
        $this->_controller = $uri[self::CONTROLLER];
        $this->_action = isset($uri[self::ACTION]) ? $uri[self::ACTION] : 'index';
        $this->_p1 = isset($uri[self::P1]) ? $uri[self::P1] : null;
        $this->_p2 = isset($uri[self::P2]) ? $uri[self::P2] : null;
    }

    private function _createController() {
        $file = 'controllers/' . $this->_controller . '.php';
        if (file_exists($file)) {
            require_once 'controllers/' . $this->_controller . '.php';
            $this->_controllerObj = new $this->_controller;
        } else {
            return $this->_error($this->_action . ' method ');
        }
        return TRUE;
    }

        private function _execute() {
        if ($this->_p1) {
            echo $this->_controllerObj->{$this->_action}($this->_p1);
        } else {
        if (method_exists($this->_controllerObj, $this->_action)){
        echo $this->_controllerObj->{$this->_action}();
        }
        else {
            $this->_error($this->_controller);
        }
        }
        
    }

    private function _error($msg) {
        require_once 'controllers/error.php';
        $err = new Error($msg . ' not found.');
        $err->index();
        return FALSE;
    }

}
