<?php
$headermsg ="Insert New Supplier";
include 'connection.php';
include 'check-unique.php';
$msg = "";
if(isset($_POST['insert']))
{
  
    $mobile = mysqli_real_escape_string($connection,$_POST['mobile']);
    $name = mysqli_real_escape_string($connection,$_POST['name']);
    $address = mysqli_real_escape_string($connection,$_POST['address']);
    $area = mysqli_real_escape_string($connection,$_POST['area']);
   
    
    $check = checkunique($connection, "tbl_supplier", "sup_name", $name);

    if ($check) {
        $q= mysqli_query($connection, "insert into tbl_supplier (sup_name,sup_address,sup_mobile,area_id) values('{$name}','{$address}','{$mobile}','{$area}')") or die(mysqli_error($connection));
            
    if($q)
    {
        
                    header("location:supplier-display.php") ; 
    }
       
    } else {   
        $msg = "<div style='background-color:red;color:white;' class='alert alert-primary' "
                . "role='alert'> $name Already Exist ! </div>"; }
   
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
    
<?php
echo $msg;
?>
        
<form class="form-group"  method="post">
    
 <div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label">Supplier Name</label>
<div class="col-sm-5">
    <input class="form-control" name="name" placeholder="Supplier Name" type="text" required="yes">
    
</div>
</div>
</div>
      <div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label">Supplier Mobile</label>
<div class="col-sm-5">
    <input class="form-control" name="mobile" placeholder="Supplier Mobile" type="number" required="yes">

  
</div>
</div>
</div>

    <div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label">Supplier Address</label>
<div class="col-sm-5">
    <input class="form-control" name="address" placeholder="Supplier Address" type="text" required="yes">

  
</div>
</div>
</div>

    <div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Area </label>
<div class="col-sm-5">
    <select class="form-control" name="area" req="yes">
        
        <option> Select Area   </option>
       
        
        <?php 
        $selectq = mysqli_query($connection, "select * from tbl_area where is_delete='0'") or die (mysqli_error($connection));
                           while($cat = mysqli_fetch_array($selectq))
                    {
                        echo "<option value={$cat['area_id']}> {$cat['area_name']}</option>";
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
<?php include'script.php'?>
</body>
</html>