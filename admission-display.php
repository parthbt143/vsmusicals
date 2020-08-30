<html class="no-js" lang="en">
<?php include'headFile.php';
$headermsg ="Admissions"; ?>
<?php include'connection.php'?>
<body>
    <?php
    include 'confirm-delete.php';
    ?>
<div class="prtm-wrapper">
<?php include 'header.php'; ?>

<div class="prtm-main">
    <title>Admission</title>
    <?php include 'sidebar.php'; ?>
<div class="prtm-content-wrapper">
<div class="prtm-content">
  <!-- Contents Ahiya Lkhvana -->
  <a href="admission-insert.php"><button class="btn btn-primary btn-rounded" type="button"><img src='images/add.png'></button></a>
  <br><br>
 <?php
  $q = mysqli_query($connection,"SELECT
    `tbl_admission`.`adm_id`
    , `tbl_batch`.`batch_name`
    , `tbl_student`.`stud_fname`
    , `tbl_student`.`stud_lname`
    , `tbl_admission`.`fees_remaining`
    , `tbl_admission`.`fees_total`
    , `tbl_admission`.`fees_paid`
FROM
    `db_vsm`.`tbl_admission`
    INNER JOIN `db_vsm`.`tbl_student` 
        ON (`tbl_admission`.`stud_id` = `tbl_student`.`stud_id`)
    INNER JOIN `db_vsm`.`tbl_batch` 
        ON (`tbl_admission`.`batch_id` = `tbl_batch`.`batch_id`) where tbl_admission.is_delete='0'; ")or die(mysqli_errno($connection));

echo " <table class='table table-hover dataTable'  >";
echo "<tr>";
echo "<th> ID </th>";
echo "<th>  Name </th>";
echo "<th> Batch </th>";
echo "<th> Fees Paid </th>";
echo "<th> Fees Remaining </th>";
echo "<th> Fees Total </th>";

echo '<th>Action</th>';  
  while($row = mysqli_fetch_array($q))
    {
       
        echo "<tr>";
        echo "<td> {$row['adm_id']}</td>";
        echo "<td> {$row['stud_fname']} {$row['stud_lname']} </td>";
        echo "<td> {$row['batch_name']}</td>";
        echo "<td> {$row['fees_paid']}</td>";
        echo "<td> {$row['fees_remaining']}</td>";
        echo "<td> {$row['fees_total']}</td>";
        echo "<td><a  href='fees-insert.php?eid={$row['adm_id']}'><img src='images/add.png'>   </a> | <a OnClick='return ConfirmDelete();' href='set-delete.php?did={$row['adm_id']}&tbl=tbl_admission&pk=adm_id&page=admission-display.php'><img src='images/delete.png'></a> </td>";
      
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