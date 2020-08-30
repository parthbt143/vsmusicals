<html class="no-js" lang="en">
<?php 
$headermsg ="Suppliers";
include'headFile.php';?>
<?php include'connection.php'?>
<body>
    <?php
    include 'confirm-delete.php';
    ?>
<div class="prtm-wrapper">
    <title> Supplier List </title>  
<?php include 'header.php'; ?>

<div class="prtm-main">
<?php include 'sidebar.php'; ?>
<div class="prtm-content-wrapper">
<div class="prtm-content">
  <!-- Contents Ahiya Lkhvana -->
  <a href="supplier-insert.php"><button class="btn btn-primary btn-rounded" type="button"><img src='images/add.png'></button></a>
  <br><br>
  <?php
  $q = mysqli_query($connection," SELECT
    `tbl_supplier`.`sup_id`
    , `tbl_supplier`.`sup_name`
    , `tbl_supplier`.`sup_mobile`
    , `tbl_supplier`.`sup_address`
    , `tbl_area`.`area_name`
FROM
    `db_vsm`.`tbl_area`
    INNER JOIN `db_vsm`.`tbl_supplier` 
        ON (`tbl_area`.`area_id` = `tbl_supplier`.`area_id`) where tbl_supplier.is_delete='0'")or die(mysqli_errno($connection));

echo " <table class='table table-hover dataTable'  >";
echo "<tr>";
echo "<th> Id </th>";
echo "<th> Supplier Name </th>";
echo "<th> Mobile </th>";
echo "<th> Address </th>";
echo "<th> Area  </th>";
echo '<th>Action</th>';  
  while($row = mysqli_fetch_array($q))
    {
       
        echo "<tr>";
        echo "<td> {$row['sup_id']} </td>";
        echo "<td> {$row['sup_name']} </td>";
        echo "<td> {$row['sup_mobile']} </td>";
        echo "<td> {$row['sup_address']} </td>";
        echo "<td> {$row['area_name']} </td>";
        echo "<td><a  href='supplier-edit.php?eid={$row['sup_id']}'><img src='images/edit1.png'>   </a> | <a OnClick='return ConfirmDelete();' href='set-delete.php?did={$row['sup_id']}&tbl=tbl_supplier&pk=sup_id&page=sub-cat-display.php'><img src='images/delete.png'></a> </td>";
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