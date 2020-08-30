<html class="no-js" lang="en">
<?php include'headFile.php';

$headermsg ="Sub Categories";
?>
<?php include'connection.php'?>
<body>
    <?php
    include 'confirm-delete.php';
    ?>
<div class="prtm-wrapper">
    <title> Sub Category List </title>  
<?php include 'header.php'; ?>

<div class="prtm-main">
<?php include 'sidebar.php'; ?>
<div class="prtm-content-wrapper">
<div class="prtm-content">
  <!-- Contents Ahiya Lkhvana -->
  <a href="sub-cat-insert.php"><button class="btn btn-primary btn-rounded" type="button"><img src='images/add.png'></button></a>
  <br><br>
  <?php
  $q = mysqli_query($connection,"SELECT
    `tbl_category`.`cat_name`
    , `tbl_sub_category`.`sc_id`
    , `tbl_sub_category`.`sc_name`
FROM
    `db_vsm`.`tbl_category`
    INNER JOIN `db_vsm`.`tbl_sub_category` 
        ON (`tbl_category`.`cat_id` = `tbl_sub_category`.`cat_id`) where tbl_sub_category.is_delete='0' ")or die(mysqli_errno($connection));

echo " <table class='table table-hover dataTable'  >";
echo "<tr>";
echo "<th> Id </th>";
echo "<th> Category </th>";
echo "<th> Sub Category </th>";
echo '<th>Action</th>';  
  while($row = mysqli_fetch_array($q))
    {
       
        echo "<tr>";
        echo "<td> {$row['sc_id']} </td>";
        echo "<td> {$row['cat_name']} </td>";
        echo "<td> {$row['sc_name']} </td>";
        echo "<td><a  href='sub-cat-edit.php?eid={$row['sc_id']}'><img src='images/edit1.png'>   </a> | <a OnClick='return ConfirmDelete();' href='set-delete.php?did={$row['sc_id']}&tbl=tbl_sub_category&pk=sc_id&page=sub-cat-display.php'><img src='images/delete.png'></a> </td>";
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