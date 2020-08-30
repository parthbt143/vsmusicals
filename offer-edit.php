<?php
include 'connection.php';
$headermsg ="Edit Offer";
include 'check-unique-edit.php';
$msg="";
if(!isset($_GET['eid']) || empty($_GET['eid']) )  
{
       
        header("location:offer-display.php") ;  
}
if($_POST)
{
    $id=mysqli_real_escape_string($connection,$_POST['ofid']);
    $name=mysqli_real_escape_string($connection,$_POST['oname']);  
  $details=mysqli_real_escape_string($connection,$_POST['odetails']);   
  
  $discount=mysqli_real_escape_string($connection,$_POST['odiscount']); 
  
   $check = checkuniqueedit($connection, "tbl_offer", "of_name", $name,"of_id",$id);

    if ($check) {
      
    $q = mysqli_query($connection, "update tbl_offer set of_name='{$name}',of_details='{$details}',of_discount='{$discount}' where of_id='{$id}' ")or die(mysqli_error($connection));
    if($q)
    {
        header("location:offer-display.php") ;   
    }
    } else {
        
        $msg = "<div style='background-color:red;color:white;' class='alert alert-primary' "
                . "role='alert'> $name Already Exist ! </div>";
        
    }
    
}
$editid =$_GET['eid'];
 $selectq = mysqli_query($connection," select * from tbl_offer where of_id='{$editid}'")or die(mysqli_errno($connection));
$selectrow = mysqli_fetch_array($selectq);

?>
<html class="no-js" lang="en">
    <title>Offer Edit</title>
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
    
<input type="hidden" value="<?php echo $selectrow['of_id'];?>" name="ofid">




    
   
<div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Offer Name </label>
<div class="col-sm-5">
<input class="form-control" value="<?php echo $selectrow['of_name'];?>" name="oname" placeholder="Offer Name" type="text" required="yes">
</div>
</div>
</div>
    
    
    <div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Offer Details </label>
<div class="col-sm-5">
    <textarea rows="4"  class="form-control"  name="odetails" placeholder="Offer Details" type="text" required="yes"><?php echo $selectrow['of_details'];?></textarea>
</div>
</div>
</div>
    

    
    <div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Discount </label>
<div class="col-sm-5">
<input class="form-control" name="odiscount" value="<?php echo $selectrow['of_discount'];?>" placeholder="Discount" type="text" required="yes">
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
