<?php
include 'connection.php';
?>
<html>
    <body>
 <a href="../index.php">Home</a>
    <center> <h3>
        VS Musicals
        </h3>
    <hr/>
    <h4>  Product Report</h4>
    </center>
    <?php
    
        echo "Date:". date('d-m-y');
        
        $productq= mysqli_query($connection, "select * from  tbl_product where is_delete=0 ") or die(mysqli_errno($connection));
        
        echo "<center>";
        echo "<table border=1>";
        
        echo "<tr>";
            echo "<th> ID</th>";
            echo "<th> Product Name</th>";
            echo "<th> Product Stock</th>";
            echo "<th> Product Photo</th>";
            echo "<th> Sub Category Name</th>";
           
            
        echo "</tr>";
        
        while ($row = mysqli_fetch_array($productq)) {
            
        $subcatq= mysqli_query($connection, "select sc_name from tbl_sub_category where sc_id='{$row['sc_id']}'")or die(mysqli_error($connection));
           $catname= mysqli_fetch_array($subcatq);
            echo "<tr>";
            echo "<td>{$row['pro_id']}</td>";
            echo "<td>{$row['pro_name']}</td>";
          
            echo "<td>{$row['pro_stock']}</td>";
            
           echo "<td> <a href='../{$row['pro_photo']}'> <img style='height:100;width:100;' src='../{$row['pro_photo']}'> </a></td>";
            echo "<td>{$catname['sc_name']}</td>";
            echo "</tr>";
            
        }
        echo "</table>";
       echo "</center>";
    ?>
</body>
</html>