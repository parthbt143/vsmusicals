<?php
include 'connection.php';
include 'check-unique.php';
$headermsg ="Insert Fee";
$msg = "";
if (!isset($_GET['eid']) || empty($_GET['eid'])) {

    header("location:admission-display.php");
}

$editid = $_GET['eid'];
$selectq = mysqli_query($connection, "SELECT
    `tbl_batch`.`batch_name`
    , `tbl_student`.`stud_fname`
    , `tbl_student`.`stud_lname`
    , `tbl_admission`.`fees_remaining`
    , `tbl_admission`.`fees_total`
    , `tbl_admission`.`fees_paid`
    , `tbl_admission`.`adm_id`
    , `tbl_course`.`course_name`
    , `tbl_course`.`course_name`
    , `tbl_course`.`course_name`
FROM
    `db_vsm`.`tbl_admission`
    INNER JOIN `db_vsm`.`tbl_student` 
        ON (`tbl_admission`.`stud_id` = `tbl_student`.`stud_id`)
    INNER JOIN `db_vsm`.`tbl_batch` 
        ON (`tbl_admission`.`batch_id` = `tbl_batch`.`batch_id`)
    INNER JOIN `db_vsm`.`tbl_course` 
        ON (`tbl_batch`.`course_id` = `tbl_course`.`course_id`) where `tbl_admission`.`adm_id`='{$editid}'") or die(mysqli_error($connection));
$selectrow = mysqli_fetch_array($selectq);
if (isset($_POST['insert'])) {

    $fee = mysqli_real_escape_string($connection, $_POST['fee']);
    $date = mysqli_real_escape_string($connection, $_POST['date']);
    $adm = mysqli_real_escape_string($connection, $_POST['admid']);

if($fee > $selectrow['fees_remaining']){
    $msg = "<div style='background-color:red;color:white;' class='alert alert-primary' role='alert'> you have entered fee amount more than Remaining Fee. </div>";
}
else{
    $qupdate = mysqli_query($connection, "update tbl_admission set fees_remaining = fees_remaining - '{$fee}', fees_paid= fees_paid + '{$fee}' where adm_id='{$editid}'") or die(mysqli_error($connection));
    $q = mysqli_query($connection,"insert into tbl_fees(adm_id,fee_instalment_amt,fee_date) values ('{$adm}','{$fee}','{$date}')") or die(mysqli_error($connection));
    if ($q) {
        header("location:fees-display.php");
    }
}
    
}
?>
<html class="no-js" lang="en">
    <?php include'headFile.php' ?>
    <body>
        <div class="prtm-wrapper">
            <?php include 'header.php'; ?>
            <title> Fees Insert </title>
            <div class="prtm-main">
                <?php include 'sidebar.php'; ?>
                <div class="prtm-content-wrapper">
                    <div class="prtm-content">

<?php 
echo $msg;
?>

                        <form class="form-group"  method="post">

                            <input type="hidden" value="<?php echo $selectrow['adm_id']; ?>" name="admid">

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label">Name </label>
                                    <div class="col-sm-5">
                                        <label class="col-sm-5 control-label"><?php echo $selectrow['stud_fname'] . " " . $selectrow['stud_lname'] ?> </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label">Admission in </label>
                                    <div class="col-sm-5">
                                        <label class="col-sm-5 control-label"><?php echo "course :- ". $selectrow['course_name'] . " In Batch :- " . $selectrow['batch_name'] ?> </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label">Paid fees </label>
                                    <div class="col-sm-10">
                                        <label class="col-sm-10 control-label"><?php echo $selectrow['fees_paid'] ?> </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label">Total fees </label>
                                    <div class="col-sm-5">
                                        <label class="col-sm-5 control-label"><?php echo $selectrow['fees_total'] ?> </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label">remaining Fees </label>
                                    <div class="col-sm-5">
                                        <label class="col-sm-5 control-label"><?php echo $selectrow['fees_remaining']  ?> </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label">Fees Amount</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="fee" placeholder="Enter fees " type="number" required="yes">


                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Date  </label>

                                    <div class="col-sm-5">
                                        <input type="date"  class="form-control"    name="date" placeholder="Date" required="yes">

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

