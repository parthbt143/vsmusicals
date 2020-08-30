<?php
include 'connection.php';

$headermsg ="Edit Student";
include 'check-unique-edit.php';
if (!isset($_GET['eid']) || empty($_GET['eid'])) {

    header("location:student-display.php");
}
if ($_POST) {

    $id = mysqli_real_escape_string($connection, $_POST['studid']);

    $fname = mysqli_real_escape_string($connection, $_POST['fname']);
    $lname = mysqli_real_escape_string($connection, $_POST['lname']);
    $gen = mysqli_real_escape_string($connection, $_POST['gen']);
    $dob = mysqli_real_escape_string($connection, $_POST['dob']);
    $mobile = mysqli_real_escape_string($connection, $_POST['mob']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $address = mysqli_real_escape_string($connection, $_POST['add']);
    $area = mysqli_real_escape_string($connection, $_POST['area']);
   $check = checkuniqueedit($connection, "tbl_student", "stud_email", $email, "stud_id", $id);

    if ($check) {
    if (isset($_FILES['photo']['name']) && !empty($_FILES['photo']['name'])) {
             $q = mysqli_query($connection, "update tbl_student set stud_fname='{$fname}',stud_lname='{$lname}',stud_gender='{$gen}',stud_dob='{$dob}',stud_mobile='{$mobile}',stud_email='{$email}',stud_address='{$address}',area_id='{$area}',stud_photo='{$path}' where stud_id='{$id}' ")or die(mysqli_error($connection));
        if ($q) {
                header("location:student-display.php");
           
        }
        } else {
            $q = mysqli_query($connection, "update tbl_student set stud_fname='{$fname}',stud_lname='{$lname}',stud_gender='{$gen}',stud_dob='{$dob}',stud_mobile='{$mobile}',stud_email='{$email}',stud_address='{$address}',area_id='{$area}' where stud_id='{$id}' ")or die(mysqli_error($connection));
        if ($q) {
            

                header("location:student-display.php");
           
        }
        }
}}
$editid = $_GET['eid'];
$selectq = mysqli_query($connection, "SELECT
    `tbl_student`.`stud_id`
    , `tbl_student`.`stud_fname`
    , `tbl_student`.`stud_lname`
    , `tbl_student`.`stud_gender`
    , `tbl_student`.`stud_dob`
    , `tbl_student`.`stud_mobile`
    , `tbl_student`.`stud_email`
    , `tbl_student`.`stud_address`
    , `tbl_area`.`area_name`
FROM
    `db_vsm`.`tbl_area`
    INNER JOIN `db_vsm`.`tbl_student` 
        ON (`tbl_area`.`area_id` = `tbl_student`.`area_id`) where   `tbl_student`.`stud_id`='{$editid}'")or die(mysqli_errno($connection));
$selectrow = mysqli_fetch_array($selectq);
?>
<html class="no-js" lang="en">
    <title>Student Edit</title>
    <?php include'headFile.php' ?>
    <body>
        <div class="prtm-wrapper">
            <?php include 'header.php'; ?>

            <div class="prtm-main">
                <?php include 'sidebar.php'; ?>
                <div class="prtm-content-wrapper">
                    <div class="prtm-content">
                        <!-- Contents Ahiya Lkhvana -->

                        <form class="form-group"  method="post" enctype="multipart/form-data">

                            <input type="hidden" value="<?php echo $selectrow['stud_id']; ?>" name="studid">


                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Student First Name  </label>
                                    <div class="col-sm-5">
                                        <input class="form-control required" value="<?php echo $selectrow['stud_fname']; ?>" name="fname" placeholder="Student First Name " type="text" >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Student Last Name  </label>
                                    <div class="col-sm-5">
                                        <input class="form-control required" value="<?php echo $selectrow['stud_lname']; ?>" name="lname" placeholder="Student Last Name " type="text" >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label">Gender </label>
                                    <div class="col-sm-5">
                                        <select class="form-control" name="gen" value="<?php echo $selectrow['stud_gen']; ?>" placeholder="Gender" type="text" required="yes">
                                            <?php
                                            if ($selectrow['stud_gender'] == "Male") {
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
                                    <label class="col-sm-2 control-label"> Date of Birth </label>

                                    <div class="col-sm-5">
                                        <input type="text" value="<?php echo $selectrow['stud_dob']; ?>" class="form-control datepicker mrgn-b-xs" name="dob" placeholder="Date Of Birth">

                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Mobile No </label>
                                    <div class="col-sm-5">
                                        <input class="form-control number  " value="<?php echo $selectrow['stud_mobile']; ?>" name="mob" placeholder="Mobile No" type="number" required="yes">
                                    </div>
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Email </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" value="<?php echo $selectrow['stud_email']; ?>" name="email" placeholder="Email" type="email" required="yes">
                                    </div>
                                </div>
                            </div>



 <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Address </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="add" value="<?php echo $selectrow['stud_address']; ?>" placeholder="Address" type="text" required="yes">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Area </label>
                                    <div class="col-sm-5">
                                        <select class="form-control" name="area" value="<?php echo $selectrow['area_name']; ?>" req="yes">




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

                            <input type="submit" class="btn btn-primary btn-rounded" value="Update" name="update">



                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include'script.php' ?>
    </body>
</html>
