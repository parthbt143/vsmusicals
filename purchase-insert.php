<?php
$headermsg ="Insert Purchase";
include 'connection.php';
include 'check-unique.php';

if (isset($_POST['insert'])) {
    $countq = mysqli_query($connection, "select * from tbl_purchase");
    $count = mysqli_num_rows($countq);

    $id = $count + 1;

    $sup = mysqli_real_escape_string($connection, $_POST['sup']);
    $date = mysqli_real_escape_string($connection, $_POST['date']);
    $invoice = mysqli_real_escape_string($connection, $_POST['invoice']);


    $q = mysqli_query($connection, "insert into tbl_purchase (pur_id,sup_id,pur_invoice_no,pur_date,pur_amt,is_delete) "
            . "values('{$id}','{$sup}','{$invoice}','{$date}','0','1')") or die(mysqli_error($connection));
    if ($q) {
        header("location:purchase-details-insert.php?eid=$id");
    }
}
?>
<html class="no-js" lang="en">
    <?php include'headFile.php' ?>
    <body>
        <title> Purchase Insert </title>
        <?php include "validation-script.php" ?>
        <div class="prtm-wrapper">
            <?php include 'header.php'; ?>

            <div class="prtm-main">
                <?php include 'sidebar.php'; ?>
                <div class="prtm-content-wrapper">
                    <div class="prtm-content">



                        <form class="form-group" id="myform" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label">  Supplier Name  </label>
                                    <div class="col-sm-5">
                                        <select class="form-control" name="sup" req="yes">
                                            <option>  Choose Supplier  </option>
                                            <?php
                                            $selectq = mysqli_query($connection, "select * from tbl_supplier where is_delete='0'  ") or die(mysqli_error($connection));
                                            while ($sel = mysqli_fetch_array($selectq)) {
                                                echo "<option value={$sel['sup_id']}> {$sel['sup_name']}</option>";
                                            }
                                            echo "  </select>";
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Date  </label>
                                    <div class="col-sm-5">
                                        <input type="date" class="form-control"  name="date" placeholder="Date Of Birth">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Invoice No.  </label>
                                    <div class="col-sm-5">
                                        <input type="number" class="form-control"  name="invoice" placeholder="Invoice Number ">
                                    </div>
                                </div>
                            </div>


                            <input type="submit" class="btn btn-primary btn-rounded" name="insert">
                            <input type="Reset" class="btn btn-primary btn-rounded" name="reset">

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include'script.php' ?>
    </body>
</html>