<?php
include 'connection.php';
$headermsg ="Insert New Offer";

include 'check-unique.php';
$msg="";
if(isset($_POST['insert']))
{
  
  $name= mysqli_real_escape_string($connection,$_POST['oname']);  
  $details=mysqli_real_escape_string($connection,$_POST['odetails']);    
  $discount=mysqli_real_escape_string($connection,$_POST['odiscount']); 
   
  $check = checkunique($connection, "tbl_offer", "of_name", $name);

    if ($check) {
        $q= mysqli_query($connection, "insert into tbl_offer (of_name,of_details,of_discount) values('{$name}','{$details}','{$discount}')") or die(mysqli_error($connection));
            
    if($q)
    {
        
                    header("location:offer-display.php") ; 
    }
       
    } else {
       
        $msg = "<div style='background-color:red;color:white;' class='alert alert-primary' "
                . "role='alert'> $name Already Exist ! </div>";
        
    }
    
}

?>
<html class="no-js" lang="en">
            <title>Offer Insert </title>
<?php include'headFile.php'?>
<body>
<div class="prtm-wrapper">
<?php include 'header.php'; ?>

<div class="prtm-main">
<?php include 'sidebar.php'; ?>
<div class="prtm-content-wrapper">
<div class="prtm-content">
    <?php echo $msg ;?>
<form class="form-group"  method="post">
    
<div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Offer Name </label>
<div class="col-sm-5">
<input class="form-control" name="oname" placeholder="Offer Name" type="text" required="yes">
</div>
</div>
</div>
    
    
    <div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Offer Details </label>
<div class="col-sm-5">
    <textarea rows="4"class="form-control" name="odetails" placeholder="Offer Details" type="text" required="yes"></textarea>
</div>
</div>
</div>
    
    
   
    <div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Discount </label>
<div class="col-sm-5">
<input class="form-control" name="odiscount" placeholder="Discount" type="text" required="yes">
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
<?php include'script.php'?>
</body>
</html>