<html class="no-js" lang="en">
<?php include'headFile.php' ;
$headermsg ="Batch";
include'connection.php';
  ?>
<body>
    <?php
    include 'confirm-delete.php';
    ?>
<div class="prtm-wrapper">
<?php include 'header.php'; ?>

<div class="prtm-main">
    <title> Batch List </title>
<?php include 'sidebar.php'; ?>
<div class="prtm-content-wrapper">
<div class="prtm-content">
  <!-- Contents Ahiya Lkhvana -->
  <a href="batch-insert.php"><button class="btn btn-primary btn-rounded" type="button"><img src='images/add.png'></button>
      <br><br>
  <?php
  $q = mysqli_query($connection,"SELECT
    `tbl_course`.`course_name`
    , `tbl_employee`.`emp_name`
    , `tbl_batch`.`batch_id`
    , `tbl_batch`.`batch_name`
FROM
    `db_vsm`.`tbl_course`
    INNER JOIN `db_vsm`.`tbl_batch` 
        ON (`tbl_course`.`course_id` = `tbl_batch`.`course_id`)
    INNER JOIN `db_vsm`.`tbl_employee` 
        ON (`tbl_employee`.`emp_id` = `tbl_batch`.`emp_id`) where tbl_batch.is_delete='0'; ")or die(mysqli_errno($connection));
 
echo " <table class='table table-hover dataTable' 
    >";
echo "<tr>";
echo "<th> Id </th>";
echo "<th> Name </th>";
echo "<th> Course </th>";
echo "<th> Employee </th>";
echo '<th>Action</th>';
  while($row = mysqli_fetch_array($q))
    {
        echo "<tr>";
        echo "<td> {$row['batch_id']} </td>";
        echo "<td> {$row['batch_name']} </td>";
        echo "<td> {$row['course_name']} </td>";
        echo "<td> {$row['emp_name']} </td>";
        echo "<td><a  href='batch-edit.php?eid={$row['batch_id']}'><img src='images/edit1.png'></a> | <a OnClick='return ConfirmDelete();' href='set-delete.php?did={$row['batch_id']}&tbl=tbl_batch&pk=batch_id&page=batch-display.php'><img src='images/delete.png'></a> </td>";
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