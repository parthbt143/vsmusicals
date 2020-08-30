<?php
$headermsg ="Insert New Order";
include 'connection.php';
include 'check-unique.php';

if (isset($_POST['insert'])) {

$countq = mysqli_query($connection,"select * from tbl_order");
$count = mysqli_num_rows($countq);

$id = $count + 1;
    
    $name = mysqli_real_escape_string($connection, $_POST['receiver']);
    $mobile = mysqli_real_escape_string($connection, $_POST['mob']);
    $date = mysqli_real_escape_string($connection, $_POST['date']);
    $area = mysqli_real_escape_string($connection, $_POST['area']);
    $address = mysqli_real_escape_string($connection, $_POST['add']);
    
    $q = mysqli_query($connection, "insert into tbl_order (order_id,order_date,cust_id,receiver_name,receiver_address,area_id,receiver_mobile,order_is_offline,order_status,order_total,is_delete) "
            . "values('{$id}','{$date}','1','{$name}','{$address}','{$area}','{$mobile}','1','Pending','0','1')") or die(mysqli_error($connection));
            if($q){
                header("location:order-details-insert.php?eid=$id");
            }
}
?>
<html class="no-js" lang="en">
<title>
Order Insert </title>
    <?php include'headFile.php' ?>
    <body>
        <?php include "validation-script.php" ?>
        <div class="prtm-wrapper">
            <?php include 'header.php'; ?>

            <div class="prtm-main">
                <?php include 'sidebar.php'; ?>
                <div class="prtm-content-wrapper">
                    <div class="prtm-content">

 

                        <form class="form-group" id="myform" method="post" enctype="multipart/form-data">





                            <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label">  Name  </label>
                                    <div class="col-sm-5">
                                        <input class="form-control required" name="receiver" placeholder="Receiver Name " type="text" >
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
                                    <label class="col-sm-2 control-label"> Date  </label>

                                    <div class="col-sm-5">
                                        <input type="date" class="form-control"  name="date" placeholder="Date Of Birth">

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