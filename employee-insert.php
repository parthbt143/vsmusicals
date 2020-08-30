<?php
include 'connection.php';
include 'check-unique.php';
$msg="";

$headermsg ="Insert New Employee";
if(isset($_POST['insert']))
{
  
    $name=mysqli_real_escape_string($connection,$_POST['ename']);
    $gen=mysqli_real_escape_string($connection,$_POST['egen']);
    $des=mysqli_real_escape_string($connection,$_POST['edes']);
    $mobile=mysqli_real_escape_string($connection,$_POST['emob']);
    $address=mysqli_real_escape_string($connection,$_POST['eadd']);
    $area=mysqli_real_escape_string($connection,$_POST['earea']);
    $salary=mysqli_real_escape_string($connection,$_POST['esal']);
    
    
    $check = checkunique($connection, "tbl_employee", "emp_mobile", $mobile);

    if ($check) {
        $q= mysqli_query($connection, "insert into tbl_employee (emp_name,emp_gender,des_id,emp_mobile,emp_address,area_id,salary) values('{$name}','{$gen}','{$des}','{$mobile}','{$address}','{$area}','{$salary}') ") or die(mysqli_error($connection));
            
    if($q)
    {
           
        
                    header("location:employee-display.php") ; 
    }
    } else {
        
        $msg = "<div style='background-color:red;color:white;' class='alert alert-primary' "
                . "role='alert'> $name Already Exist ! </div>";
        
    }
    
}



?>
<html class="no-js" lang="en">
    <title> Employee Insert</title>
<?php include'headFile.php'?>
<body>
     <?php include "validation-script.php"?>
<div class="prtm-wrapper">
<?php include 'header.php'; ?>

<div class="prtm-main">
<?php include 'sidebar.php'; ?>
<div class="prtm-content-wrapper">
<div class="prtm-content">
    <?php echo ''; ?>
    <form class="form-group" id="myform" method="post" enctype="multipart/form-data">
    

    
<div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Employee Name  </label>
<div class="col-sm-5">
<input class="form-control required" name="ename" placeholder="Employee Name " type="text" >
</div>
</div>
</div>
    
    <div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label">Gender </label>
<div class="col-sm-5">
<select class="form-control" name="egen" placeholder="Gender" type="text" required="yes">
       <option value="Male"> Male </option>
    <option value="Female"> Female </option>
    
</select>
</div>
</div>
</div>
    
   
<div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Designatation </label>
<div class="col-sm-5">
    <select class="form-control" name="edes" req="yes">
        
       
       
        
        <?php 
        $selectq = mysqli_query($connection, "select * from tbl_designation where is_delete='0' ") or die (mysqli_error($connection));
                           while($sel = mysqli_fetch_array($selectq))
                    {
                        echo "<option value={$sel['des_id']}> {$sel['des_name']}</option>";
                     }
                    echo "  </select>";
        ?>
        
    </select>
</div>
</div>
</div>

    <div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Mobile No </label>
<div class="col-sm-5">
    <input class="form-control" maxlength="10" minlength="10" name="emob" pattern="[0-9]*$" placeholder="Mobile No" type="text" required="yes">
</div>
</div>
</div>
    
    <div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Address </label>
<div class="col-sm-5">
<input class="form-control" name="eadd" placeholder="Address" type="text" required="yes">
</div>
</div>
</div>
    
    
<div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Area </label>
<div class="col-sm-5">
    <select class="form-control" name="earea" req="yes">
        
        <option>Area Name  </option>
       
        
        <?php 
        $selectq = mysqli_query($connection, "select * from tbl_area where is_delete = '0' ") or die (mysqli_error($connection));
                           while($sel = mysqli_fetch_array($selectq))
                    {
                        echo "<option value={$sel['area_id']}> {$sel['area_name']}</option>";
                     }
                    echo "  </select>";
        ?>
        
    </select>
</div>
</div>
</div>
    
    <div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Salary </label>
<div class="col-sm-5">
<input class="form-control" name="esal" placeholder="salary" type="text" required="yes">
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