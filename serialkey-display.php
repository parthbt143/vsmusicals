<html class="no-js" lang="en">
<?php 
$headermsg ="Serial Keys";
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
  <a href="serialkey-insert.php"><button class="btn btn-primary btn-rounded" type="button"><img src='images/add.png'></button></a>
  <br><br>
  <?php
  $q = mysqli_query($connection,"SELECT
    `tbl_product`.`pro_name`
    , `tbl_serial_no`.`sn_id`
    , `tbl_serial_no`.`sn_num`
    , `tbl_serial_no`.`sn_sold`
FROM
    `db_vsm`.`tbl_product`
    INNER JOIN `db_vsm`.`tbl_serial_no` 
        ON (`tbl_product`.`pro_id` = `tbl_serial_no`.`pro_id`) where tbl_serial_no.is_delete='0';")or die(mysqli_errno($connection));

echo " <table class='table table-hover dataTable'  >";
echo "<tr>";
echo "<th> Id </th>";
echo "<th> Product </th>";
echo "<th> Serial Num </th>";
echo "<th> Sold </th>";
echo '<th>Action</th>';  
  while($row = mysqli_fetch_array($q))
    {
       
        echo "<tr>";
        echo "<td> {$row['sn_id']} </td>";
        echo "<td> {$row['pro_name']} </td>";
        echo "<td> {$row['sn_num']} </td>";
        echo "<td> {$row['sn_sold']} </td>";
        echo "<td><a  href='serialkey-edit.php?eid={$row['sn_id']}'><img src='images/edit1.png'>   </a>| <a OnClick='return ConfirmDelete();' href='set-delete.php?did={$row['sn_id']}&tbl=tbl_serial_no&pk=sn_id&page=serialkey-display.php'><img src='images/delete.png'></a> </td>";
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