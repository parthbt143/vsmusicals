<?php
include 'connection.php';

$headermsg ="Edit category";
 $msg = "";
include 'check-unique-edit.php';
if(!isset($_GET['eid']) || empty($_GET['eid']) )  
{
       
        header("location:category-display.php") ;  
}

if($_POST['update'])
{
    $id = mysqli_real_escape_string($connection,$_POST['catid']);
    $name= mysqli_real_escape_string($connection,$_POST['categoryname']); 
     $check = checkuniqueedit($connection, "tbl_category", "cat_name", $name,"cat_id",$id);

    if ($check) {
      
     $q = mysqli_query($connection, "update tbl_category set cat_name='{$name}' where cat_id='{$id}'")or die(mysqli_error($connection));
    if($q)
    {
        header("location:category-display.php") ;   
    }
    } else {
        $msg = "<div style='background-color:red;color:white;' class='alert alert-primary' "
                . "role='alert'> $name Already Exist ! </div>";
    }
}
$editid =$_GET['eid'];
$selectq = mysqli_query($connection,"select * from tbl_category where cat_id='{$editid}'") or die(mysqli_error("$connection"));

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
    
<input type="hidden" value="<?php echo $selectrow['cat_id'];?>" name="catid">
<div class="form-group">
<div class="row mrgn-all-none">
<label for="inputname3" class="col-sm-2 control-label">Category Name</label>
<div class="col-sm-5">
<input class="form-control" name="categoryname" value="<?php echo $selectrow['cat_name'];?>" placeholder="Category Name" type="text" required="yes">
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