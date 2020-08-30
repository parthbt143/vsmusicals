
<?php
include 'connection.php';

$headermsg ="Edit Product";
$msg = "";
include 'check-unique-edit.php';
if (!isset($_GET['eid']) || empty($_GET['eid'])) {

    header("location:product-display.php");
}
if ($_POST) {
    $id = mysqli_real_escape_string($connection, $_POST['proid']);
    $a1 = mysqli_real_escape_string($connection, $_POST['proname']);
    $a2 = mysqli_real_escape_string($connection, $_POST['subcat']);
    $a3 = mysqli_real_escape_string($connection, $_POST['procompany']);
    $a4 = mysqli_real_escape_string($connection, $_POST['proprice']);
    $a5 = mysqli_real_escape_string($connection, $_POST['prowarranty']);
    $a6 = mysqli_real_escape_string($connection, $_POST['proser']);
    $a7 = mysqli_real_escape_string($connection, $_POST['serpri']);
    $a8 = mysqli_real_escape_string($connection, $_POST['stock']);
    $path = "productpics/" . time() . $_FILES['photo']['name'];
 $a9 = mysqli_real_escape_string($connection, $_POST['offer']);
   
    $check = checkuniqueedit($connection, "tbl_product", "pro_name", $a1, "pro_id", $id);
    if ($check) {

        if (isset($_FILES['photo']['name']) && !empty($_FILES['photo']['name'])) {
            $q = mysqli_query($connection, "update tbl_product set pro_photo='{$path}', pro_name='{$a1}', sc_id='{$a2}',com_id='{$a3}',of_id='{$a9}',pro_price='{$a4}',pro_warranty='{$a5}',pro_service='{$a6}',pro_service_price='{$a7}',pro_stock='{$a8}'  where pro_id='{$id}' ")or die(mysqli_error($connection));
            if ($q) {
                $upload = move_uploaded_file($_FILES['photo']['tmp_name'], $path);
                if ($upload) {
                    header("location:product-display.php");
                }
            }
        } else {
            $q = mysqli_query($connection, "update tbl_product set  pro_name='{$a1}', sc_id='{$a2}',com_id='{$a3}',pro_price='{$a4}',of_id='{$a9}',pro_warranty='{$a5}',pro_service='{$a6}',pro_service_price='{$a7}',pro_stock='{$a8}'  where pro_id='{$id}' ")or die(mysqli_error($connection));
            if ($q) {
                header("location:product-display.php");
            }
        }
    } else {

        $msg = "<div style='background-color:red;color:white;' class='alert alert-primary' "
                . "role='alert'> $a1 Already Exist ! </div>";
    }
}
$editid = $_GET['eid'];
$selectq = mysqli_query($connection, "  SELECT
    `tbl_company`.`com_name`
    , `tbl_sub_category`.`sc_name`
    , `tbl_product`.`pro_id`
    , `tbl_product`.`pro_name`
    , `tbl_product`.`pro_details`
    , `tbl_product`.`pro_price`
    , `tbl_product`.`pro_warranty`
    , `tbl_product`.`pro_service`
    , `tbl_product`.`pro_photo`
    , `tbl_product`.`pro_service_price`
    , `tbl_product`.`pro_stock`
FROM
    `db_vsm`.`tbl_company`
    INNER JOIN `db_vsm`.`tbl_product` 
        ON (`tbl_company`.`com_id` = `tbl_product`.`com_id`)
    INNER JOIN `db_vsm`.`tbl_sub_category` 
        ON (`tbl_sub_category`.`sc_id` = `tbl_product`.`sc_id`) where `tbl_product`.`pro_id`='{$editid}'")or die(mysqli_errno($connection));
$selectrow = mysqli_fetch_array($selectq);
?>
<html class="no-js" lang="en">
    <title> Product Edit </title>
<?php include'headFile.php' ?>
    <body>
        <div class="prtm-wrapper">
<?php include 'header.php'; ?>

            <div class="prtm-main">
    <?php include 'sidebar.php'; ?>
                <div class="prtm-content-wrapper">
                    <div class="prtm-content">
                        <!-- Contents Ahiya Lkhvana -->
<?php echo $msg ?>
                        <form class="form-group"  method="post" enctype="multipart/form-data">

                            <input type="hidden" value="<?php echo $selectrow['pro_id']; ?>" name="proid">




                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Product Name  </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="proname" value="<?php echo $selectrow['pro_name']; ?>" placeholder="Product Name " type="text" required="yes">
                                    </div>
                                </div>
                            </div>




                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Sub Category </label>
                                    <div class="col-sm-5">
                                        <select class="form-control" name="subcat" req="yes">


<?php
$selectq = mysqli_query($connection, "select * from tbl_sub_category where is_delete='0' ") or die(mysqli_error($connection));
while ($sel = mysqli_fetch_array($selectq)) {
    if ($sel['sc_name'] == $selectrow['sc_name']) {
        echo "<option value={$sel['sc_id']} selected> {$sel['sc_name']}</option>";
    } else {
        echo "<option value={$sel['sc_id']}> {$sel['sc_name']}</option>";
    }
}echo "  </select>";
?>

                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Company </label>
                                    <div class="col-sm-5">
                                        <select class="form-control" name="procompany" req="yes">

                                            <option> Select Product Company  </option>


<?php
$selectq = mysqli_query($connection, "select * from tbl_company where is_delete='0' ") or die(mysqli_error($connection));
while ($sel = mysqli_fetch_array($selectq)) {
    if ($sel['com_name'] == $selectrow['com_name']) {
        echo "<option value={$sel['com_id']} selected> {$sel['com_name']}</option>";
    } else {
        echo "<option value={$sel['com_id']}> {$sel['com_name']}</option>";
    }
}
echo "  </select>";
?>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Photo </label>
                                    <div class="col-sm-5">
                                        <img src="<?php echo $selectrow['pro_photo'] ?>" height="100" width="100">
                                        <input class="form-control" name="photo"   type="file" >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Product Price </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="proprice" value="<?php echo $selectrow['pro_price']; ?>" placeholder="Product Price " type="text" required="yes">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label">Warranty </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="prowarranty" value="<?php echo $selectrow['pro_warranty']; ?>" placeholder="Product Warranty" type="text" required="yes">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Free Sevices </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="proser" value="<?php echo $selectrow['pro_service']; ?>" placeholder="Free Services" type="text" required="yes">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Paid Service Price </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="serpri"  value="<?php echo $selectrow['pro_service_price']; ?>" placeholder="Paid Service Price" type="text" required="yes">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Stock </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="stock" value="<?php echo $selectrow['pro_stock']; ?>" placeholder="Stock" type="text" required="yes">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> offer </label>
                                    <div class="col-sm-5">
                                        <select class="form-control" name="offer" req="yes">


<?php
$selectq = mysqli_query($connection, "select * from tbl_offer where is_delete='0' ") or die(mysqli_error($connection));
while ($sel = mysqli_fetch_array($selectq)) {
    if ($sel['of_name'] == $selectrow['of_name']) {
        echo "<option value={$sel['of_id']} selected> {$sel['of_name']} | Discount : - {$sel['of_discount']} %</option>";
    } else {
        echo "<option value={$sel['of_id']}> {$sel['of_name']} | Discount : - {$sel['of_discount']}% </option>";
    }
}echo "  </select>";
?>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <input type="submit" class="btn btn-primary btn-rounded" value="Update" name="update">

                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php include'script.php' ?>
    </body>
</html>
