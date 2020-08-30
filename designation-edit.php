<?php
include 'connection.php';

$headermsg ="Edit Designation";
include 'check-unique-edit.php';
$msg = "";
if(!isset($_GET['eid']) || empty($_GET['eid']) )  
    {
       
        header("location:designation-display.php") ;  
    }
if($_POST)
{
    $id = mysqli_real_escape_string($connection,$_POST['designationid']);
    $name= mysqli_real_escape_string($connection,$_POST['designationname']);  
    
    $check = checkuniqueedit($connection, "tbl_designation", "des_name", $name,"des_id",$id);

    if ($check) {
      
    $q = mysqli_query($connection, "update tbl_designation set des_name='{$name}' where des_id='{$id}'")or die(mysqli_error($connection));
    if($q)
    {
        header("location:designation-display.php") ;   
    }
    } else {
       
        $msg = "<div style='background-color:red;color:white;' class='alert alert-primary' "
                . "role='alert'> $name Already Exist ! </div>";
        
    }
    
  
    
    
}
$editid =$_GET['eid'];
$selectq = mysqli_query($connection,"select * from tbl_designation where des_id='{$editid}'") or die(mysqli_error("$connection"));

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
<?php echo $msg ; ?>
  <form class="form-group"  method="post">
    
<input type="hidden" value="<?php echo $selectrow['des_id'];?>" name="designationid">
<div class="form-group">
<div class="row mrgn-all-none">
<label for="inputname3" class="col-sm-2 control-label">Designation Name</label>
<div class="col-sm-5">
<input class="form-control" name="designationname" value="<?php echo $selectrow['des_name'];?>" placeholder="Area Name" type="text" required="yes">
</div>
</div>
</div>
<input type="submit" class="btn btn-primary btn-rounded" value="Update" name="update">



</form>
</div>
</div>
</div>
</div>
<?php include'script.php'?>
</body>
</html> 