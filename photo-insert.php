<?php
include 'connection.php';
$headermsg ="Insert New Photo";
$msg = "";
include 'check-unique.php';
if (isset($_POST['insert'])) {


    $path = "productpics/" . time() . $_FILES['photo']['name'];

$pro = mysqli_real_escape_string($connection,$_POST['product']);

    $q = mysqli_query($connection, "insert into tbl_photo (pro_id,photo_path) values('{$pro}','{$path}') ") or die(mysqli_error($connection));

    if ($q) {
        $upload = move_uploaded_file($_FILES['photo']['tmp_name'], $path);
        if ($upload) {

            header("location:photo-display.php");
        }
    }
}
?>
<html class="no-js" lang="en">
    <title>Product Insert</title>
    <?php include'headFile.php' ?>
    <body>
        <div class="prtm-wrapper">
            <?php include 'header.php'; ?>

            <div class="prtm-main">
                <?php include 'sidebar.php'; ?>
                <div class="prtm-content-wrapper">
                    <div class="prtm-content">
                        <?php echo $msg; ?>
                        <form class="form-group"  method="post" enctype="multipart/form-data">







                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Product </label>
                                    <div class="col-sm-5">
                                        <select class="form-control" name="product" req="yes">

                                            <option> Select   Product  </option>


                                            <?php
                                            $selectq = mysqli_query($connection, "select * from tbl_product where is_delete='0' ") or die(mysqli_error($connection));
                                            while ($sel = mysqli_fetch_array($selectq)) {
                                                echo "<option value={$sel['pro_id']}> {$sel['pro_name']}</option>";
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
                                        <input class="form-control" name="photo"   type="file" required="yes">
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