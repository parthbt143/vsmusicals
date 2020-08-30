
<?php
include 'connection.php';

$headermsg ="Insert New Course";
include 'check-unique.php';
 $msg= "";
 
if(isset($_POST['insert']))
{
 
    $name = mysqli_real_escape_string($connection,  $_POST['coursename']);
    $duration = mysqli_real_escape_string($connection,$_POST['courseduration']);
    $fee = mysqli_real_escape_string($connection,$_POST['coursefee']);
    $check = checkunique($connection, "tbl_course", "course_name", $name);

    if ($check) {
         $q= mysqli_query($connection, "insert into tbl_course(course_name,course_duration,course_fee) values('{$name}','{$duration}','{$fee}')") or die(mysqli_error($connection));
            
    if($q)
    {
        
                    header("location:course-display.php") ; 
    }
       
    } else {$msg = "<div style='background-color:red;color:white;' class='alert alert-primary' role='alert'> $name Already Exist ! </div>";
    
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
    
<form class="form-group"  method="post">
    <?php 
    echo $msg ?>
<div class="form-group">
<div class="row mrgn-all-none">
<label class="col-sm-2 control-label">Course Name</label>
<div class="col-sm-5">
<input class="form-control" name="coursename" placeholder="Course Name" type="text" required="yes">
</div>
</div>
</div>
<div class="form-group">
<div class="row mrgn-all-none">
<label   class="col-sm-2 control-label">Course Duration</label>
<div class="col-sm-5">
<input class="form-control" name="courseduration" placeholder="Course Duration" type="Number" required="yes">
</div>
</div>
</div>
<div class="form-group">
<div class="row mrgn-all-none">
<label   class="col-sm-2 control-label">Course Fee</label>
<div class="col-sm-5">
<input class="form-control" name="coursefee" placeholder="Course Fee" type="number" required="yes">
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