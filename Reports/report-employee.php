<?php

include 'connection.php';

$msg="";
 if(isset($_POST['btngen']))
    {
       $gen = mysqli_real_escape_string($connection,$_POST['gender']);
       $employeeq= mysqli_query($connection, "SELECT * FROM tbl_employee where is_delete=0 AND emp_gender='{$gen}'") or die(mysqli_errno($connection));
        $msg = "Displaying Records With Gender :- $gen.";
    }
    else if(isset($_POST['des'])){
        
       $des= mysqli_real_escape_string($connection,$_POST['designation']);
       $employeeq= mysqli_query($connection, "SELECT * FROM tbl_employee where is_delete=0 AND des_id='{$des}'") or die(mysqli_errno($connection));
       $desq = mysqli_query($connection,"select * from tbl_designation where des_id='{$des}'");
       $desname = mysqli_fetch_array($desq);
       $msg = "Displaying Records With Designation :- ".$desname['des_name'] ;
        
    } else if(isset($_POST['clear'])){
        
   $employeeq= mysqli_query($connection, "SELECT * FROM tbl_employee where is_delete=0 ") or die(mysqli_errno($connection));
    
       $msg = "" ;
        
    }
    else
        {
    $employeeq= mysqli_query($connection, "SELECT * FROM tbl_employee where is_delete=0 ") or die(mysqli_errno($connection));
    }
    ?><html>
    <body>
         <a href="../index.php">Home</a>
    <center> <h3>
        VS Musicals
        </h3>
    <hr/>
    <h4>  Employee Report</h4>
    </center>
    <?php
    
        echo "Date:".date('d-m-y');
        echo "<br>";
        echo "<br>";
        ?>
        <form method="post" >
            Select Gender  :- <select name="gender">

                <option value="Male"> Male </option>
                <option value="Female"> Female </option>
            </select>
                <input type ="submit" name="btngen">
                
            <br>
            <br>
                Select Designaton :- <select name="designation">
                <?php
                $q1 = mysqli_query($connection, "select * from tbl_designation where is_delete='0'");
                while($row1 = mysqli_fetch_array($q1))
                {
                    echo "<option value='{$row1['des_id']}'> {$row1['des_name']} </option>";
                }
                ?>
                </select>
                <input type ="submit" name="des">
        </form>
        
    
    
    <?php
    echo $msg;
    echo "<br> <br>";
?>
    <form method="post">
        <input type="submit" name="clear" value="Clear Filters">
    </form>
   <?php
        echo "<center>";
        echo "<table border=1>";
        
        echo "<tr>";
            echo "<th> ID</th>";
            echo "<th> Employee Name</th>";
            echo "<th> Employee Gender</th>";
            echo "<th> Employee No.</th>";
            echo "<th> Employee Address</th>";
            echo "<th> Salary</th>";
            echo "<th> Designation ID</th>";
           
            
        echo "</tr>";
        
        while ($row = mysqli_fetch_array($employeeq)) {
            
        $desiq= mysqli_query($connection, "select des_name from tbl_designation where des_id='{$row['des_id']}'")or die(mysqli_error($connection));
           $desname= mysqli_fetch_array($desiq);
            echo "<tr>";
            echo "<td>{$row['emp_id']}</td>";
            echo "<td>{$row['emp_name']}</td>";
            echo "<td>{$row['emp_gender']}</td>";
            echo "<td>{$row['emp_mobile']}</td>";
            echo "<td>{$row['emp_address']}</td>";
            echo "<td>{$row['salary']}</td>";
            echo "<td>{$desname['des_name']}</td>";
            echo "</tr>";
            
        }
        echo "</table>";
       echo "</center>";
    ?>
</body>
</html>