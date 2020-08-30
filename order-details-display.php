<html class="no-js" lang="en">
    <title>Order Details </title>
    <?php
$headermsg ="Order Details";
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

                            header("location:order-display.php");
                        }
                        $orderid = $_GET['id'];
                        $q = mysqli_query($connection, "SELECT
    `tbl_order_details`.`od_id`
    , `tbl_product`.`pro_name`
    , `tbl_order_details`.`pro_quantity`
    , `tbl_order_details`.`pro_price`
    , `tbl_order_details`.`od_total`
FROM
    `db_vsm`.`tbl_product`
    INNER JOIN `db_vsm`.`tbl_order_details` 
        ON (`tbl_product`.`pro_id` = `tbl_order_details`.`pro_id`) where tbl_order_details.order_id='{$orderid}' AND tbl_order_details.is_delete='0'")or die(mysqli_errno($connection));

                        echo " <table class='table table-hover dataTable'  >";
                        echo "<tr>";
                        echo "<th> ID </th>";
                        echo "<th> Product </th>";

                        echo "<th> Quantity </th>";

                        echo "<th> Product Price</th>";

                        echo "<th> Total </th>";
                        while ($row = mysqli_fetch_array($q)) {

                            echo "<tr>";
                            echo "<td> {$row['od_id']} </td>";
                            echo "<td> {$row['pro_name']} </td>";
                            echo "<td> {$row['pro_quantity']} </td>";
                            echo "<td> {$row['pro_price']} </td>";
                            echo "<td> {$row['od_total']} </td>";
                            
                            echo "</tr>";
                        }
                        echo "</tr>";
                        echo "</table>";
                        ?>
                        <a href="order-display.php">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <?php include'script.php' ?>
    </body>
</html>