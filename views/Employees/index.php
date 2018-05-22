<h1>Employee Form</h1>
<hr>
<form action="<?php echo Config::URL ?>Employees/crudall" method="POST">
    <label>ID: <input name="empid" type="number" value="<?php echo $this->empid ?>"></label> 
    <label>Employee Name: <input name="empname" type="text" value="<?php echo $this->empname ?>"></label> 
    <label>Hire Date: <input name="emphiredate" type="date" value="<?php echo $this->emphiredate ?>"></label> 
    <br>
    <input type="submit" name="action" value="Get">
    <input type="submit" name="action" value="Insert">
    <input type="submit" name="action" value="Update">
    <input type="submit" name="action" value="Delete">
    <input type="submit" name="action" value="GetAll">

    <!--<button onclick="GetAllEmployees()">Get All</button>-->
    </form>
<hr>
        <!--Render everything:-->
        <div id="responsecontent">
            <?php echo $this->content; ?>
        </div>