<html class="no-js" lang="en">
<?php 
$headermsg ="Students";
include'headFile.php';?>
<?php include'connection.php'?>
<body>
    <?php
    include 'confirm-delete.php';
    ?>
<div class="prtm-wrapper">
<?php include 'header.php'; ?>

<div class="prtm-main">
    <title>Student List</title>
    <?php include 'sidebar.php'; ?>
<div class="prtm-content-wrapper">
<div class="prtm-content">
  <!-- Contents Ahiya Lkhvana -->
 <?php
  $q = mysqli_query($connection,"SELECT
    `tbl_student`.`stud_id`
    , `tbl_student`.`stud_fname`
    , `tbl_student`.`stud_lname`
    , `tbl_student`.`stud_gender`
    , `tbl_student`.`stud_dob`
    , `tbl_student`.`stud_mobile`
    , `tbl_student`.`stud_email`
    , `tbl_student`.`stud_address`
    , `tbl_area`.`area_name`
FROM
    `db_vsm`.`tbl_area`
    INNER JOIN `db_vsm`.`tbl_student`  
        ON (`tbl_area`.`area_id` = `tbl_student`.`area_id`) where tbl_student.is_delete='0';  ")or die(mysqli_errno($connection));

echo " <table class='table table-hover dataTable'  >";
echo "<tr>";
echo "<th> ID </th>";
echo "<th> First Name </th>";
echo "<th> Last Name </th>";
echo "<th> Gender </th>";
echo "<th> Date of Birth </th>";
echo "<th> Mobile </th>";
echo "<th> Email </th>";
echo "<th> Address </th>";
echo "<th> Area </th>";

echo '<th>Action</th>';  
  while($row = mysqli_fetch_array($q))
    {
       
        echo "<tr>";
        echo "<td> {$row['stud_id']} </td>";
        echo "<td> {$row['stud_fname']} </td>";
        echo "<td> {$row['stud_lname']} </td>";
        echo "<td> {$row['stud_gender']} </td>";
        echo "<td> {$row['stud_dob']} </td>";
       
        echo "<td> {$row['stud_mobile']} </td>";
            echo "<td> {$row['stud_email']} </td>";
        echo "<td> {$row['stud_address']} </td>";
        echo "<td> {$row['area_name']} </td>";
        echo "<td><a  href='student-edit.php?eid={$row['stud_id']}'><img src='images/edit1.png'>   </a> | <a OnClick='return ConfirmDelete();' href='set-delete.php?did={$row['stud_id']}&tbl=tbl_student&pk=stud_id&page=student-display.php'><img src='images/delete.png'></a> </td>";
      
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