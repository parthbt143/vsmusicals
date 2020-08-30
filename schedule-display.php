<html class="no-js" lang="en">
<?php 

$headermsg ="Schedules";
include'headFile.php';?>
<?php include'connection.php'?>
<body>
    <?php
    include 'confirm-delete.php';
    ?>
<div class="prtm-wrapper">
<?php include 'header.php'; ?>

<div class="prtm-main">
<?php include 'sidebar.php'; ?>
<div class="prtm-content-wrapper">
<div class="prtm-content">
  <!-- Contents Ahiya Lkhvana -->
  <a href="schedule-insert.php"><button class="btn btn-primary btn-rounded" type="button"><img src='images/add.png'></button></a>
  <br><br>
  <?php
  $q = mysqli_query($connection,"SELECT
    `tbl_batch`.`batch_name`
    , `tbl_schedule`.`s_id`
    , `tbl_schedule`.`s_day`
    , `tbl_schedule`.`s_start`
    , `tbl_schedule`.`s_end`
FROM
    `db_vsm`.`tbl_batch`
    INNER JOIN `db_vsm`.`tbl_schedule` 
        ON (`tbl_batch`.`batch_id` = `tbl_schedule`.`batch_id`) where tbl_schedule.is_delete='0' ")or die(mysqli_errno($connection));

echo " <table class='table table-hover dataTable'  >";
echo "<tr>";
echo "<th> ID </th>";
echo "<th> Batch Name </th>";
echo "<th> Day </th>";
echo "<th> Start Time </th>";
echo "<th> End Time </th>";

echo '<th>Action</th>';  
  while($row = mysqli_fetch_array($q))
    {
       
        echo "<tr>";
        echo "<td> {$row['s_id']} </td>";
        echo "<td> {$row['batch_name']} </td>";
        echo "<td> {$row['s_day']} </td>";
        echo "<td> {$row['s_start']} </td>";
        echo "<td> {$row['s_end']} </td>";
        echo "<td> <a OnClick='return ConfirmDelete();' href='set-delete.php?did={$row['s_id']}&tbl=tbl_schedule&pk=s_id&page=schedule-display.php'><img src='images/delete.png'></a> </td>";
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