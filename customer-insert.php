<?php

$headermsg ="Insert New Customer";
include 'connection.php';
include 'check-unique.php';
$msg = "";
if (isset($_POST['insert'])) {

    $fname = mysqli_real_escape_string($connection, $_POST['fname']);
    $lname = mysqli_real_escape_string($connection, $_POST['lname']);
    $gen = mysqli_real_escape_string($connection, $_POST['gen']);
    $mobile = mysqli_real_escape_string($connection, $_POST['mobile']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $address = mysqli_real_escape_string($connection, $_POST['add']);
    $area = mysqli_real_escape_string($connection, $_POST['area']);
   $password = rand(1000,9999);

    if (isset($email) && !empty($email)) {
        $check = checkunique($connection, "tbl_customer", "cust_email", $email);
     
        if($check){
            $q = mysqli_query($connection, "insert into tbl_customer(cust_fname,cust_lname,cust_gender,cust_mobile,cust_email,cust_address,area_id,cust_password) values('{$fname}','{$lname}','{$gen}','{$mobile}','{$email}','{$address}','{$area}','{$password}')") or die(mysqli_error($connection));
            if($q){
                header("location:customer-display.php");
            }
        }
        else{
                $msg = "<div style='background-color:red;color:white;' class='alert alert-primary' "
                . "role='alert'> $fname with $email Already Exist ! </div>";
        }
         
    } else {
        $q = mysqli_query($connection, "insert into tbl_customer(cust_fname,cust_lname,cust_gender,cust_mobile,cust_address,area_id) values('{$fname}','{$lname}','{$gen}','{$mobile}','{$address}','{$area}')") or die(mysqli_error($connection));
            if($q){
                header("location:customer-display.php");
            }
    }
}
?>
<html class="no-js" lang="en">
<?php include'headFile.php' ?>
    <title>Customer Insert</title>
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
                                    <label class="col-sm-2 control-label"> Customer First Name  </label>
                                    <div class="col-sm-5">
                                        <input class="form-control required" name="fname" placeholder="Customer First Name " type="text" >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Customer Last Name  </label>
                                    <div class="col-sm-5">
                                        <input class="form-control required" name="lname" placeholder="Customer Last Name " type="text" >
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
                                    <label class="col-sm-2 control-label"> Mobile No </label>
                                    <div class="col-sm-5">
                                        <input class="form-control number  " name="mobile" placeholder="Mobile No" type="number" required="yes">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Email Address </label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="email" placeholder="Email Address" type="email" >
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

                                            <option>   Select Area  </option>


<?php
$selectq = mysqli_query($connection, "select * from tbl_area where is_delete='0' ") or die(mysqli_error($connection));
while ($sel = mysqli_fetch_array($selectq)) {
    echo "<option value={$sel['area_id']}> {$sel['area_name']}</option>";
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