<?php
$connection= mysqli_connect("localhost", "root", "", "db_vsm" );

?>
<html>
    <body>
    <center> <h3> VS Musicals</h3></center>
    <hr/>
    <center> <h4> Student Report</h4></center>
    
    <?php
    echo "Date:" .date('d-m-y');
    ?>
    
    <?php
    
    $studentq = mysqli_query($connection, "select * from tbl_student")or die (mysqli_errno($connection));
    echo "<table>";
    echo "<tr>";
    echo "<th></th>";
    echo "</tr>";
    while ($row = mysqli_fetch_all($studentq)){
        echo "<tr>";
        
        echo "<td> {$row['stud_fname']} </td>";
        echo "<td> {$row['stud_lname']} </td>";
        echo "<td> {$row['stud_gender']} </td>";
        echo "<td> {$row['stud_dob']} </td>";
        echo "<td> {$row['stud_mobile']} </td>";
        echo "<td> {$row['stud_email']} </td>";
        echo "<td> {$row['stud_password']} </td>";
        echo "<td> {$row['stud_address']} </td>";
                
        echo "</tr>";
    }
    
    echo '</table>';
    
    ?>
    </body>
</html>