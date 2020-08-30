
<?php
include 'connection.php';

$headermsg ="Insert New Batch";
include 'check-unique.php';
 $msg = "";
if(isset($_POST['insert']))
{
  
  $course= mysqli_real_escape_string($connection, $_POST['course']);
  $name=mysqli_real_escape_string($connection,$_POST['batchname']);
  $emp=mysqli_real_escape_string($connection,$_POST['emp']);
  $check = checkunique($connection, "tbl_batch", "batch_name", $name);

    if ($check) {
        $q= mysqli_query($connection, "insert into tbl_batch (batch_name,course_id,emp_id) values ('{$name}','{$course}','{$emp}') ") or die(mysqli_error($connection));
            
    if($q)
    {
        
                    header("location:batch-display.php") ; 
    }
    } else {
        $msg = "<div style='background-color:red;color:white;' class='alert alert-primary' "
                . "role='alert'> $name Already Exist ! </div>";}
    
   
    
    
}

?>
<html class="no-js" lang="en">
<?php include'headFile.php'?>
<body>
<div class="prtm-wrapper">
<?php include 'header.php'; ?>

<div class="prtm-main">
    <title> Batch Insert </title>
<?php include 'sidebar.php'; ?>
<div class="prtm-content-wrapper">
<div class="prtm-content">
    <?php echo $msg; ?>
<form class="form-group"  method="post">
    
<div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Batch Name  </label>
<div class="col-sm-5">
<input class="form-control" name="batchname"  placeholder="Batch Name " type="text" required="yes">
</div>
</div>
</div>

<div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label">  Course </label>
<div class="col-sm-5">
    <select class="form-control" name="course" req="yes">
        
        <option>  Select Course   </option>
       
        
        <?php 
        $selectq = mysqli_query($connection, "select * from tbl_course where is_delete='0'  ") or die (mysqli_error($connection));
                           while($sel = mysqli_fetch_array($selectq))
                    {
                        echo "<option value={$sel['course_id']}> {$sel['course_name']}</option>";
                     }
                    echo "  </select>";
        ?>
        
    </select>
</div>
</div>
</div>






<div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label"> Employee      </label>
<div class="col-sm-5">
    <select class="form-control" name="emp" req="yes">
        
        <option>   Select Employee  </option>
       
        
        <?php 
        $selectq = mysqli_query($connection, " SELECT
    `tbl_designation`.`des_name`
    , `tbl_employee`.`emp_name`
    , `tbl_employee`.`emp_id`
FROM
    `db_vsm`.`tbl_employee`
    INNER JOIN `db_vsm`.`tbl_designation` 
        ON (`tbl_employee`.`des_id` = `tbl_designation`.`des_id`) where tbl_designation.des_name='trainer' AND tbl_employee.is_delete='0' ") or die (mysqli_error($connection));
                           while($sel = mysqli_fetch_array($selectq))
                    {
                        echo "<option value={$sel['emp_id']}> {$sel['emp_name']}</option>";
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