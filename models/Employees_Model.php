<?php

class Employees_Model extends Model {

    public $result;

    function __construct() {
        parent::__construct();
    }

//    function is_array($result);
    public function Get() {
        try {
            $matchid = $_POST['empid'];
            $sql = "SELECT * FROM `project`.`employees` WHERE `EmpID` = :EmpID";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':EmpID', $_POST['empid']);
            $stmt->execute();                         
            $this->result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($matchid === "") {
                throw new Exception("Please put ID.");
            }
            if ($this->result['EmpID'] != $matchid) {
                throw new Exception("Id does not exist.");
            }
            return $this->result;
            
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    public function display($id) {
            try {
            $sql = "SELECT * FROM `project`.`employees` WHERE `EmpID` = $id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':EmpID', $id);
            $stmt->execute();
            $this->result = $stmt->fetch(PDO::FETCH_ASSOC);
//            if ($matchid === "") {
//                throw new Exception("Please put ID.");
//            }
//            if ($this->result['EmpID'] != $matchid) {
//                throw new Exception("Id does not exist.");
//            }
            return $this->result;
            } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function Insert() {
        try {
            $sql = "INSERT INTO "
                    . "`project`.`employees` (`EmpID`,`EmpName`,`EmpHireDate`) VALUES (:EmpID,:EmpName,:EmpHireDate);";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':EmpID', $_POST['empid']);
            if ($_POST['empname'] == "") {
                throw new Exception("Please put Name.");
            } else {
                $stmt->bindParam(':EmpName', $_POST['empname']);
            }
            if ($_POST['emphiredate'] == "") {
                throw new Exception("Please put Date.");
            } else {
                $stmt->bindParam(':EmpHireDate', $_POST['emphiredate']);
            }
            $stmt->execute();
            return $_POST['empid'] . " " ."Added Succesfully!";
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function Update() {
        $sql = "UPDATE `project`.`employees` SET `EmpName` = :EmpName, `EmpHireDate` = :EmpHireDate WHERE `EmpID` = :EmpID;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':EmpID', $_POST['empid']);
        $stmt->bindParam(':EmpName', $_POST['empname']);
        $stmt->bindParam(':EmpHireDate', $_POST['emphiredate']);
        $stmt->execute();
//        $this->result = $stmt->fetch(PDO::FETCH_ASSOC);
//        return $this->result;
    }

    public function Delete() {
        try {
            $id = $_POST['empid'];
            $sql = "DELETE FROM `project`.`employees` WHERE EmpID = $id;";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':EmpId', $_POST['empid']);
           if ($_POST['empname'] == "") {
                throw new Exception("No directory found");
            } else {
                $stmt->bindParam(':EmpName', $_POST['empname']);
            }
            if ($_POST['emphiredate'] == "") {
                throw new Exception("No directory found.");
            } else {
                $stmt->bindParam(':EmpHireDate', $_POST['emphiredate']);
            }
//            var_dump($_POST);
            $stmt->execute();
            return $_POST['empid'] . " " ."Deleted Succesfully!";
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function GetAll() {
        $sql = "SELECT * FROM project.employees;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $this->result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $table = "<table border='1'>";

        $table .= "<td>EmpID</td><td>EmpName</td><td>EmpHireDate</td>";
        foreach ($this->result as $key) {
            $lid = $key['EmpID'];
            $table .= "<tr><td><a href='display/$lid' name='action'>{$key['EmpID']}</a></td>"
                    . "<td>{$key['EmpName']}</td>"
                    . "<td>{$key['EmpHireDate']}</td></tr>";
        }
        $table .= "</table>";
        return $table;
    }
    
//     public function GetAll() {
//        $sql = "SELECT * FROM project.employees;";
//        $stmt = $this->db->prepare($sql);
//        $stmt->execute();
//        $this->result = $stmt->fetchALL(PDO::FETCH_ASSOC);
//        $table = "<table border='1'>";
//
//        $table .= "<td>EmpID</td><td>EmpName</td><td>EmpHireDate</td>";
//        foreach ($this->result as $key) {
//            $table .= "<tr><td>{$key['EmpID']}</td>"
//                    . "<td>{$key['EmpName']}</td>"
//                    . "<td>{$key['EmpHireDate']}</td></tr>";
//        }
//        $table .= "</table>";
//        return $table;
//    }
    

}
