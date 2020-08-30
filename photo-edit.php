
<?php
include 'connection.php';

$headermsg ="Edit Photo";
$msg = "";
include 'check-unique-edit.php';
if (!isset($_GET['eid']) || empty($_GET['eid'])) {

    header("location:photo-display.php");
}
if ($_POST) {

    $id = mysqli_real_escape_string($connection, $_POST['photoid']);
    $product = mysqli_real_escape_string($connection, $_POST['product']);
    $path = "productpics/" . time() . $_FILES['photo']['name'];



    if (isset($_FILES['photo']['name']) && !empty($_FILES['photo']['name'])) {
        $q = mysqli_query($connection, "update tbl_photo set pro_id='{$product}',photo_path='{$path}'  where photo_id='{$id}' ")or die(mysqli_error($connection));
        if ($q) {
            $upload = move_uploaded_file($_FILES['photo']['tmp_name'], $path);
            if ($upload) {
                header("location:photo-display.php");
            }
        }
    } else {
        $q = mysqli_query($connection, "update tbl_photo set  pro_id='{$product}'      where photo_id='{$id}' ")or die(mysqli_error($connection));
        if ($q) {
            header("location:photo-display.php");
        }
    }
}

$editid = $_GET['eid'];
$selectq = mysqli_query($connection, " SELECT
    `tbl_product`.`pro_name`
    , `tbl_photo`.`photo_id`
    , `tbl_photo`.`photo_path`
FROM
    `db_vsm`.`tbl_photo`
    INNER JOIN `db_vsm`.`tbl_product` 
        ON (`tbl_photo`.`pro_id` = `tbl_product`.`pro_id`) where `tbl_photo`.`photo_id`='{$editid}'")or die(mysqli_errno($connection));
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

                            <input type="hidden" value="<?php echo $selectrow['photo_id']; ?>" name="photoid">






                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label">  Product </label>
                                    <div class="col-sm-5">
                                        <select class="form-control" name="product" req="yes">


                                            <?php
                                            $selectq = mysqli_query($connection, "select * from tbl_product where is_delete='0' ") or die(mysqli_error($connection));
                                            while ($sel = mysqli_fetch_array($selectq)) {
                                                if ($sel['pro_name'] == $selectrow['pro_name']) {
                                                    echo "<option value={$sel['pro_id']} selected> {$sel['pro_name']}</option>";
                                                } else {
                                                    echo "<option value={$sel['pro_id']}> {$sel['pro_name']}</option>";
                                                }
                                            }echo "  </select>";
                                            ?>

                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Photo </label>
                                    <div class="col-sm-5">
                                        <img src="<?php echo $selectrow['photo_path'] ?>" height="100" width="100">
                                        <input class="form-control" name="photo"   type="file" >
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
