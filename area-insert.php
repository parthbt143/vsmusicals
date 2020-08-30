<?php
include 'connection.php';
$headermsg ="Insert New Area";
include 'check-unique.php';
$msg="";
if (isset($_POST['insert'])) {
    $name = mysqli_real_escape_string($connection, $_POST['areaname']);

    $check = checkunique($connection, "tbl_area", "area_name", $name);

    if ($check) {
        $q = mysqli_query($connection, "insert into tbl_area (area_name) values ('{$name}')") or die(mysqli_error($connection));

        if ($q) {

                header("location:area-display.php");
            }
       
    } else  {$msg = "<div style='background-color:red;color:white;' class='alert alert-primary' role='alert'> $name Already Exist ! </div>";
    
    }
}
?>
<html class="no-js" lang="en">
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
                                    <label  class="col-sm-2 control-label">Area Name</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="areaname" placeholder="Area Name" type="text" required="yes">
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