<?php
$headermsg ="Edit Supplier";
include 'connection.php';
include 'check-unique-edit.php';
$msg = "";
if (!isset($_GET['eid']) || empty($_GET['eid'])) {

    header("location:supplier-display.php");
}
if ($_POST) {
    $id = mysqli_real_escape_string($connection,$_POST['id']);
    $mobile = mysqli_real_escape_string($connection,$_POST['mobile']);
    $name = mysqli_real_escape_string($connection,$_POST['name']);
    $address = mysqli_real_escape_string($connection,$_POST['address']);
    $area = mysqli_real_escape_string($connection,$_POST['area']);
    $check = checkuniqueedit($connection, "tbl_supplier", "sup_name", $name, "sup_id", $id);

    if ($check) {

        $q = mysqli_query($connection, "update tbl_supplier set sup_name='{$name}',area_id='{$area}',sup_mobile='{$mobile}',sup_address='{$address}' where sup_id='{$id}'")or die(mysqli_error($connection));
        if ($q) {
            header("location:supplier-display.php");
        }
    } else {   
        $msg = "<div style='background-color:red;color:white;' class='alert alert-primary' "
                . "role='alert'> $name Already Exist ! </div>";}
}
$editid = $_GET['eid'];
$selectq = mysqli_query($connection, "SELECT
    `tbl_supplier`.`sup_id`
    , `tbl_supplier`.`sup_name`
    , `tbl_supplier`.`sup_mobile`
    , `tbl_supplier`.`sup_address`
    , `tbl_area`.`area_name`
FROM
    `db_vsm`.`tbl_area`
    INNER JOIN `db_vsm`.`tbl_supplier` 
        ON (`tbl_area`.`area_id` = `tbl_supplier`.`area_id`) where tbl_supplier.sup_id= '{$editid}'; ")or die(mysqli_errno($connection));
$selectrow = mysqli_fetch_array($selectq);
?>
<html class="no-js" lang="en">
    <?php include'headFile.php' ?>
    <body>
        <div class="prtm-wrapper">
            <?php include 'header.php'; ?>

            <div class="prtm-main">
                <?php include 'sidebar.php'; ?>
                <div class="prtm-content-wrapper">
                    <div class="prtm-content">
                        <!-- Contents Ahiya Lkhvana -->
<?php echo $msg; ?>
                        <form class="form-group"  method="post">

                            <input type="hidden" value="<?php echo $selectrow['sup_id']; ?>" name="id">


        
<div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label">Supplier Name</label>
<div class="col-sm-5">
    <input class="form-control" name="name" value="<?php echo $selectrow['sup_name']; ?>" placeholder="Supplier Name" type="text" required="yes">
    
</div>
</div>
</div>
      <div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label">Supplier Mobile</label>
<div class="col-sm-5">
    <input class="form-control" name="mobile" value="<?php echo $selectrow['sup_mobile']; ?>" placeholder="Supplier Mobile" type="number" required="yes">

  
</div>
</div>
</div>

    <div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label">Supplier Address</label>
<div class="col-sm-5">
    <input class="form-control" name="address" value="<?php echo $selectrow['sup_address']; ?>" placeholder="Supplier Address" type="text" required="yes">

  
</div>
</div>
</div>

                      <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Area </label>
                                    <div class="col-sm-5">
                                        <select class="form-control" name="area" value="<?php echo $selectrow['area_name']; ?>" req="yes">




                                            <?php
                                            $selectq = mysqli_query($connection, "select * from tbl_area where is_delete='0'  ") or die(mysqli_error($connection));
                                            while ($sel = mysqli_fetch_array($selectq)) {
                                                if ($sel['area_name'] == $selectrow['area_name']) {
                                                    echo "<option value={$sel['area_id']} selected> {$sel['area_name']}</option>";
                                                } else {
                                                    echo "<option value={$sel['area_id']}> {$sel['area_name']}</option>";
                                                }
                                            }
                                            echo "  </select>";
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