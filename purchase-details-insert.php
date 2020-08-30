<html class="no-js" lang="en">
    <title>Purchase Details Insert</title>
    <?php
$headermsg ="Insert Purchse Details";
include'headFile.php'; ?>
    <body>
        <div class="prtm-wrapper">
            <?php include 'header.php'; ?>
            <?php
            include 'header.php';

            if (!isset($_GET['eid']) || empty($_GET['eid'])) {

                header("location:purchase-insert.php");
            }
            $id = $_GET['eid'];
            $selectq = mysqli_query($connection, "SELECT
    `tbl_supplier`.`sup_name`
    , `tbl_purchase`.`pur_date`
    , `tbl_purchase`.`pur_invoice_no`
    , `tbl_purchase`.`pur_id`
    , `tbl_supplier`.`sup_id`
FROM
    `db_vsm`.`tbl_purchase`
    INNER JOIN `db_vsm`.`tbl_supplier` 
        ON (`tbl_purchase`.`sup_id` = `tbl_supplier`.`sup_id`) where `tbl_purchase`.`pur_id`='{$id}'") or die(mysqli_error($connection));
            $selectrow = mysqli_fetch_array($selectq);
            if (isset($_POST['insert'])) {

                $pid = mysqli_real_escape_string($connection, $_POST['pid']);
                $pro = mysqli_real_escape_string($connection, $_POST['product']);
                $qty = mysqli_real_escape_string($connection, $_POST['qty']);
              //  $price = mysqli_real_escape_string($connection, $_POST['price']);
                //$total = $qty * $price;
                                    $price = 0;
                                    $total = 0;
                $addq = mysqli_query($connection, "insert into tbl_purchase_detail (pur_id,pro_id,pro_quantity,pro_price,pd_total) values ('{$pid}','{$pro}','{$qty}','{$price}','{$total}')") or die(mysqli_error($connection));
                $stockupdate = mysqli_query($connection, "update tbl_product set pro_stock= pro_stock + {$qty} where pro_id='{$pro}'") or die(mysqli_error($connection));
            }
            if (isset($_POST['confirm'])) {

              /*  $pid = mysqli_real_escape_string($connection, $_POST['pid']);
                $purtotalq = mysqli_query($connection, "select pd_total from tbl_purchase_detail where pur_id='{$pid}'");

                $totalar[] = 0;
                while ($totalarray = mysqli_fetch_array($purtotalq)) {
                    $totalar[] = $totalarray['pd_total'];
                }
                $total = array_sum($totalar);
                $updateq = mysqli_query($connection, "update tbl_purchase set is_delete='0',pur_amt='{$total}' where pur_id='{$id}'"); */
                                    
                                    $updateq = mysqli_query($connection, "update tbl_purchase set is_delete='0' where pur_id='{$id}'");
                header("location:purchase-display.php");
            }
            ?>
            
          
            <div class="prtm-main">
                <?php include 'sidebar.php'; ?>
                <div class="prtm-content-wrapper">
                    <div class="prtm-content">
                        <!-- Contents Ahiya Lkhvana -->


                        <form method="post">
                            <input type="hidden" value="<?php echo $selectrow['pur_id']; ?>" name="pid">

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label">Suplier :- </label>
                                    <div class="col-sm-5">
                                        <label class="col-sm-5 control-label"><?php echo $selectrow['sup_name'] ?> </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label">Invoice No :-</label>
                                    <div class="col-sm-5">
                                        <label class="col-sm-5 control-label"><?php echo $selectrow['pur_invoice_no'] ?> </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label">Date :- </label>
                                    <div class="col-sm-5">
                                        <label class="col-sm-5 control-label"><?php echo $selectrow['pur_date'] ?> </label>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $q = mysqli_query($connection, "SELECT
    `tbl_purchase_detail`.`pd_id`
    , `tbl_product`.`pro_name`
    , `tbl_purchase_detail`.`pro_quantity`
    , `tbl_purchase_detail`.`pro_price`
    , `tbl_purchase_detail`.`pd_total`
FROM
    `db_vsm`.`tbl_purchase_detail`
    INNER JOIN `db_vsm`.`tbl_product` 
        ON (`tbl_purchase_detail`.`pro_id` = `tbl_product`.`pro_id`) Where `tbl_purchase_detail`.`pur_id` ='{$id}' AND `tbl_purchase_detail`.`is_delete`='0'")or die(mysqli_errno($connection));

                            echo " <table class='table table-hover dataTable'  >";
                            echo "<tr>";
                            echo "<th> ID </th>";
                            echo "<th> Product </th>";
                            echo "<th> Quantity </th>";
                            while ($row = mysqli_fetch_array($q)) {

                                echo "<tr>";
                                echo "<td> {$row['pd_id']} </td>";
                                echo "<td> {$row['pro_name']} </td>";
                                echo "<td> {$row['pro_quantity']} </td>";

                                echo "</tr>";
                            }
                            echo "</tr>";
                            echo "</table>";
                            ?>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Produtct </label>
                                    <div class="col-sm-5">
                                        <select class="form-control" name="product" >
                                            <option> Select Product </option>



                                            <?php
                                            $selectq = mysqli_query($connection, "select * from tbl_product where is_delete='0' ") or die(mysqli_error($connection));
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

                    </div>
                </div>
            </div>
        </div>
        <?php include'script.php' ?>
    </body>
</html>
