<?php

class Error {
    
    private $_msg;

    function __construct($msg) {
        $this->_msg = $msg;
    }
    public function index() {
        echo "Error: " . $this->msg;
    }
}