
<?php
include 'connection.php';
$headermsg ="Change Order Status ";

include 'check-unique-edit.php';
if (!isset($_GET['eid']) || empty($_GET['eid'])) {

    header("location:order-display.php");
}
if ($_POST) {
    $id = mysqli_real_escape_string($connection, $_POST['orderid']);
    $status = mysqli_real_escape_string($connection, $_POST['status']);
   



    $q = mysqli_query($connection, "update tbl_order set order_status = '{$status}' where order_id= '{$id}' ")or die(mysqli_error($connection));
           
                if ($q) {
                    header("location:order-display.php");
                }
           
    
     }
$editid = $_GET['eid'];
$selectq = mysqli_query($connection, "  SELECT * from tbl_order where order_id ='{$editid}'")or die(mysqli_errno($connection));
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
                        <form class="form-group"  method="post" >

                            <input type="hidden" value="<?php echo $selectrow['order_id']; ?>" name="orderid">
  <div class="form-group">
                                <div class="row mrgn-all-none">
                                    <label class="col-sm-2 control-label"> Status </label>
                                    <div class="col-sm-5">
                                        <select class="form-control" name="status" req="yes">


<option value='Pending'> Pending </option>
<option value='Confirmed' selected > Confirmed </option>
<option value='Delivered'> Delivered </option>

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
