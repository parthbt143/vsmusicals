<?php
include 'connection.php';
$msg = "";

$headermsg ="Edit Employee";
include 'check-unique-edit.php';
if (!isset($_GET['eid']) || empty($_GET['eid'])) {

    header("location:employee-display.php");
}
if ($_POST) {
    $id = mysqli_real_escape_string($connection, $_POST['empid']);
    $name = mysqli_real_escape_string($connection, $_POST['ename']);
    $gen = mysqli_real_escape_string($connection, $_POST['egen']);
    $des = mysqli_real_escape_string($connection, $_POST['edes']);
    $mobile = mysqli_real_escape_string($connection, $_POST['emob']);
    $address = mysqli_real_escape_string($connection, $_POST['eadd']);
    $area = mysqli_real_escape_string($connection, $_POST['earea']);
    $salary = mysqli_real_escape_string($connection, $_POST['esal']);
    $path = "emppics/" . time() . $_FILES['photo']['name'];

    $check = checkuniqueedit($connection, "tbl_employee", "emp_mobile", $mobile, "emp_id", $id);
    if ($check) {
        $q = mysqli_query($connection, "update tbl_employee set emp_name='{$name}',emp_gender='{$gen}',des_id='{$des}',emp_mobile='{$mobile}',emp_address='{$address}' , area_id='{$area}' ,salary='{$salary}' where emp_id='{$id}'; ")or die(mysqli_error($connection));
        if ($q) {


            header("location:employee-display.php");
        }
    } else {

        $msg = "<div style='background-color:red;color:white;' class='alert alert-primary' "
                . "role='alert'> $name Already Exist ! </div>";
    }
}




$editid = $_GET['eid'];
$selectq = mysqli_query($connection, " SELECT
    `tbl_employee`.`emp_id`
    , `tbl_employee`.`emp_name`
    , `tbl_employee`.`emp_gender`
    , `tbl_employee`.`emp_mobile`
    , `tbl_employee`.`emp_address`
    , `tbl_employee`.`salary`
    , `tbl_designation`.`des_name`
    , `tbl_area`.`area_name`
FROM
    `db_vsm`.`tbl_designation`
    INNER JOIN `db_vsm`.`tbl_employee` 
        ON (`tbl_designation`.`des_id` = `tbl_employee`.`des_id`)
    INNER JOIN `db_vsm`.`tbl_area` 
        ON (`tbl_area`.`area_id` = `tbl_employee`.`area_id`) where   `tbl_employee`.`emp_id`='{$editid}'")or die(mysqli_errno($connection));
$selectrow = mysqli_fetch_array($selectq);
?>
<html class="no-js" lang="en">
    <?php include'headFile.php' ?>
    <title> Employee Edit</title>
    <body>
        <div class="prtm-wrapper">
            <?php include 'header.php'; ?>

            <div class="prtm-main">
                <?php include 'sidebar.php'; ?>
                <div class="prtm-content-wrapper">
                    <div class="prtm-content">
                        <!-- Contents Ahiya Lkhvana -->
                        <?php echo $msg; ?>
                        <form class="form-group"  method="post" enctype="multipart/form-data">

                            <input type="hidden" value="<?php echo $selectrow['emp_id']; ?>" name="empid">

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Employee Name  </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="ename" value="<?php echo $selectrow['emp_name']; ?>" placeholder="Employee Name " type="text" required="yes">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label">Gender </label>
                                    <div class="col-sm-5">
                                        <select class="form-control" name="egen" value="<?php echo $selectrow['emp_gender']; ?>" placeholder="Gender" type="text" required="yes">
                                            <?php
                                            if ($selectrow['emp_gender'] == "Male") {
                                                echo "<option value='Male' Selected> Male </option>";
                                                echo "<option value='Female' > Female </option>";
                                            } else {
                                                echo "<option value='Male' > Male </option>";
                                                echo "<option value='Female' Selected> Female </option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Designatation </label>
                                    <div class="col-sm-5">
                                        <select class="form-control" name="edes" req="yes">



                                            <?php
                                            $selectq = mysqli_query($connection, "select * from tbl_designation where is_delete='0' ") or die(mysqli_error($connection));
                                            while ($sel = mysqli_fetch_array($selectq)) {
                                                if ($sel['des_name'] == $selectrow['des_name']) {
                                                    echo "<option value={$sel['des_id']} selected> {$sel['des_name']}</option>";
                                                } else {
                                                    echo "<option value={$sel['des_id']}> {$sel['des_name']}</option>";
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
                                    <label class="col-sm-2 control-label"> Mobile No </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="emob" value="<?php echo $selectrow['emp_mobile']; ?>" placeholder="Mobile No" type="text" required="yes">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Address </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="eadd" value="<?php echo $selectrow['emp_address']; ?>" placeholder="Address" type="text" required="yes">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Area </label>
                                    <div class="col-sm-5">
                                        <select class="form-control" name="earea" value="<?php echo $selectrow['area_name']; ?>" req="yes">
                                            <?php
                                            $selectq = mysqli_query($connection, "select * from tbl_area where is_delete='0' ") or die(mysqli_error($connection));
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

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Salary </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="esal" placeholder="salary" value="<?php echo $selectrow['salary']; ?>" type="text" required="yes">
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
