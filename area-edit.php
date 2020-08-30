<?php
include 'connection.php';
$headermsg ="Edit Area";
include 'check-unique-edit.php';
  $msg ="";
if(!isset($_GET['eid']) || empty($_GET['eid']) )  
    {
       
        header("location:area-display.php") ;  
    }
if($_POST['update'])
{
    $id = mysqli_real_escape_string($connection,$_POST['areaid']);
    $name= mysqli_real_escape_string($connection,$_POST['areaname']); 
     $check = checkuniqueedit($connection, "tbl_area", "area_name", $name,"area_id",$id);

    if ($check) {
      
    $q = mysqli_query($connection, "update tbl_area set area_name='{$name}' where area_id='{$id}'")or die(mysqli_error($connection));
    if($q)
    {
        header("location:area-display.php") ;   
    }
    } else {
         $msg = "<div style='background-color:red;color:white;' class='alert alert-primary' role='alert'> $name Already Exist ! </div>";
    
    }
}

$editid =$_GET['eid'];
$selectq = mysqli_query($connection,"select * from tbl_area where area_id='{$editid}'") or die(mysqli_error("$connection"));

$selectrow = mysqli_fetch_array($selectq);

?>
<html class="no-js" lang="en">
<?php include'headFile.php'?>
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
    
<input type="hidden" value="<?php echo $selectrow['area_id'];?>" name="areaid">
<div class="form-group">
<div class="row mrgn-all-none">
<label for="inputname3" class="col-sm-2 control-label">Area Name</label>
<div class="col-sm-5">
<input class="form-control" name="areaname" value="<?php echo $selectrow['area_name'];?>" placeholder="Area Name" type="text" required="yes">
</div>
</div>
</div>
<input  name="update" class="btn btn-primary btn-rounded" type="submit" value="update">



</form>
</div>
</div>
</div>
</div>
<?php include'script.php'?>
</body>
</html> 