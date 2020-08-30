
<html class="no-js" lang="en">
    <?php 
$headermsg ="Purchase";
include'headFile.php'; ?>
    <body>
        <div class="prtm-wrapper">
            <?php include 'header.php'; ?>

            <div class="prtm-main">
                <?php include 'sidebar.php'; ?>
                <div class="prtm-content-wrapper">
                    <div class="prtm-content">
                        <!-- Contents Ahiya Lkhvana -->
  <a href="purchase-insert.php"><button class="btn btn-primary btn-rounded" type="button"><img src='images/add.png'></button></a>
  <br><br>
                        <?php
                        $q = mysqli_query($connection, "SELECT
    `tbl_purchase`.`pur_id`
    , `tbl_supplier`.`sup_name`
    , `tbl_purchase`.`pur_invoice_no`
    , `tbl_purchase`.`pur_date`
    , `tbl_purchase`.`pur_amt`
FROM
    `db_vsm`.`tbl_purchase`
    INNER JOIN `db_vsm`.`tbl_supplier` 
        ON (`tbl_purchase`.`sup_id` = `tbl_supplier`.`sup_id`) where  tbl_purchase.is_delete='0'")or die(mysqli_errno($connection));

                        echo " <table class='table table-hover dataTable'  >";
                        echo "<tr>";
                        echo "<th> ID </th>";
                        echo "<th> Date </th>";
                        echo "<th> Supplier Name </th>";
                        echo "<th> Invoice No </th>";
                        echo "<th> View Details </th>";
                        while ($row = mysqli_fetch_array($q)) {

                            echo "<tr>";
                            echo "<td> {$row['pur_id']} </td>";
                            echo "<td> {$row['pur_date']} </td>";
                            echo "<td> {$row['sup_name']} </td>";
                            echo "<td> {$row['pur_invoice_no']} </td>";
                            echo "<td> <a href='purchase-details-display.php?id={$row['pur_id']}'> Details </a></td>";
                            echo "</tr>";
                        }
                        echo "</tr>";
                        echo "</table>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include'script.php' ?>
    </body>
</html>
