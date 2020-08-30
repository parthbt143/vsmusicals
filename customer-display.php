<html class="no-js" lang="en">
<?php include'headFile.php';
$headermsg ="Customers";?>
<body>
<div class="prtm-wrapper">
<?php include 'header.php'; ?>

<div class="prtm-main">
    <title>Customer List</title>
<?php include 'sidebar.php'; ?>
<div class="prtm-content-wrapper">
<div class="prtm-content">
  <!-- Contents Ahiya Lkhvana -->
  
  
 <?php
$q = mysqli_query($connection, "SELECT
     `tbl_customer`.`cust_address`
    , `tbl_customer`.`cust_email`
    , `tbl_customer`.`cust_mobile`
    , `tbl_customer`.`cust_gender`
    , `tbl_customer`.`cust_lname`
    , `tbl_customer`.`cust_fname`
    , `tbl_customer`.`cust_id`
    , `tbl_area`.`area_name`
FROM
    `db_vsm`.`tbl_area`
    INNER JOIN `db_vsm`.`tbl_customer` 
        ON (`tbl_area`.`area_id` = `tbl_customer`.`area_id`) where tbl_customer.is_delete='0';") or die(mysqli_error($connection));

 echo " <table class='table table-hover dataTable'  >";
echo "<tr>";
echo "<th> ID </th>";
echo "<th> First Name </th>";
echo "<th> Last Name </th>";
echo "<th> Gender </th>";
echo "<th> Email </th>";
echo "<th> Mobile </th>";
echo "<th> Address </th>";
echo "<th> Area </th>";

echo '<th>Action</th>';  
 while($row = mysqli_fetch_array($q))
    {
     {
       
        echo "<tr>";
        echo "<td> {$row['cust_id']} </td>";
        echo "<td> {$row['cust_fname']} </td>";
        echo "<td> {$row['cust_lname']} </td>";
        
        echo "<td> {$row['cust_gender']} </td>";
        echo "<td> {$row['cust_email']} </td>";
       
        
       
        echo "<td> {$row['cust_mobile']} </td>";
        echo "<td> {$row['cust_address']} </td>";
        echo "<td> {$row['area_name']} </td>";
         echo "<td> <a OnClick='return ConfirmDelete();' href='set-delete.php?did={$row['cust_id']}&tbl=tbl_customer&pk=cust_id&page=customer-display.php'><img src='images/delete.png'></a> </td>";
        echo "</tr>"; 
    }
    }


  
?>
</div>
</div>
</div>
</div>
<?php include'script.php'?>
</body>
</html>