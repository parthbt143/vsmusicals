<html class="no-js" lang="en">
<?php include'headFile.php';

$headermsg ="Courses"; 
include'connection.php'?>
<body>
    <?php
    include 'confirm-delete.php';
    ?>
<div class="prtm-wrapper">
<?php include 'header.php'; ?>

<div class="prtm-main">
    <title>Course List</title>
<?php include 'sidebar.php'; ?>
<div class="prtm-content-wrapper">
<div class="prtm-content">
  <!-- Contents Ahiya Lkhvana -->
  <a href="course-insert.php"><button class="btn btn-primary btn-rounded" type="button"><img src='images/add.png'></button></a>
  <br><br>
  <?php
  $q = mysqli_query($connection,"select * from tbl_course where is_delete='0'")or die(mysqli_errno($connection));
 
echo " <table class='table table-hover dataTable'  >";
echo "<tr>";
echo "<th> Id </th>";
echo "<th> Name </th>";
echo "<th> Duration </th>";
echo "<th> Fees</th>";
echo '<th>Action</th>';
  while($row = mysqli_fetch_array($q))
    {
        echo "<tr>";
        echo "<td> {$row['course_id']} </td>";
        echo "<td> {$row['course_name']} </td>";
        echo "<td> {$row['course_duration']} Months </td>";
        echo "<td> {$row['course_fee']} </td>";
        echo "<td><a  href='course-edit.php?eid={$row['course_id']}'><img src='images/edit1.png'> </a> | <a OnClick='return ConfirmDelete();' href='set-delete.php?did={$row['course_id']}&tbl=tbl_course&pk=course_id&page=course-display.php'><img src='images/delete.png'></a> </td>";
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