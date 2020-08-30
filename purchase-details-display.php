<html class="no-js" lang="en">
    <?php 
    
$headermsg ="Purchase Details";
include'headFile.php'; ?>
    <body>
        <div class="prtm-wrapper">
            <?php include 'header.php'; ?>

            <div class="prtm-main">
                <?php include 'sidebar.php'; ?>
                <div class="prtm-content-wrapper">
                    <div class="prtm-content">
                        <?php
                        if (!isset($_GET['id']) || empty($_GET['id'])) {

                            header("location:purchase-display.php");
                        }
                        $id = $_GET['id'];
                        $q = mysqli_query($connection, " SELECT
    `tbl_product`.`pro_name`
    , `tbl_purchase_detail`.`pro_quantity`
    , `tbl_purchase_detail`.`pro_price`
    , `tbl_purchase_detail`.`pd_total`
FROM
    `db_vsm`.`tbl_purchase_detail`
    INNER JOIN `db_vsm`.`tbl_product` 
        ON (`tbl_purchase_detail`.`pro_id` = `tbl_product`.`pro_id`) where tbl_purchase_detail.pur_id='{$id}' ")or die(mysqli_errno($connection));

                        echo " <table class='table table-hover dataTable'  >";
                        echo "<tr>";
                        echo "<th> Index     </th>";
                        echo "<th> Product </th>";

                        echo "<th> Quantity </th>";
                        $a = 1;
                        while ($row = mysqli_fetch_array($q)) {

                            echo "<tr>";
                            echo "<td> $a </td>";
                            echo "<td> {$row['pro_name']} </td>";
                            echo "<td> {$row['pro_quantity']} </td>";
                            $a++;
                            echo "</tr>";
                        }
                        echo "</tr>";
                        echo "</table>";
                        ?>
                        <a href="purchase-display.php">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <?php include'script.php' ?>
    </body>
</html>
