<html class="no-js" lang="en">
<?php include'headFile.php';

$headermsg ="Frequently Asked Questions";?>
<?php include'connection.php'?>
<body>
    <?php
    include 'confirm-delete.php';
    ?>
<div class="prtm-wrapper">
    <title>FAQs</title>
<?php include 'header.php'; ?>

<div class="prtm-main">
<?php include 'sidebar.php'; ?>
<div class="prtm-content-wrapper">
<div class="prtm-content">
  <!-- Contents Ahiya Lkhvana -->
  <a href="faq-insert.php"><button class="btn btn-primary btn-rounded" type="button"><img src='images/add.png'></button></a>
  <br><br>
  <?php
  $q = mysqli_query($connection,"SELECT
    `tbl_faq`.`faq_id`
    , `tbl_product`.`pro_name`
    , `tbl_faq`.`faq_que`
    , `tbl_faq`.`faq_ans`
FROM
    `db_vsm`.`tbl_product`
    INNER JOIN `db_vsm`.`tbl_faq` 
        ON (`tbl_product`.`pro_id` = `tbl_faq`.`pro_id`) where tbl_faq.is_delete='0'; ")or die(mysqli_errno($connection));
 
echo " <table  >";
echo "<tr>";
echo "<th> Id </th>";
echo "<th> Product </th>";
echo "<th> Question </th>";
echo "<th> Answer </th>";
echo '<th>Action</th>';
  while($row = mysqli_fetch_array($q))
    {
        echo "<tr>";
        echo "<td> {$row['faq_id']} </td>";
        echo "<td> {$row['pro_name']} </td>";
        echo "<td> {$row['faq_que']} </td>";
        echo "<td> {$row['faq_ans']} </td>";
        echo "<td> <a OnClick='return ConfirmDelete();' href='set-delete.php?did={$row['faq_id']}&tbl=tbl_faq&pk=faq_id&page=faq-display.php'><img src='images/delete.png'></a> </td>";
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