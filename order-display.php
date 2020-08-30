s
<html class="no-js" lang="en">
    <?php 
$headermsg ="Orders";
    include'headFile.php'; ?>
    <body>
        <div class="prtm-wrapper">
            <?php include 'header.php'; ?>
<title> Orders </title>
            <div class="prtm-main">
                <?php include 'sidebar.php'; ?>
                <div class="prtm-content-wrapper">
                    <div class="prtm-content">
                        <!-- Contents Ahiya Lkhvana -->
                        <a href="order-insert.php"><button class="btn btn-primary btn-rounded" type="button"><img src='images/add.png'></button></a>
                        <br><br>
                        <?php
                        $q = mysqli_query($connection, " SELECT
    `tbl_customer`.`cust_fname`
    , `tbl_order`.`order_id`
    , `tbl_order`.`order_date`
    , `tbl_order`.`receiver_name`
    , `tbl_order`.`receiver_address`
    , `tbl_order`.`receiver_mobile`
    , `tbl_order`.`order_is_offline`
    , `tbl_order`.`order_status`
    , `tbl_order`.`order_total`
FROM
    `db_vsm`.`tbl_customer`
    INNER JOIN `db_vsm`.`tbl_order` 
        ON (`tbl_customer`.`cust_id` = `tbl_order`.`cust_id`) where tbl_order.is_delete=0 ;")or die(mysqli_errno($connection));

                        echo " <table class='table table-hover dataTable'  >";
                        echo "<tr>";
                        echo "<th> ID </th>";
                        echo "<th> Date </th>";

                        echo "<th> Customer Name </th>";
                        echo "<th> Receiver Name </th>";


                        echo "<th> Mobile No </th>";
                        echo "<th> Address </th>";
                        echo "<th> Offline </th>";
                        echo "<th> Status </th>";
                        echo "<th> Total </th>";
                        echo "<th> View Details </th>";
                        while ($row = mysqli_fetch_array($q)) {

                            echo "<tr>";
                            echo "<td> {$row['order_id']} </td>";
                            echo "<td> {$row['order_date']} </td>";
                            echo "<td> {$row['cust_fname']} </td>";
                            echo "<td> {$row['receiver_name']} </td>";
                            echo "<td> {$row['receiver_mobile']} </td>";
                            echo "<td> {$row['receiver_address']} </td>";
                                          if ($row['order_is_offline'] == 1 ){
                                           echo "<td> Yes </td>";
                                          }else
                                          {
                                           echo "<td> No  </td>";
                                          }
                           
                            echo "<td> {$row['order_status']} <br> <a  href='order-status-change.php?eid={$row['order_id']}'><img src='images/edit1.png'></a>  </td>";
                            echo "<td> {$row['order_total']} </td>";
                            echo "<td> <a href='order-details-display.php?id={$row['order_id']}'> Details </a></td>";
                           
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
