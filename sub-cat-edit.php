<?php
include 'connection.php';
$headermsg ="Edit Sub Category";
include 'check-unique-edit.php';
$msg = "";
if (!isset($_GET['eid']) || empty($_GET['eid'])) {

    header("location:sub-cat-display.php");
}
if ($_POST) {
    $id = mysqli_real_escape_string($connection,$_POST['scid']);
    $name =mysqli_real_escape_string($connection, $_POST['catname']);
    $scname =mysqli_real_escape_string($connection, $_POST['subcatname']);
    $check = checkuniqueedit($connection, "tbl_sub_category", "sc_name", $scname, "sc_id", $id);

    if ($check) {

        $q = mysqli_query($connection, "update tbl_sub_category set sc_name='{$scname}',cat_id='{$name}' where sc_id='{$id}'")or die(mysqli_error($connection));
        if ($q) {
            header("location:sub-cat-display.php");
        }
    } else {   
        $msg = "<div style='background-color:red;color:white;' class='alert alert-primary' "
                . "role='alert'> $name Already Exist ! </div>";}
}
$editid = $_GET['eid'];
$selectq = mysqli_query($connection, "SELECT
    `tbl_category`.`cat_name`
    , `tbl_sub_category`.`sc_id`
    , `tbl_sub_category`.`sc_name`
FROM
    `db_vsm`.`tbl_category`
    INNER JOIN `db_vsm`.`tbl_sub_category` 
        ON (`tbl_category`.`cat_id` = `tbl_sub_category`.`cat_id`) where `tbl_sub_category`.`sc_id`='{$editid}' ")or die(mysqli_errno($connection));
$selectrow = mysqli_fetch_array($selectq);
?>
<html class="no-js" lang="en">
<title>Edit Sub Category </title>
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

                            <input type="hidden" value="<?php echo $selectrow['sc_id']; ?>" name="scid">


                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label for="inputname3" class="col-sm-2 control-label">Category Name</label>
                                    <div class="col-sm-5">
                                        <select class="form-control" name="catname" req="yes" >



                                            <?php
                                            $q = mysqli_query($connection, "select * from tbl_category where is_delete='0' ") or die(mysqli_error($connection));
                                            while ($sel = mysqli_fetch_array($q)) {

                                                if ($sel['cat_name'] == $selectrow['cat_name']) {
                                                    echo "<option value={$sel['cat_id']} selected> {$sel['cat_name']}</option>";
                                                } else {
                                                    echo "<option value={$sel['cat_id']}> {$sel['cat_name']}</option>";
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
                                    <label for="inputname3" class="col-sm-2 control-label">Sub Category Name</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="subcatname" value="<?php echo $selectrow['sc_name']; ?>" placeholder="Sub Category Name" type="text" required="yes">
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
