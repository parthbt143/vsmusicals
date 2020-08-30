<html class="no-js" lang="en">
<?php include'headFile.php'?>
<?php include'connection.php'?>
<body>
    <?php
    include 'confirm-delete.php';
$headermsg ="Fees";
    ?>
<div class="prtm-wrapper">
<?php include 'header.php'; ?>

<div class="prtm-main">
    <title>fees </title>
    <?php include 'sidebar.php'; ?>
<div class="prtm-content-wrapper">
<div class="prtm-content">
  <!-- Contents Ahiya Lkhvana -->
 <?php
  $q = mysqli_query($connection," SELECT
    `tbl_fees`.`fee_date`
    , `tbl_fees`.`fee_instalment_amt`
    , `tbl_student`.`stud_fname`
    , `tbl_student`.`stud_lname`
    , `tbl_batch`.`batch_name`
    , `tbl_course`.`course_name`
    , `tbl_fees`.`fee_id`
FROM
    `db_vsm`.`tbl_admission`
    INNER JOIN `db_vsm`.`tbl_student` 
        ON (`tbl_admission`.`stud_id` = `tbl_student`.`stud_id`)
    INNER JOIN `db_vsm`.`tbl_batch` 
        ON (`tbl_admission`.`batch_id` = `tbl_batch`.`batch_id`)
    INNER JOIN `db_vsm`.`tbl_fees` 
        ON (`tbl_admission`.`adm_id` = `tbl_fees`.`adm_id`)
    INNER JOIN `db_vsm`.`tbl_course` 
        ON (`tbl_batch`.`course_id` = `tbl_course`.`course_id`) where tbl_fees.is_delete='0' ")or die(mysqli_errno($connection));

echo " <table class='table table-hover dataTable'  >";
echo "<tr>";
echo "<th> ID </th>";
echo "<th>  Name </th>";
echo "<th> Course </th>";
echo "<th> Batch </th>";
echo "<th> Installment Amount </th>";

echo '<th>Date</th>';  
  while($row = mysqli_fetch_array($q))
    {
       
        echo "<tr>";
        echo "<td> {$row['fee_id']}</td>";
        echo "<td> {$row['stud_fname']} {$row['stud_lname']} </td>";
        echo "<td> {$row['batch_name']}</td>";
        echo "<td> {$row['course_name']}</td>";
        echo "<td> {$row['fee_instalment_amt']}</td>";
        echo "<td> {$row['fee_date']}</td>";
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