 <html class="no-js" lang="en">
<?php include'headFile.php';

$headermsg ="Estimation Requestes";?>
<?php include'connection.php';

?>
<body>
    <?php
    include 'confirm-delete.php';
    ?>
<div class="prtm-wrapper">
    <title>  Estimation </title>
<?php include 'header.php'; ?>

<div class="prtm-main">
<?php include 'sidebar.php'; ?>
<div class="prtm-content-wrapper">
<div class="prtm-content">
  <!-- Contents Ahiya Lkhvana -->
  <?php
  $q = mysqli_query($connection," SELECT
    `tbl_product`.`pro_name`
    , `tbl_customer`.`cust_fname`
    , `tbl_customer`.`cust_lname`
    , `tbl_estimation`.`est_id`
    , `tbl_estimation`.`est_title`
    , `tbl_estimation`.`est_description`
    , `tbl_estimation`.`est_photo1`
    , `tbl_estimation`.`est_photo2`
    , `tbl_estimation`.`est_reply`
FROM
    `db_vsm`.`tbl_estimation`
    INNER JOIN `db_vsm`.`tbl_customer` 
        ON (`tbl_estimation`.`cust_id` = `tbl_customer`.`cust_id`)
    INNER JOIN `db_vsm`.`tbl_product` 
        ON (`tbl_product`.`pro_id` = `tbl_estimation`.`pro_id`) where tbl_estimation.is_delete='0'; ")or die(mysqli_errno($connection));

echo " <table class='table table-hover dataTable'  >";
echo "<tr>";
echo "<th> ID </th>";
echo "<th> Customer Name </th>";
echo "<th> Product    </th>";
echo "<th> Title  </th>";
echo "<th> Description   </th>";
echo "<th> Photo 1  </th>";
echo "<th> Photo 2  </th>";
echo "<th> Reply  </th>";
 
  while($row = mysqli_fetch_array($q))
    {
       
        echo "<tr>";
        echo "<td> {$row['est_id']} </td>";
        echo "<td> {$row['cust_fname']} {$row['cust_lname']} </td>";
        echo "<td> {$row['pro_name']} </td>";
        echo "<td> {$row['est_title']} </td>";
        echo "<td> {$row['est_description']} </td>";
        echo "<td> <a href='{$row['est_photo1']}'> <img style='height:100;width:100;' alt='Not Available' src='{$row['est_photo1']}'> </a></td>";
        echo "<td> <a href='{$row['est_photo2']}'> <img style='height:100;width:100;' alt='Not Available' src='{$row['est_photo2']}'> </a></td>";
        echo "<td>";  if(($row['est_reply'] == '')) {
            echo "<a  href='estimation-reply.php?eid={$row['est_id']}'><img src='images/edit1.png'>   </a> </td>" ;
        }
        else{
            echo " {$row['est_reply']} </td>";
        }
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