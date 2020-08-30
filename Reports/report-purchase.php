<?php

include 'connection.php';

$msg="";

    if(isset($_POST['supbtn'])){
        $sup =$_POST['supp'] ;
           $purq= mysqli_query($connection, "SELECT * FROM tbl_purchase where is_delete=0 AND sup_id = '{$sup}' ") or die(mysqli_errno($connection));
    $supq = mysqli_query($connection,"select * from tbl_supplier where sup_id = '{$sup}'");
    $supa = mysqli_fetch_array($supq);
       $msg = "Displaying Purchahses From Supplier :- " . $supa['sup_name'];
     
    } else 
if(isset($_POST['clear'])){
  
        $purq= mysqli_query($connection, "SELECT * FROM tbl_purchase where is_delete=0 ") or die(mysqli_errno($connection));
    
       $msg = "" ;
       }
    else 
        { 
        $purq= mysqli_query($connection, "SELECT * FROM tbl_purchase where is_delete=0 ") or die(mysqli_errno($connection));
    
       $msg = "" ;
        
   }
    ?>
<html>
    <body>
        <a href="../index.php">Home</a>
    <center> <h3>
        VS Musicals
        </h3>
    <hr/>
    <h4>  Purchase Report</h4>
    </center>
    <?php
    
        echo "Date:".date('d-m-y');
        echo "<br>";
        echo "<br>";
        ?>
        <form method="post" >
           
                
            <br>
            <br>
                Select Supplier :- <select name="supp">
                <?php
                $q1 = mysqli_query($connection, "select * from tbl_supplier where is_delete='0'");
                while($row1 = mysqli_fetch_array($q1))
                {
                    echo "<option value='{$row1['sup_id']}'> {$row1['sup_name']} </option>";
                }
                ?>
                </select>
                <input type ="submit" name="supbtn">
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
            echo "<th> Supplier Name</th>";
            echo "<th> Purchase Date</th>";
            echo "<th width='200px'> Details </th>";
           
            
        echo "</tr>";
        
        while ($row = mysqli_fetch_array($purq)) {
            
        $supq= mysqli_query($connection, "select sup_name from tbl_supplier where sup_id='{$row['sup_id']}'")or die(mysqli_error($connection));
           $supname= mysqli_fetch_array($supq);
            echo "<tr>";
            echo "<td>{$row['pur_id']}</td>";
            echo "<td>{$supname['sup_name']}</td>";
            echo "<td>{$row['pur_date']}</td>";
           echo "<td>";
                     echo "<table  border=1> ";
                     echo "<tr>";
                     echo "<th> Product Name </th>";
                     echo "<th> Quantity </th>";
                     echo "</tr>";
                    $detailsq  = mysqli_query($connection,"select * from tbl_purchase_detail where is_delete=0 AND pur_id = '{$row['pur_id']}'") or die(mysqli_error($connection));
                     while ($drow = mysqli_fetch_array($detailsq)) {
                             $proq= mysqli_query($connection, "select pro_name from tbl_product where pro_id='{$drow['pro_id']}'")or die(mysqli_error($connection));
           $proname= mysqli_fetch_array($proq);
                       echo "<tr>";
                       echo "<td width='150px'> {$proname['pro_name']} </td>";
                       echo "<td> {$drow['pro_quantity']} </td>";
                       echo "</tr>";
                         
                     }
                    
                   
                        
                    echo "</table>";
            echo "</td>";
           echo "</tr>";
            
        }
        echo "</table>";
       echo "</center>";
    ?>
</body>
</html>