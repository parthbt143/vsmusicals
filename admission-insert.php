<?php
include 'connection.php';
$headermsg ="New Admission";
include 'check-unique.php';
$msg="";
if (isset($_POST['insert'])) {

    $fname = mysqli_real_escape_string($connection, $_POST['fname']);
    $lname = mysqli_real_escape_string($connection, $_POST['lname']);
    $gen = mysqli_real_escape_string($connection, $_POST['gen']);
    $dob = mysqli_real_escape_string($connection, $_POST['dob']);
    $mobile = mysqli_real_escape_string($connection, $_POST['mob']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $address = mysqli_real_escape_string($connection, $_POST['add']);
    $area = mysqli_real_escape_string($connection, $_POST['area']);
    $batch = mysqli_real_escape_string($connection, $_POST['batch']);
    $password = rand(1000, 9999);


    $check = checkunique($connection, "tbl_student", "stud_email", $email);

    if ($check) {
        $q = mysqli_query($connection, "insert into tbl_student (stud_fname,stud_lname,stud_gender,stud_dob,stud_mobile,stud_email,stud_address,area_id,stud_password) values('{$fname}','{$lname}','{$gen}','{$dob}','{$mobile}','{$email}','{$address}','{$area}','{$password}') ") or die(mysqli_error($connection));

    } 
    $studentq = mysqli_query($connection, "select stud_id from tbl_student where stud_email='{$email}'") or die(mysqli_error($connection));

        $feesq = mysqli_query($connection, "SELECT
    `tbl_course`.`course_fee`
FROM
    `db_vsm`.`tbl_batch`
    INNER JOIN `db_vsm`.`tbl_course` 
        ON (`tbl_batch`.`course_id` = `tbl_course`.`course_id`) where tbl_batch.batch_id = '{$batch}' ") or die(mysqli_error($connection));
        $studentid = mysqli_fetch_array($studentq);

        $fees = mysqli_fetch_array($feesq);
        $uniquead = mysqli_query($connection, " select * from tbl_admission where stud_id ='{$studentid['stud_id']}' AND batch_id='{$batch}' ") or die(mysqli_error($connection));
        $count = mysqli_fetch_row($uniquead);
        if ($count > 0) {
            $msg = "<div style='background-color:red;color:white;' class='alert alert-primary' role='alert'>$fname $lname has already taken admission in selected batch </div>";
        } else {

            $admissionq = mysqli_query($connection, "insert into tbl_admission (stud_id,batch_id,fees_paid,fees_remaining,fees_total) values('{$studentid['stud_id']}','{$batch}','0000','{$fees['course_fee']}','{$fees['course_fee']}')") or die(mysqli_error($connection));
            if ($admissionq) {
                header("location:student-display.php");
            }
        }
    
       
}
?>
<html class="no-js" lang="en">
    <title> Student Admission    </title>
<?php include'headFile.php' ?>
    <body>
    <?php include "validation-script.php" ?>
        <div class="prtm-wrapper">
        <?php include 'header.php'; ?>

            <div class="prtm-main">
            <?php include 'sidebar.php'; ?>
                <div class="prtm-content-wrapper">
                    <div class="prtm-content">
                <?php echo $msg; ?>
                        <form class="form-group" id="myform" method="post" enctype="multipart/form-data">



                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Student First Name  </label>
                                    <div class="col-sm-5">
                                        <input class="form-control required" name="fname" placeholder="Student First Name " type="text" >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Student Last Name  </label>
                                    <div class="col-sm-5">
                                        <input class="form-control required" name="lname" placeholder="Student Last Name " type="text" >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label">Gender </label>
                                    <div class="col-sm-5">
                                        <select class="form-control" name="gen" placeholder="Gender" type="text" required="yes">
                                            <option value="Male"> Male </option>
                                            <option value="Female"> Female </option>

                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Date of Birth </label>

                                    <div class="col-sm-5">
                                        <input type="text" class="form-control datepicker mrgn-b-xs" name="dob" placeholder="Date Of Birth">

                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Mobile No </label>
                                    <div class="col-sm-5">
                                        <input class="form-control number  " name="mob"  placeholder="Mobile No" type="number" required="yes">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Email </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="email" placeholder="Email" type="email" required="yes">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Address </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="add" placeholder="Address" type="text" required="yes">
                                    </div>
                                </div>
                            </div>  



                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Area </label>
                                    <div class="col-sm-5">
                                        <select class="form-control" name="area" req="yes">

                                            <option>   Area Name  </option>


<?php
$selectq = mysqli_query($connection, "select * from tbl_area where is_delete='0'  ") or die(mysqli_error($connection));
while ($sel = mysqli_fetch_array($selectq)) {
    echo "<option value={$sel['area_id']}> {$sel['area_name']}</option>";
}
echo "  </select>";
?>

                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Batch </label>
                                    <div class="col-sm-5">
                                        <select class="form-control" name="batch" req="yes">

                                            <option>   Batch Name  </option>


<?php
$selectq = mysqli_query($connection, "select * from tbl_batch where is_delete='0'  ") or die(mysqli_error($connection));
while ($sel = mysqli_fetch_array($selectq)) {
    echo "<option value={$sel['batch_id']}> {$sel['batch_name']}</option>";
}
echo "  </select>";
?>

                                        </select>
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