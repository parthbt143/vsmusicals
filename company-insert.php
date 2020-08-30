<?php
include 'connection.php';
include 'check-unique.php';

$headermsg ="Insert New Company";
  $msg = "";
if(isset($_POST['insert']))
{
  
    $name = mysqli_real_escape_string($connection,$_POST['companyname']);
    $check = checkunique($connection, "tbl_company", "com_name", $name);

    if ($check) {
      $q= mysqli_query($connection, "insert into tbl_company (com_name) values ('{$name}')") or die(mysqli_error($connection));
            
    if($q)
    {
        
                    header("location:company-display.php") ; 
    }
       
    } else {
        
        $msg = "<div style='background-color:red;color:white;' class='alert alert-primary' "
                . "role='alert'> $name Already Exist ! </div>";
        
    }
    
}

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
    <?php echo $msg; ?>
<form class="form-group"  method="post">
    
<div class="form-group">
<div class="row mrgn-all-none">
<label  class="col-sm-2 control-label">Company Name</label>
<div class="col-sm-5">
<input class="form-control" name="companyname" placeholder="Company Name" type="text" required="yes">
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