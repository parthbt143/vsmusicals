<?php
include 'connection.php';
$msg= "";
$headermsg ="Edit Batch";
include 'check-unique-edit.php';
if (!isset($_GET['eid']) || empty($_GET['eid'])) {

    header("location:batch-display.php");
}
if ($_POST) {
    $id = $_POST['batchid'];
    $name = $_POST['batchname'];
    $course = $_POST['course'];
    $emp = $_POST['emp'];
    $check = checkuniqueedit($connection, "tbl_batch", "batch_name", $name,"batch_id",$id);

    if ($check) {

        $q = mysqli_query($connection, "update tbl_batch set batch_name='{$name}',course_id='{$course}',emp_id='{$emp}' where batch_id='{$id}'")or die(mysqli_error($connection));
        if ($q) {
            header("location:batch-display.php");
        }
    } else { 
        $msg = "<div style='background-color:red;color:white;' class='alert alert-primary' role='alert'> $name Already Exist ! </div>";
    }
}
$editid = $_GET['eid'];
$selectq = mysqli_query($connection, "SELECT
    `tbl_course`.`course_name`
    , `tbl_employee`.`emp_name`
    , `tbl_batch`.`batch_id`
    , `tbl_batch`.`batch_name`
FROM
    `db_vsm`.`tbl_course`
    INNER JOIN `db_vsm`.`tbl_batch` 
        ON (`tbl_course`.`course_id` = `tbl_batch`.`course_id`)
    INNER JOIN `db_vsm`.`tbl_employee` 
        ON (`tbl_employee`.`emp_id` = `tbl_batch`.`emp_id`) where `tbl_batch`.`batch_id`='{$editid}' ") or die(mysqli_error("$connection"));

$selectrow = mysqli_fetch_array($selectq);
?>
<html class="no-js" lang="en">
    <title> Batch Edit </title>
    <?php include'headFile.php' ?>
    <body>
        <div class="prtm-wrapper">
            <?php include 'header.php'; ?>

            <div class="prtm-main">
                <?php include 'sidebar.php'; ?>
                <div class="prtm-content-wrapper">
                    <div class="prtm-content">
                        <!-- Contents Ahiya Lkhvana -->
<?php echo $msg;?>
                        <form class="form-group"  method="post">

                            <input type="hidden" value="<?php echo $selectrow['batch_id']; ?>" name="batchid">

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Batch Name  </label>
                                    <div class="col-sm-5
                                         ">
                                        <input class="form-control" name="batchname" value="<?php echo $selectrow['batch_name']; ?>" placeholder="Batch Name " type="text" required="yes">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label">  Course </label>
                                    <div class="col-sm-5">
                                        <select class="form-control" name="course" req="yes">

                                            <option> Select Course </option>


                                            <?php
                                            $selectq = mysqli_query($connection, "select * from tbl_course where is_delete='0'  ") or die(mysqli_error($connection));
                                            while ($sel = mysqli_fetch_array($selectq)) {
                                                if($sel['course_name'] == $selectrow['course_name']){
                                                echo "<option value={$sel['course_id']} selected> {$sel['course_name']}</option>";       
                                                }
                                                else{
                                                echo "<option value={$sel['course_id']}> {$sel['course_name']}</option>";       
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
                                    <label class="col-sm-2 control-label"> Employee      </label>
                                    <div class="col-sm-5">
                                        <select class="form-control" name="emp" req="yes">

                                            <option>  Select Employee    </option>


                                            <?php
                                            $selectq = mysqli_query($connection, " SELECT
    `tbl_designation`.`des_name`
    , `tbl_employee`.`emp_name`
    , `tbl_employee`.`emp_id`
FROM
    `db_vsm`.`tbl_employee`
    INNER JOIN `db_vsm`.`tbl_designation` 
        ON (`tbl_employee`.`des_id` = `tbl_designation`.`des_id`) where tbl_designation.des_name='trainer' AND tbl_employee.is_delete='0' ") or die(mysqli_error($connection));
                                            while ($sel = mysqli_fetch_array($selectq)) { 
                                                if($sel['emp_name'] == $selectrow['emp_name']){
                                                echo "<option value={$sel['emp_id']} selected> {$sel['emp_name']}</option>";       
                                                }
                                                else{
                                                echo "<option value={$sel['emp_id']}> {$sel['emp_name']}</option>";       
                                                } }
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