<html class="no-js" lang="en">
<?php
    $headermsg="Product Photos";
    include'headFile.php';?>
<title>Product Photos</title>
<body>
<div class="prtm-wrapper">
<?php include 'header.php'; 
$headermsg ="Product Photos";
include 'confirm-delete.php';
?>

<div class="prtm-main">
<?php include 'sidebar.php'; ?>
<div class="prtm-content-wrapper">
    <title>Product Photos</title>
<div class="prtm-content">
  <!-- Contents Ahiya Lkhvana -->
 <a href="photo-insert.php"><button class="btn btn-primary btn-rounded" type="button"><img src='images/add.png'></button></a>
  <br><br>
  <?php
  $q = mysqli_query($connection,"SELECT
    `tbl_product`.`pro_name`
    , `tbl_photo`.`photo_id`
    , `tbl_photo`.`photo_path`
FROM
    `db_vsm`.`tbl_photo`
    INNER JOIN `db_vsm`.`tbl_product` 
        ON (`tbl_photo`.`pro_id` = `tbl_product`.`pro_id`) where tbl_photo.is_delete='0' ")or die(mysqli_errno($connection));
 
echo " <table class='table table-hover dataTable'  >";
echo "<tr>";
echo "<th> Id </th>";
echo "<th> Product </th>";
echo "<th> Photo </th>";
echo '<th>Action</th>';
  while($row = mysqli_fetch_array($q))
    {
        echo "<tr>";
        echo "<td> {$row['photo_id']} </td>";
        echo "<td> {$row['pro_name']} </td>";
        echo "<td> <a href='{$row['photo_path']}'> <img style='height:100;width:100;' src='{$row['photo_path']}'> </a></td>";       
        echo "<td><a  href='photo-edit.php?eid={$row['photo_id']}'><img src='images/edit1.png'></a> | <a OnClick='return ConfirmDelete();' href='set-delete.php?did={$row['photo_id']}&tbl=tbl_photo&pk=photo_id&page=photo-display.php'><img src='images/delete.png'></a> </td>";
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
