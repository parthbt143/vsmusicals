 
<?php
include 'connection.php';
$q = mysqli_query($connection,"SELECT
    `tbl_customer`.`cust_id`
    , `tbl_customer`.`cust_fname`
    , `tbl_customer`.`cust_lname`
    , `tbl_customer`.`cust_gender`
    , `tbl_customer`.`cust_mobile`
    , `tbl_customer`.`cust_email`
    , `tbl_customer`.`cust_address`
    , `tbl_customer`.`cust_password`
    , `tbl_area`.`area_name`
FROM
    `db_vsm`.`tbl_area`
    INNER JOIN `db_vsm`.`tbl_customer` 
        ON (`tbl_area`.`area_id` = `tbl_customer`.`area_id`)")or die(mysqli_errno($connection));

echo " <table border='1' >";
echo "<tr>";
echo "<th> ID </th>";
echo "<th> First Name </th>";
echo "<th> Last Name </th>";
echo "<th> Gender </th>";
echo "<th> Mobile </th>";
echo "<th> Email </th>";
echo "<th> Address  </th>";
echo "<th> Area  </th>";
echo "<th> Password  </th>";

echo "<th>Action</th>";  
  while($row = mysqli_fetch_array($q))
    {
       
        echo "<tr>";
        echo "<td> {$row['cust_id']} </td>";
        echo "<td> {$row['cust_fname']} </td>";
        echo "<td> {$row['cust_lname']} </td>";
        echo "<td> {$row['cust_gender']} </td>";
        echo "<td> {$row['cust_mobile']} </td>";
        echo "<td> {$row['cust_email']} </td>";
        echo "<td> {$row['cust_address']} </td>";
        echo "<td> {$row['area_name']} </td>";
        echo "<td> {$row['cust_password']} </td>";
        echo "<td> <a OnClick='return ConfirmDelete();' href='customer-delete.php?did={$row['cust_id']}'><img src='images/delete.png'></a> </td>";
        echo "</tr>"; 
    }
echo "</tr>";
echo "</table>";
?>
 