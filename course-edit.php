<?php
include 'connection.php';

include 'check-unique-edit.php';
 
$headermsg ="Edit Course";
 $msg = "";
if(!isset($_GET['eid']) || empty($_GET['eid']) )  
    {
       
        header("location:course-display.php") ;  
    }
if($_POST)
{
    $id = mysqli_real_escape_string($connection ,$_POST['courseid']);
    $name= mysqli_real_escape_string($connection ,$_POST['coursename']);
    $duration = mysqli_real_escape_string($connection ,$_POST['courseduration']);
    $fee = mysqli_real_escape_string($connection ,$_POST['coursefee']); 
    
     $check = checkuniqueedit($connection, "tbl_course", "course_name", $name,"course_id",$id);

    if ($check) {
      
    
    $q = mysqli_query($connection, "update tbl_course set course_name='{$name}',course_duration='{$duration}',course_fee='{$fee}' where course_id='{$id}'")or die(mysqli_error($connection));
    if($q)
    {
        header("location:course-display.php") ;   
    }
    } else {
        
        $msg = "<div style='background-color:red;color:white;' class='alert alert-primary' "
                . "role='alert'> $name Already Exist ! </div>";
        
    }
}
$editid =$_GET['eid'];
$selectq = mysqli_query($connection,"select * from tbl_course where course_id='{$editid}'") or die(mysqli_error("$connection"));

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
    
<input type="hidden" value="<?php echo $selectrow['course_id'];?>" name="courseid">
<div class="form-group">
<div class="row mrgn-all-none">
<label for="inputname3" class="col-sm-2 control-label">Course Name</label>
<div class="col-sm-5">
<input class="form-control" name="coursename" value="<?php echo $selectrow['course_name'];?>" placeholder="Course Name" type="text" required="yes">
</div>
</div>
</div>
<div class="form-group">
<div class="row mrgn-all-none">
<label for="inputname3" class="col-sm-2 control-label">Course Duration</label>
<div class="col-sm-5">
<input class="form-control" name="courseduration" value="<?php echo $selectrow['course_duration'];?>"  placeholder="Course Duration" type="number" required="yes">
</div>
</div>
</div>
<div class="form-group">
<div class="row mrgn-all-none">
<label for="inputname3" class="col-sm-2 control-label">Course Fee</label>
<div class="col-sm-5">
<input class="form-control" name="coursefee" value="<?php echo $selectrow['course_fee'];?>" placeholder="Course Fee" type="number" required="yes">
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