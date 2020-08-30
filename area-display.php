<html class="no-js" lang="en">
<?php include'headFile.php';
$headermsg ="Area";

  ?>
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
  <a href="area-insert.php"><button class="btn btn-primary btn-rounded" type="button"><img src='images/add.png'></button></a>
  <br><br>
  <?php
  $q = mysqli_query($connection,"select * from tbl_area where is_delete='0'")or die(mysqli_errno($connection));
 
echo " <table class='table table-hover dataTable'  >";
echo "<tr>";
echo "<th> Id </th>";
echo "<th> Name </th>";
echo '<th>Action</th>';
  while($row = mysqli_fetch_array($q))
    {
        echo "<tr>";
        echo "<td> {$row['area_id']} </td>";
        echo "<td> {$row['area_name']} </td>";
        echo "<td><a  href='area-edit.php?eid={$row['area_id']}'><img src='images/edit1.png'> </a> | <a OnClick='return ConfirmDelete();' href='set-delete.php?did={$row['area_id']}&tbl=tbl_area&pk=area_id&page=area-display.php'><img src='images/delete.png'></a> </td>";
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