<html class="no-js" lang="en">
<?php include'headFile.php'?>
<body>
<div class="prtm-wrapper"> 
<?php include 'header.php';
include'connection.php';
?>

<div class="prtm-main">
<?php include 'sidebar.php'; ?>
<div class="prtm-content-wrapper">
<div class="prtm-content">
  <!-- Contents Ahiya Lkhvana -->
  <?php
  $q = mysqli_query($connection,"SELECT
    `tbl_employee`.`emp_id`
    , `tbl_employee`.`emp_name`
    , `tbl_employee`.`emp_gender`
    , `tbl_employee`.`emp_mobile`
    , `tbl_employee`.`emp_address`
    , `tbl_employee`.`salary`
    , `tbl_designation`.`des_name`
    , `tbl_area`.`area_name`
FROM
    `db_vsm`.`tbl_designation`
    INNER JOIN `db_vsm`.`tbl_employee` 
        ON (`tbl_designation`.`des_id` = `tbl_employee`.`des_id`)
    INNER JOIN `db_vsm`.`tbl_area` 
        ON (`tbl_area`.`area_id` = `tbl_employee`.`area_id`); ")or die(mysqli_errno($connection));
  
  while ($row = mysqli_fetch_array($q)) {
      
  
  echo"<div class='prtm-block fw-light> ";
  echo"<div class='prtm-block fw-light'>";
  echo"<div class='clearfix'>";
  echo"<div class='thumb-wid pull-left mrgn-r-md'> <img class='img-responsive img-circle' src='images/parth.jpg' width='107' height='107' alt='Ahiya Pic'> </div>";
  echo"<div class='thumb-content pull-left'>";
  echo"<h6 class='fw-bold base-dark'> {$row['emp_name']}  </h6>";
  echo"<p><span><i class='fa fa-black-tie mrgn-r-xs' aria-hidden='true'></i></span> {$row['emp_address']} </p>";
  echo"<p><span><i class='fa fa-map-marker mrgn-r-xs' aria-hidden='true'></i></span> {$row['area_name']}</p>";
  echo"<p><span><i class='fa fa-black-tie mrgn-r-xs' aria-hidden='true'></i></span> {$row['des_name']} </p>";
  echo"<p><span><i class='fa fa-black-tie mrgn-r-xs' aria-hidden='true'></i></span> {$row['emp_gender']} </p>";
  echo"<p><span><i class='fa fa-black-tie mrgn-r-xs' aria-hidden='true'></i></span> {$row['emp_mobile']} </p>";
  echo"<p><span><i class='fa fa-black-tie mrgn-r-xs' aria-hidden='true'></i></span> {$row['salary']} </p>";
  echo"<a  href='employee-edit.php?eid={$row['emp_id']}'><img src='images/edit.png'>   </a> | <a OnClick='return ConfirmDelete();' href='employee-delete.php?did={$row['emp_id']}'><img src='images/delete.png'></a> ";
  echo"</div>";
  echo"</div>";
  echo"</div>";
  }
  ?>
  
 

</div>
</div>
</div>
</div>
<?php include'script.php'?>
</body>
</html>