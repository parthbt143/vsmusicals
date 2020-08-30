<html class="no-js" lang="en">
<?php include'headFile.php';

$headermsg ="Ratings And Reviews";
  ?>
<?php include'connection.php'?>
<body>
    <?php
    include 'confirm-delete.php';
    ?>
<div class="prtm-wrapper">
<?php include 'header.php'; ?>

<div class="prtm-main">
    <title>
        Ratings And Review
    </title>
<?php include 'sidebar.php'; ?>
<div class="prtm-content-wrapper">
<div class="prtm-content">
  <!-- Contents Ahiya Lkhvana -->
  
  <?php
  $q = mysqli_query($connection,"SELECT
    `tbl_customer`.`cust_fname`
    , `tbl_customer`.`cust_lname`
    , `tbl_product`.`pro_name`
    , `tbl_ratings_and_review`.`rating`
    , `tbl_ratings_and_review`.`review`
    , `tbl_ratings_and_review`.`rr_id`
FROM
    `db_vsm`.`tbl_customer`
    INNER JOIN `db_vsm`.`tbl_ratings_and_review` 
        ON (`tbl_customer`.`cust_id` = `tbl_ratings_and_review`.`cust_id`)
    INNER JOIN `db_vsm`.`tbl_product` 
        ON (`tbl_product`.`pro_id` = `tbl_ratings_and_review`.`pro_id`) where tbl_ratings_and_review.is_delete='0'; ")or die(mysqli_errno($connection));
 
echo " <table class='table table-hover dataTable'  >";
echo "<tr>";
echo "<th> Id </th>";
echo "<th> Product </th>";
echo "<th> Customer  </th>";
echo "<th> Rating </th>";
echo "<th> Review </th>";
echo '<th>Action</th>';
  while($row = mysqli_fetch_array($q))
    {
        echo "<tr>";
        echo "<td> {$row['rr_id']} </td>";
        echo "<td> {$row['pro_name']} </td>";
        echo "<td> {$row['cust_fname']} " ."{$row['cust_lname']} </td>";
        echo "<td> {$row['rating']} </td>";
        echo "<td> {$row['review']} </td>";
        echo "<td>| <a OnClick='return ConfirmDelete();' href='set-delete.php?did={$row['rr_id']}&tbl=tbl_ratings_and_review&pk=rr_id&page=rating-and-review-display.php'><img src='images/delete.png'></a> </td>";
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