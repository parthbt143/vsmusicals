<html class="no-js" lang="en">
    <title> Order Details Insert </title>   
    <?php
$headermsg ="Insert Order Details";
    include'headFile.php';
    $msg = "";
    ?>
    <body>
        <div class="prtm-wrapper">
            <?php
            include 'header.php';

            if (!isset($_GET['eid']) || empty($_GET['eid'])) {

                header("location:order-insert.php");
            }
            $id = $_GET['eid'];

            $selectq = mysqli_query($connection, "select * from tbl_order where order_id='{$id}'") or die(mysqli_error($connection));
            $selectrow = mysqli_fetch_array($selectq);

            if (isset($_POST['insert'])) {

                $oid = mysqli_real_escape_string($connection, $_POST['oid']);
                $pro = mysqli_real_escape_string($connection, $_POST['product']);
                $qty = mysqli_real_escape_string($connection, $_POST['qty']);
                $emp = mysqli_real_escape_string($connection, $_POST['emp']);
                $checkstock = mysqli_query($connection, "select * from tbl_product where pro_id = '{$pro}'") or die(mysqli_error($connection));
                $stock = mysqli_fetch_array($checkstock);
                $priceq = mysqli_query($connection, "select pro_price from tbl_product where pro_id='{$pro}'") or die(mysqli_error($connection));
                $price = mysqli_fetch_array($priceq);
                $total = $qty * $price['pro_price'];

                if ($stock['pro_stock'] < $qty) {
                    $msg = " <div style='background-color:red;color:white;' class='alert alert-primary' role='alert'> You Have Selected More Products Availbale Than In Stocks ! </div>";
                } else {
                    $addq = mysqli_query($connection, "insert into tbl_order_details (order_id,pro_id,pro_quantity,pro_price,od_total,emp_id) values ('{$oid}','{$pro}','{$qty}','{$price['pro_price']}','{$total}','{$emp}')") or die(mysqli_error($connection));
                    $stockupdate = mysqli_query($connection, "update tbl_product set pro_stock= pro_stock-{$qty} where pro_id='{$pro}'") or die(mysqli_error($connection));
                }
            }
            if (isset($_POST['confirm'])) {
                $oid = mysqli_real_escape_string($connection, $_POST['oid']);
                $selectpriceq = mysqli_query($connection,"select od_total from tbl_order_details where order_id='{$oid}'") or die(mysqli_error($connection)); 
                $totalar[] = 0;
                while ($totalarray = mysqli_fetch_array($selectpriceq)) {
                    $totalar[] = $totalarray['od_total'];
                }
                $total = array_sum($totalar);
                $updateq = mysqli_query($connection, "update tbl_order set is_delete='0',order_status='Delivered',order_total='{$total}' where order_id='{$id}'");
                
                header("location:order-display.php");
            }
            ?>
            <div class="prtm-main">
                <?php include'sidebar.php'; ?>
                <div class="prtm-content-wrapper">
                    <div class="prtm-content">
                        <!-- Contents Ahiya Lkhvana -->
                        <?Php
                        echo $msg;
                        ?>
                        <form method="post">
                            <input type="hidden" value="<?php echo $selectrow['order_id']; ?>" name="oid">

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label">Name :- </label>
                                    <div class="col-sm-5">
                                        <label class="col-sm-5 control-label"><?php echo $selectrow['receiver_name'] ?> </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label">Date :- </label>
                                    <div class="col-sm-5">
                                        <label class="col-sm-5 control-label"><?php echo $selectrow['order_date'] ?> </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label">Mobile  :- </label>
                                    <div class="col-sm-5">
                                        <label class="col-sm-5 control-label"><?php echo $selectrow['receiver_mobile'] ?> </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Produtct </label>
                                    <div class="col-sm-5">
                                        <select class="form-control" name="product" >
                                            <option> Select Product </option>



                                            <?php
                                            $selectq = mysqli_query($connection, "select * from tbl_product where is_delete='0' AND NOT pro_stock = '0'") or die(mysqli_error($connection));
                                            while ($sel = mysqli_fetch_array($selectq)) {
                                                echo "<option value={$sel['pro_id']}> {$sel['pro_name']} | Price {$sel['pro_price']} | In Stock {$sel['pro_stock']} </option>";
                                            }
                                            echo "  </select>";
                                            ?>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Employee </label>
                                    <div class="col-sm-5">
                                        <select class="form-control" name="product" >
                                            <option> Select Employee </option>



                                            <?php
                                            $selectq = mysqli_query($connection, "select * from tbl_employee where is_delete='0' ") or die(mysqli_error($connection));
                                            while ($sel = mysqli_fetch_array($selectq)) {
                                                echo "<option value={$sel['emp_id']}> {$sel['emp_name']} </option>";
                                            }
                                            echo "  </select>";
                                            ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Quantity </label>
                                    <div class="col-sm-5">
                                        <input class="form-control number  "   name="qty" placeholder="Quantity" type="number" >
                                    </div>
                                </div>
                            </div>
                            <input type="submit"  Value="Add More Product" class="btn btn-primary btn-rounded" name="insert">
                            <input type="submit"  Value="Confirm" class="btn btn-primary btn-rounded" name="confirm">
                            <input type="Reset" class="btn btn-primary btn-rounded" name="reset">

                        </form>
                        <?php
                        $q = mysqli_query($connection, "select *  from tbl_order_details where order_id='{$id}' AND is_delete='0'")or die(mysqli_error($connection));

                        echo " <table class='table table-hover dataTable'  >";
                        echo "<tr>";
                        echo "<th> ID </th>";
                        echo "<th> Product </th>";
                        echo "<th> Price </th>";
                        echo "<th> Quantity </th>";
                        echo "<th> Total </th>";
                        while ($row = mysqli_fetch_array($q)) {

                            echo "<tr>";
                            echo "<td> {$row['od_id']} </td>";
                            $pro = mysqli_query($connection,"select pro_name from tbl_product where pro_id = {$row['pro_id']} ") or die(mysqli_error($connection));
                            $proname= mysqli_fetch_array($pro);
                            echo "<td>".  $proname['pro_name'] ."</td>";
                            echo "<td> {$row['pro_price']} </td>";

                            echo "<td> {$row['pro_quantity']} </td>";
                            echo "<td> {$row['od_total']} </td>";

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
