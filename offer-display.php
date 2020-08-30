<html class="no-js" lang="en">
<?php
$headermsg ="Offers";

include'headFile.php';?>
<?php include'connection.php'?>
<body>
    <?php
    include 'confirm-delete.php';
    ?>
<div class="prtm-wrapper">
     <title>Offer List</title>
<?php include 'header.php'; ?>

<div class="prtm-main">
<?php include 'sidebar.php'; ?>
<div class="prtm-content-wrapper">
<div class="prtm-content">
  <!-- Contents Ahiya Lkhvana -->
  <a href="offer-insert.php"><button class="btn btn-primary btn-rounded" type="button"><img src='images/add.png'></button></a>
  <br><br>
  <?php
  $q = mysqli_query($connection,"select * from tbl_offer where is_delete='0' AND of_id  != '1' ")or die(mysqli_errno($connection));

echo " <table class='table table-hover dataTable'  >";
echo "<tr>";
echo "<th> ID </th>";
echo "<th> Name </th>";
echo "<th> Details </th>";
echo "<th> Discount </th>";

echo '<th>Action</th>';  
  while($row = mysqli_fetch_array($q))
    {
       
        echo "<tr>";
        echo "<td> {$row['of_id']} </td>";
        echo "<td> {$row['of_name']} </td>";
        echo "<td> {$row['of_details']} </td>";
        echo "<td> {$row['of_discount']} % </td>";
        echo "<td><a  href='offer-edit.php?eid={$row['of_id']}'><img src='images/edit1.png'>   </a> | <a OnClick='return ConfirmDelete();' href='set-delete.php?did={$row['of_id']}&tbl=tbl_offer&pk=offer_id&page=offer-display.php'><img src='images/delete.png'></a> </td>";
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