<?php

class Employees extends Controller{

function __construct() {
parent::__construct();
parent::loadModel(__CLASS__);
$this->_view->content = "";
$this->_view->empid = "";
$this->_view->empname = "";
$this->_view->emphiredate = "";
}

public function index() {

// Once again, index() is the first method to be performed.
// it creates all the variables and properties.
// Meaning if we won't create here the property: content, it just won't
// be located and used in cudall() later.

$this->_view->render('Employees/index');
}
public function crudall(){
if ($_POST) {
$action = $_POST['action'];
$action = str_replace(' ', '', $action);

$this->{$action}();
$this->_view->render('Employees/index');
}
//if ($_GET) {
//    print_r($_GET);
//$this->GetLink($this->id);
//$this->_view->render('Employees/index');
//}

}

private function Get() {
$result = $this->_model->Get();
if (is_array($result)) {
$this->_view->empid = $result['EmpID'];
$this->_view->empname = $result['EmpName'];
$this->_view->emphiredate = $result['EmpHireDate'];
$this->_view->render('Employees/index');
} else {
$this->_view->content = "<hr>" . $result;
$this->_view->render('Employees/index');
}
}
public function display($id) {
$result = $this->_model->display($id);
if (is_array($result)) {
$this->_view->empid = $result['EmpID'];
$this->_view->empname = $result['EmpName'];
$this->_view->emphiredate = $result['EmpHireDate'];
$this->_view->render('Employees/index');
} else {
$this->_view->content = "<hr>" . $result;
$this->_view->render('Employees/index');
}
}

private function Insert() {
$this->_view->content = $this->_model->Insert();
$this->_view->render('Employees/index');
}
private function Update() {
$this->_view->content = $this->_model->Update();
$this->Get();
$this->_view->render('Employees/index');
}
private function Delete() {
$this->_view->content = $this->_model->Delete();
$this->_view->render('Employees/index');
}
private function GetAll() {
$this->_view->content = $this->_model->GetAll();
$this->_view->render('Employees/index');
}
}
