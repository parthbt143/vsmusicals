<html class="no-js" lang="en">
<?php include'headFile.php';

$headermsg ="Employees";
?>
<?php include'connection.php'?>
<body>
    <?php
    include 'confirm-delete.php';
    ?>
<div class="prtm-wrapper">
<?php include 'header.php'; ?>

<div class="prtm-main">
    <title>Employee List</title>
<?php include 'sidebar.php'; ?>
<div class="prtm-content-wrapper">
<div class="prtm-content">
  <!-- Contents Ahiya Lkhvana -->
  <a href="employee-insert.php"><button class="btn btn-primary btn-rounded" type="button"><img src='images/add.png'></button></a>
  <br><br>
  <?php
  $q = mysqli_query($connection,"SELECT
    `tbl_employee`.`emp_id`
    , `tbl_employee`.`emp_name`
    , `tbl_employee`.`emp_gender`
    , `tbl_employee`.`emp_mobile`
    , `tbl_employee`.`emp_address`
    , `tbl_employee`.`salary`
    , `tbl_designation`.`des_name`
    , `tbl_area`.`area_name`
    
FROM
    `db_vsm`.`tbl_designation`
    INNER JOIN `db_vsm`.`tbl_employee` 
        ON (`tbl_designation`.`des_id` = `tbl_employee`.`des_id`)
    INNER JOIN `db_vsm`.`tbl_area` 
        ON (`tbl_area`.`area_id` = `tbl_employee`.`area_id`) where tbl_employee.is_delete='0' order by(emp_id) ; ")or die(mysqli_errno($connection));

echo " <table class='table table-hover dataTable'  >";
echo "<tr>";
echo "<th> ID </th>";
echo "<th> Name </th>";
echo "<th> Gender </th>";
echo "<th> Designation </th>";
echo "<th> Mobile </th>";
echo "<th> Address </th>";
echo "<th> Area </th>";
echo "<th> Salary </th>";

echo '<th>Action</th>';  
  while($row = mysqli_fetch_array($q))
    {
       
        echo "<tr>";
        echo "<td> {$row['emp_id']} </td>";
        echo "<td> {$row['emp_name']} </td>";
        echo "<td> {$row['emp_gender']} </td>";
        echo "<td> {$row['des_name']} </td>";
        echo "<td> {$row['emp_mobile']} </td>";
        echo "<td> {$row['emp_address']} </td>";
        echo "<td> {$row['area_name']} </td>";
        echo "<td> {$row['salary']} </td>";
        echo "<td><a  href='employee-edit.php?eid={$row['emp_id']}'> <img src='images/edit1.png'>   </a>| <a OnClick='return ConfirmDelete();' href='set-delete.php?did={$row['emp_id']}&tbl=tbl_employee&pk=emp_id&page=employee-display.php'><img src='images/delete.png'></a> </td>";
             echo "</tr>"; 
    }
echo "</tr>";
echo "</table>";
?>
 
</div>
</div>
</div>
</div>
<?php include'script.php'?>
</body>
</html>
