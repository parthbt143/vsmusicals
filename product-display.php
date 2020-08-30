 <html class="no-js" lang="en">
<?php include'headFile.php'?>
<?php include'connection.php';
$headermsg ="Products";

?>
<body>
    <?php
    include 'confirm-delete.php';
    ?>
<div class="prtm-wrapper">
    <title> Product List</title>
<?php include 'header.php'; ?>

<div class="prtm-main">
<?php include 'sidebar.php'; ?>
<div class="prtm-content-wrapper">
<div class="prtm-content">
  <!-- Contents Ahiya Lkhvana -->
  <a href="product-insert.php"><button class="btn btn-primary btn-rounded" type="button"><img src='images/add.png'></button></a>
  <br><br>
  <?php
  $q = mysqli_query($connection,"SELECT
    `tbl_company`.`com_name`
    , `tbl_sub_category`.`sc_name`
    , `tbl_product`.`pro_id`
    , `tbl_product`.`pro_name`
    , `tbl_product`.`pro_details`
    , `tbl_product`.`pro_price`
    , `tbl_product`.`pro_warranty`
    , `tbl_product`.`pro_service`
    , `tbl_product`.`pro_service_price`
    , `tbl_product`.`pro_photo`
    , `tbl_product`.`pro_stock`
    , `tbl_offer`.`of_discount`
FROM
    `db_vsm`.`tbl_company`
    INNER JOIN `db_vsm`.`tbl_product` 
        ON (`tbl_company`.`com_id` = `tbl_product`.`com_id`)
    INNER JOIN `db_vsm`.`tbl_sub_category` 
        ON (`tbl_sub_category`.`sc_id` = `tbl_product`.`sc_id`) 
    INNER JOIN `db_vsm`.`tbl_offer` 
        ON (`tbl_offer`.`of_id` = `tbl_product`.`of_id`) where tbl_product.is_delete='0' order by(pro_id) ; ")or die(mysqli_errno($connection));

echo " <table class='table table-hover dataTable'  >";
echo "<tr>";
echo "<th> ID </th>";
echo "<th> Photo </th>";
echo "<th> Product Name </th>";
echo "<th> Sub Category </th>";
echo "<th> Company </th>";
echo "<th> Price </th>";
echo "<th> Warranty </th>";
echo "<th> Offer Discount </th>";
echo "<th> Service Price </th>";
echo "<th> Stock </th>";

echo '<th>Action</th>';  
  while($row = mysqli_fetch_array($q))
    {
       
        echo "<tr>";
        echo "<td> {$row['pro_id']} </td>";
        echo "<td> <a href='{$row['pro_photo']}'> <img style='height:100;width:100;' src='{$row['pro_photo']}'> </a></td>";
        echo "<td> {$row['pro_name']} </td>";
        echo "<td> {$row['sc_name']} </td>";
        echo "<td> {$row['com_name']} </td>";
        echo "<td> {$row['pro_price']} </td>";
        echo "<td> {$row['pro_warranty']} </td>";
        echo "<td> {$row['of_discount']} % </td>";
        echo "<td> {$row['pro_service_price']} </td>";
        echo "<td> {$row['pro_stock']} </td>";
        echo "<td><a  href='product-edit.php?eid={$row['pro_id']}'><img src='images/edit1.png'>   </a> | <a OnClick='return ConfirmDelete();' href='set-delete.php?did={$row['pro_id']}&tbl=tbl_product&pk=pro_id&page=product-display.php'><img src='images/delete.png'></a> </td>";
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
